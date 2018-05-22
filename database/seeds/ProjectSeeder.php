<?php

use Faker\Factory;
use App\Model\Project;
use App\Model\Pekerjaan;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Project::truncate();
        Pekerjaan::truncate();

        // project seed
        foreach(range(1, 25) as $i) {
            $project = Project::create([
                'project' => $faker->company,
            ]); 
        }

        // pekerjaan seed
        foreach(range(1, 25) as $j) {
            Pekerjaan::create([
                'pekerjaan' => $faker->jobTitle,
                'site_id' => $j,
                'project_id' => $j,
            ]);
        }
    }
}
