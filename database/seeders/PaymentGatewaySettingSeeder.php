<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_gateway_settings = array(
            array('id' => '9', 'key' => 'paypal_logo', 'value' => '/uploads/media_66df0cf04592f.png', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-09 14:57:52'),
            array('id' => '10', 'key' => 'paypal_status', 'value' => '1', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-09 14:39:44'),
            array('id' => '11', 'key' => 'paypal_account_mode', 'value' => 'sandbox', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-07 01:54:01'),
            array('id' => '12', 'key' => 'paypal_country', 'value' => 'JP', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-07 01:54:01'),
            array('id' => '13', 'key' => 'paypal_currency', 'value' => 'PHP', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-24 14:08:07'),
            array('id' => '14', 'key' => 'paypal_rate', 'value' => '0.8', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-09 14:34:29'),
            array('id' => '15', 'key' => 'paypal_api_key', 'value' => 'AUmUhWNWBnRoSkRgpAB3Ofu668uvSn8JHQVTW0VT3_4W3v0R5kYyMtSGeN2-Fa7hx4gFXGxFu-kAKjZv', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-07 03:54:31'),
            array('id' => '16', 'key' => 'paypal_secret_key', 'value' => 'EITpBpjK9v1QRdRKpvnpDVF--oG2KLJqa1dGzyMsqe5mw5EdKvo8XpToIlZNnWjQro7VB3Tz7gqZpJlU', 'created_at' => '2024-09-07 01:54:01', 'updated_at' => '2024-09-07 03:54:31'),
            array('id' => '17', 'key' => 'paypal_app_id', 'value' => 'APP_ID', 'created_at' => '2024-09-08 11:45:23', 'updated_at' => '2024-09-08 11:45:23'),
            array('id' => '18', 'key' => 'stripe_logo', 'value' => '/uploads/media_66df09a947972.png', 'created_at' => '2024-09-09 05:52:18', 'updated_at' => '2024-09-09 14:43:53'),
            array('id' => '19', 'key' => 'stripe_status', 'value' => '1', 'created_at' => '2024-09-09 05:52:18', 'updated_at' => '2024-09-09 14:39:38'),
            array('id' => '20', 'key' => 'stripe_country', 'value' => 'US', 'created_at' => '2024-09-09 05:52:18', 'updated_at' => '2024-09-09 05:52:18'),
            array('id' => '21', 'key' => 'stripe_currency', 'value' => 'USD', 'created_at' => '2024-09-09 05:52:18', 'updated_at' => '2024-09-09 05:52:18'),
            array('id' => '22', 'key' => 'stripe_rate', 'value' => '1', 'created_at' => '2024-09-09 05:52:18', 'updated_at' => '2024-09-09 05:52:18'),
            array('id' => '23', 'key' => 'stripe_api_key', 'value' => 'pk_test_51Px1MsRsQbf18wgpUr3wMkGnRWJ4QMde1bxr0UjsTcif6I75NfyKmHJmzxHSUGajQmTkbgMlWlaMuK88vPWmgPHr00WFmwOJGB', 'created_at' => '2024-09-09 05:52:18', 'updated_at' => '2024-09-09 06:53:04'),
            array('id' => '24', 'key' => 'stripe_secret_key', 'value' => 'sk_test_51Px1MsRsQbf18wgpwpfDF80bP83XLlqmSvFiugw2f02Mr4XB79yytvtXGP6U9aJYiotMmbqZVC8Fk0SGwoq30U8D008DyCnUFu', 'created_at' => '2024-09-09 05:52:18', 'updated_at' => '2024-09-09 06:53:04'),
            array('id' => '25', 'key' => 'razorpay_logo', 'value' => '/uploads/media_66deeebb28f64.webp', 'created_at' => '2024-09-09 12:48:46', 'updated_at' => '2024-09-09 12:48:59'),
            array('id' => '26', 'key' => 'razorpay_status', 'value' => '1', 'created_at' => '2024-09-09 12:48:46', 'updated_at' => '2024-09-09 12:48:46'),
            array('id' => '27', 'key' => 'razorpay_country', 'value' => 'IN', 'created_at' => '2024-09-09 12:48:46', 'updated_at' => '2024-09-09 12:48:46'),
            array('id' => '28', 'key' => 'razorpay_currency', 'value' => 'INR', 'created_at' => '2024-09-09 12:48:46', 'updated_at' => '2024-09-09 12:48:46'),
            array('id' => '29', 'key' => 'razorpay_rate', 'value' => '0.59', 'created_at' => '2024-09-09 12:48:46', 'updated_at' => '2024-09-09 12:48:46'),
            array('id' => '30', 'key' => 'razorpay_api_key', 'value' => 'rzp_test_K7CipNQYyyMPiS', 'created_at' => '2024-09-09 12:48:46', 'updated_at' => '2024-09-09 12:54:23'),
            array('id' => '31', 'key' => 'razorpay_secret_key', 'value' => 'zSBmNMorJrirOrnDrbOd1ALO', 'created_at' => '2024-09-09 12:48:46', 'updated_at' => '2024-09-09 12:54:23')
        );

        \DB::table('payment_gateway_settings')->insert($payment_gateway_settings);
    }
}
