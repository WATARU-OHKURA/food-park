<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingService::class, function(){
            return new SettingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // コンソールコマンド実行時はデータベースアクセスを回避
        if ($this->app->runningInConsole()) {
            return;
        }

        $settingsService = $this->app->make(SettingService::class);
        $settingsService->setGlobalSettings();
    }
}
