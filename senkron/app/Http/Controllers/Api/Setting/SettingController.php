<?php

namespace App\Http\Controllers\Api\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreSettingsRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Groups resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function groups(): JsonResponse
    {
        $this->authorize('settings', Setting::Class);
        $settings = Setting::orderBy('index')->get()->groupBy('tab');
        return $this->Data(['data' => $settings]);
    }

    /**
     * Save Setting resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function save_setting(StoreSettingsRequest $request): JsonResponse
    {
        $this->authorize('settings', Setting::Class);
        $validated = $request->validated();
        foreach ($validated as $tab) {
            foreach ($tab as $el) {
                Setting::where('key', $el['key'])->update(['value' => $el['value']]);
            }
        }
        return $this->Success('Setting has been Updated Successfully');
    }
}
