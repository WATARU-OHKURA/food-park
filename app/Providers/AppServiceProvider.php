<?php

namespace App\Providers;

use App\Models\Setting;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // コンソールコマンド実行時はデータベースアクセスを回避
        if ($this->app->runningInConsole()) {
            return;
        }

        // 'settings' テーブルが存在する場合のみアクセス
        // if (Schema::hasTable('settings')) {
        //     $settings = DB::table('settings')->pluck('value', 'key');
        //     // $settings を使用して必要な処理を行う

        //     $keys = ['pusher_app_id', 'pusher_cluster', 'pusher_key', 'pusher_secret'];
        //     $pusherConf = Setting::whereIn('key', $keys)->pluck('value', 'key');

        //     config(['broadcasting.connections.pusher.key' => $pusherConf['pusher_key']]);
        //     config(['broadcasting.connections.pusher.secret' => $pusherConf['pusher_secret']]);
        //     config(['broadcasting.connections.pusher.app_id' => $pusherConf['pusher_app_id']]);
        //     config(['broadcasting.connections.pusher.options.cluster' => $pusherConf['pusher_cluster']]);
        // }

        Paginator::useBootstrap();

    }
}

