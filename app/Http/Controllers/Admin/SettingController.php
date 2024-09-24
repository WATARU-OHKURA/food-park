<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use FileUploadTrait;

    function index(): View
    {
        return view('admin.setting.index');
    }

    function updateGeneralSetting(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => ['required', 'max:255'],
            'site_default_currency' => ['required', 'max:4'],
            'site_currency_icon' => ['required', 'max:4'],
            'site_currency_icon_position' => ['required', 'max:255'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    function updatePusherSetting(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'pusher_app_id' => ['required'],
            'pusher_key' => ['required'],
            'pusher_secret' => ['required'],
            'pusher_cluster' => ['required'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }

    function updateLogoSetting(Request $request) : RedirectResponse {
        $validatedData = $request->validate([
            'logo' => ['nullable', 'image', 'max:1000'],
            'footer_logo' => ['nullable', 'image', 'max:1000'],
            'favicon' => ['nullable', 'image', 'max:1000'],
            'breadcrumb' => ['nullable', 'image', 'max:1000'],
        ]);

        foreach($validatedData as $key => $value){
            $imagePath = $this->uploadImage($request, $key, );
            if(!empty($imagePath)){
                $oldPath = config('settings.'.$key);
                $this->removeImage($oldPath);
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $imagePath],
                );
            }
        }

        $settingsService = app(SettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }
}
