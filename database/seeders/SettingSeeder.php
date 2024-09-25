<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = array(
            array('id' => '1','key' => 'site_name','value' => 'Food Park','created_at' => '2024-08-27 08:30:08','updated_at' => '2024-08-27 12:36:53'),
            array('id' => '2','key' => 'site_default_currency','value' => 'PHP','created_at' => '2024-08-27 08:30:08','updated_at' => '2024-09-15 09:10:08'),
            array('id' => '3','key' => 'site_currency_icon','value' => '₱','created_at' => '2024-08-27 08:30:08','updated_at' => '2024-09-15 09:10:08'),
            array('id' => '4','key' => 'site_currency_icon_position','value' => 'left','created_at' => '2024-08-27 08:30:08','updated_at' => '2024-08-31 08:48:15'),
            array('id' => '5','key' => 'pusher_app_id','value' => '1864395','created_at' => '2024-09-13 09:32:36','updated_at' => '2024-09-13 09:32:36'),
            array('id' => '6','key' => 'pusher_key','value' => '1977124716a08144517f','created_at' => '2024-09-13 09:32:36','updated_at' => '2024-09-13 09:32:36'),
            array('id' => '7','key' => 'pusher_secret','value' => '77377f055150ee8eb079','created_at' => '2024-09-13 09:32:36','updated_at' => '2024-09-13 09:32:36'),
            array('id' => '8','key' => 'pusher_cluster','value' => 'ap1','created_at' => '2024-09-13 09:32:36','updated_at' => '2024-09-13 09:32:36'),
            array('id' => '9','key' => 'logo','value' => '/uploads/media_66f29e657c038.png','created_at' => '2024-09-24 08:57:54','updated_at' => '2024-09-24 11:11:33'),
            array('id' => '10','key' => 'footer_logo','value' => '/uploads/media_66f29e657cc81.png','created_at' => '2024-09-24 08:57:54','updated_at' => '2024-09-24 11:11:33'),
            array('id' => '11','key' => 'favicon','value' => '/uploads/media_66f29fd020406.png','created_at' => '2024-09-24 08:57:54','updated_at' => '2024-09-24 11:17:36'),
            array('id' => '12','key' => 'breadcrumb','value' => '/uploads/media_66f29fd0214ca.jpg','created_at' => '2024-09-24 08:57:54','updated_at' => '2024-09-24 11:17:36')
        );

        \DB::table('settings')->insert($settings);
    }
}
