<?php

use Faker\Factory;
use App\Model\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Factory::create();

        Site::truncate();

        foreach(range(1, 25) as $i) {
            $site = Site::create([
                'site_id' => 'TSK'.sprintf('%03d', $i),
                'site_type' => $faker->randomElement(['tower', 'telkom']),
                'site_name' => $faker->cityPrefix,
                'lokasi' => $faker->address,
                'description' => $faker->text,
            ]);
        }
    }
}
