<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SiteSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(ProjectSeeder::class);
    }
}
