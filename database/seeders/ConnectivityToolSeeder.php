<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConnectivityTool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConnectivityToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConnectivityTool::insert([
            [
                'key'      => 'google',
                'nickname' => 'Google Analytics',
                'tool_id'  => 'GA_TRACKING_ID',
            ],
            [
                'key'      => 'facebook_pixel',
                'nickname' => 'Facebook Pixel',
                'tool_id'  => 'facebook_pixel_id',
            ],
            // [
            //     'key'      => 'tawk',
            //     'nickname' => 'Support Chat',
            //     'tool_id'  => '64099bf746d4893e696f703c',
            // ],
        ]);
    }
}
