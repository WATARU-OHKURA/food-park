<?php

namespace App\Providers;

use App\Services\PaymentGatewaySettingService;
use Illuminate\Support\ServiceProvider;
use Schema;

class PaymentGatewaySettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewaySettingService::class, function () {
            return new PaymentGatewaySettingService();
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

        if (Schema::hasTable('payment_gateway_settings')) {
            // テーブルが存在する場合のみデータベースアクセス
            $paymentGatewaySetting = $this->app->make(PaymentGatewaySettingService::class);
            $paymentGatewaySetting->setGlobalSettings();
        }
    }
}
