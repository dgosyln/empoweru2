<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = storage_path() . "/json/positions.json";
        $data = json_decode(file_get_contents($json, true));
        foreach ($data as $obj) {
            App\Model\Position::create([
                'id' => $obj->id,
                'name' => $obj->name,
                'required_educational_attainment' => $obj->required_educational_attainment,
                'required_recent_job_experience' => $obj->required_recent_job_experience,
                'required_years_of_work_experience' => $obj->required_years_of_work_experience
            ]);
        }
    }
}
