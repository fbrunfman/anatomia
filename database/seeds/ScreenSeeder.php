<?php

use Illuminate\Database\Seeder;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $screens = [];
        for ($i = 0; $i < 27; $i++) { 
            $screen = [
                'text' => Str::random(10),
                'image_url' => 'http://diagramcenter.org/wp-content/uploads/2016/03/image.png',
                'chapter_id' => floor($i / 3) + 1,
                'order' => $i % 3 + 1
            ];
            array_push($screens, $screen);
        }
        DB::table('screens')->insert($screens);
    }
}
