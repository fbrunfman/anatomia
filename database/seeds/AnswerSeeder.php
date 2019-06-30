<?php

use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = [];
        for ($i = 0; $i < 27; $i++) { 
            $answer = [
                'name' => Str::random(10),
                'is_correct' => $i % 3 == 0 ? 1 : 0,
                'question_id' => floor($i / 3) + 1
            ];
            array_push($answers, $answer);
        }
        DB::table('answers')->insert($answers);
    }
}
