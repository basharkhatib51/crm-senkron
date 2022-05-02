<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'demo',
            'last_name' => 'admin',
            'avatar_id' => 2,
            'user_name' => 'user_name',
            'email' => 'demo@demo.com',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);
        $date = Carbon::now()->format('Y-m-d h:i:s');
        $role = Role::create(["name" => "SuperAdmin"]);
        $role->permissions()->createMany([
            ["name" => "Setting"],
            ["name" => "Product"],
            ["name" => "Category"],
            ["name" => "Slider"],
            ["name" => "Section"],
            ["name" => "Menu"],
            ["name" => "Tag"],
            ["name" => "Page"],
            ["name" => "User"],
            ["name" => "Role"],
            ["name" => "Language"],
            ["name" => "Statistic"],
            ["name" => "Translation"],
            ["name" => "ServiceCategory"],
        ]);
        $user->assignRole($role);
        Role::create(["name" => "Customer"]);
    }
}
