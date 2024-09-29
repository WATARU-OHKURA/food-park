<?php

namespace App\Providers;

use App\Models\Setting;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Schema;
use URL;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        // コンソールコマンド実行時はデータベースアクセスを回避
        if ($this->app->runningInConsole()) {
            return;
        }

        // 'settings' テーブルが存在する場合のみアクセス
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->pluck('value', 'key');
            // $settings を使用して必要な処理を行う

        }

        // キャッシュドライバが 'database' の場合のみ 'cache' テーブルを確認
        if (config('cache.default') === 'database' && Schema::hasTable('cache')) {
            // 'cache' テーブルに対する操作があればここに追加
            // 例: キャッシュデータのプリロードなど
        }

        Paginator::useBootstrap();
    }
}
