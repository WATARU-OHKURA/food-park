<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section_titles = array(
            array('id' => '4','key' => 'why_choose_top_title','value' => 'why choose us','created_at' => '2024-08-19 08:37:00','updated_at' => '2024-09-15 14:24:01'),
            array('id' => '5','key' => 'why_choose_main_title','value' => 'why choose us','created_at' => '2024-08-19 08:37:00','updated_at' => '2024-09-15 14:24:01'),
            array('id' => '6','key' => 'why_choose_sub_title','value' => 'Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.','created_at' => '2024-08-19 08:37:00','updated_at' => '2024-09-15 14:24:01'),
            array('id' => '7','key' => 'daily_offer_top_title','value' => 'daily offer','created_at' => '2024-09-15 14:19:15','updated_at' => '2024-09-15 14:31:25'),
            array('id' => '8','key' => 'daily_offer_main_title','value' => 'up to 75% off for this day','created_at' => '2024-09-15 14:19:15','updated_at' => '2024-09-15 14:31:25'),
            array('id' => '9','key' => 'daily_offer_sub_title','value' => 'Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials','created_at' => '2024-09-15 14:19:15','updated_at' => '2024-09-15 14:31:25'),
            array('id' => '10','key' => 'our_team_top_title','value' => 'our team','created_at' => '2024-09-17 14:06:55','updated_at' => '2024-09-17 14:06:55'),
            array('id' => '11','key' => 'our_team_main_title','value' => 'meet our expert chefs','created_at' => '2024-09-17 14:06:55','updated_at' => '2024-09-17 14:06:55'),
            array('id' => '12','key' => 'our_team_sub_title','value' => 'Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.','created_at' => '2024-09-17 14:06:55','updated_at' => '2024-09-17 14:06:55'),
            array('id' => '13','key' => 'testimonial_top_title','value' => 'testimonial','created_at' => '2024-09-18 15:45:21','updated_at' => '2024-09-18 15:47:27'),
            array('id' => '14','key' => 'testimonial_main_title','value' => 'our customar feedbacks','created_at' => '2024-09-18 15:45:21','updated_at' => '2024-09-18 15:47:27'),
            array('id' => '15','key' => 'testimonial_sub_title','value' => 'Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.','created_at' => '2024-09-18 15:45:21','updated_at' => '2024-09-18 15:47:27')
        );

        \DB::table('section_titles')->insert($section_titles);
    }
}
