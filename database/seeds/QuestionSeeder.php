<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [];
        for ($i = 0; $i < 27; $i++) { 
            $question = [
                'name' => Str::random(10),
                'order' => $i % 3 + 1,
                'chapter_id' => floor($i / 3) + 1
            ];
            array_push($questions, $question);
        }
        DB::table('questions')->insert($questions);
    }
}
