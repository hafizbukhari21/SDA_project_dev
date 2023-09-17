<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class projectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("id_ID");

        for ($i=0; $i<50;$i++){
            DB::table("projects")->insert([
                "project_name"=> $faker->name(),
                "user_creator_id" =>3,
                "category_id"=>1,
                "status"=>$faker->realText(30),
                "time"=>1.5,
                "urgensi"=>2,
                "idProjectJalin"=>$faker->text(30),
                "pic_am"=>$faker->name,
                "status_progress"=>$faker->text(100),
                "uuid"=>$faker->uuid(),
            ]);
        }
    }
}
