<?php

namespace App\Http\Controllers\Api\Authenticate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\User\UserResource;
use App\Models\PasswordReset;
use App\Models\RegisterKey;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthenticateController extends Controller
{

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();
        if ($user) {
            if (Hash::check($validated['password'], $user->password)) {
                if ($user->status == 'active') {
                    return $this->Data([
                        'token' => $user->createToken('api-login')->plainTextToken,
                        'user' => new UserResource($user)
                    ]);
                } else {
                    return $this->Error($user->blocked_reason);
                }
            }
        }
        return $this->ValidationError(["email" => ["You have entered an invalid email or password"]]);

    }

    public function check_code(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'link' => ['required'],
            'type' => ['required'],
        ]);
        if ($validated['type'] == 'reset_password') {
            $data = PasswordReset::where('email', $validated['email'])->latest('created_at')->first();
        } else {

            $data = RegisterKey::where('email', $validated['email'])->latest('id')->first();
        }
        if ($data) {
            if (Hash::check($validated['link'], $data->token)) {
                return $this->Data(['status' => true]);
            }
        }
        return $this->Data(['status' => false]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();
        return $this->Success('You have successfully logged out');
    }

    public function get_auth(): \Illuminate\Http\JsonResponse
    {
        return $this->Data(['user' => new UserResource(Auth::user())]);
    }


    public function change_password(ChangePasswordRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();
        return $this->Success('Password has been updated successfully');
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::user();
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->user_name = $validated['user_name'];
        $user->email = $validated['email'];
        $user->avatar_id = $validated['avatar_id'];
        $user->phone = $validated['phone'];
        $user->save();
        return $this->Success('Your profile has been updated Successfully');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $registered_key_ip_count = RegisterKey::where('ip_address', request()->ip())->count();
        $registered_key_email_count = RegisterKey::where('email', $validated['email'])->count();
        if ($registered_key_ip_count >= 20)
            return $this->Error('Your (Ip Address) is blocked.\n you can try again after 1 hour');
        elseif ($registered_key_email_count >= 20)
            return $this->Error('Your (Email Address) is blocked.\n you can try again after 1 hour');
        else
            RegisterKey::where('email', $validated['email'])->update(['status' => 'blocked']);
        $link = str_replace("/", "", Hash::make(mt_rand(100000, 999999)));
        $register_key = new RegisterKey();
        $register_key->email = $validated['email'];
        $register_key->key = Hash::make($link);
        $register_key->ip_address = request()->ip();
        $register_key->Status = 'active';
        $register_key->save();
        Mail::send('emails.registerByEmail', ['email' => $validated['email'], 'link' => $link], function ($m) use ($validated) {
            $m->from('test@layouteam.com', 'Senkron');
            $m->to($validated['email'], 'Register')->subject('Register');
        });
        return $this->Success('Email has been sent successfully,Please check your Email Address');

    }

    public function signUp(SignUpRequest $request)
    {
        $validated = $request->validated();
        $Key = $validated['link'];
        $email = $validated['email'];
        $registerKey = RegisterKey::where('email', $email)->where('status', 'active')->latest('id')->first();
        if ($registerKey) {
            if (Hash::check($Key, $registerKey->key)) {
                $user = new User($validated);
                $password = Hash::make($validated['password']);
                $user->password = $password;
                $user->status = 'active';
                $user->save();
                $user->assignRole(2);
                return $this->Success('Your account has been created successfully');
            }
        }
        return $this->Error('this email address or link is not registered please register your account first');
    }

    public function forget_password(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'exists:users,email']
        ]);
        $PasswordReset = PasswordReset::where('email', $request->email)->where("created_at", ">", Carbon::now()->subDay())->get();
        if ($PasswordReset->count() > 10)
            return $this->Error('you have reached the reset password tries limit \n try again after 1 hour');
        else
            PasswordReset::where("created_at", "<", Carbon::now()->subDay())->delete();
        $link = str_replace("/", "", Hash::make(mt_rand(100000, 999999)));
        $user = User::where('email', $validated['email'])->first();
        Mail::send('emails.resetPassword', ['email' => $validated['email'], 'code' => $link, 'username' => $user->first_name . ' ' . $user->last_name], function ($m) use ($validated) {
            $m->from('test@layouteam.com', 'Senkron');
            $m->to($validated['email'], User::where('email', $validated['email'])->first()->first_name)->subject('Password Reset');
        });
        $passwordReset = new PasswordReset();
        $passwordReset->email = $validated['email'];
        $passwordReset->token = Hash::make($link);;
        $passwordReset->save();
        return $this->Success('Email has been sent successfully,Please check your Email Address');
    }

    public function reset_password(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'link' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
        ]);
        $PasswordReset = PasswordReset::where('email', $validated['email'])->latest('created_at')->first();
        if ($PasswordReset) {
            if (Hash::check($validated['link'], $PasswordReset->token)) {
                $user = User::where('email', $validated['email'])->first();
                $password = Hash::make($validated['password']);
                $user->password = $password;
                $user->save();
                return $this->Success('Your password Has been Changed successfully');
            }
        }
        return $this->Error('this email address or link is not registered');
    }
}
