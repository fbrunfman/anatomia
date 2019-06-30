<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = [];
        for ($i=0; $i < 3; $i++) { 
            $lesson = [
                'name' => Str::random(10)
            ];
            array_push($lessons, $lesson);
        }
        DB::table('lessons')->insert($lessons);
    }
}
