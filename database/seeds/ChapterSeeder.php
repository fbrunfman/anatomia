<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $chapters = [];
        for ($i = 0; $i < 9; $i++) { 
            $chapter = [
                'name' => Str::random(10),
                'lesson_id' => $i % 3 + 1
            ];
            array_push($chapters, $chapter);
        }
        DB::table('chapters')->insert($chapters);
    }
}
