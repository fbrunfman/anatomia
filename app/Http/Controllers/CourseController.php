<?php

namespace App\Http\Controllers;
use App\Course;
use App\Lesson;
use App\Chapter;
use App\Answer;
use App\Question;
use App\Screen;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($id)
    {

        $course = Course::where('id', $id)->with('lessons.chapters.screens', 'lessons.chapters.questions.answers')->get();

        return response()->json([
            'code' => 200,
            'data' => $course
        ]);
    }

    public function add2(Request $request)
    {
        $course = new Course();
        $course->name = $request->name;

        $course->save();

        $lessons = $request->lessons;
        $lessonsArray = array();
        foreach($lessons as $lesson)
            {
                if (!empty($lesson))
                {
                    $lessonsArray[] = [
                        'name' => $lesson,
                        'course_id' => $course->id
                    ];
                }
            }

            Lesson::insert($lessonsArray);

            $chapters_name = $request->chapter_name;
            $chapters_name_array = array();

            foreach($chapters_name as $chapter_name)
            {
                if (!empty($chapter_name))
                {
                    $chapters_name_array[]= [
                        'name' => $chapter_name,
                        'lesson_id' => $lesson->id
                    ];
                }
            }

            Chapter::insert($chapters_name_array);


/*             $screens_text = $request->screens_text;
            $screens_text_array = array();
            $screens_image = $request->screens_image;
            $screens_image_array = array();
            $screens_order = $request->screens_order;
            $screens_order_array = array();

            foreach($screens_text as $screen_text)
            {
                if (!empty($screen_text))
                {
                    $screens_text_array[]= [
                        'text' => $screen_text,
                        'lesson_id' => $lesson->id
                    ];
                }
            }
            foreach($screens_image as $screen_image)
            {
                if (!empty($screen_image))
                {
                    $screens_image_array[]= [
                        'image_url' => $screen_image,
                        'lesson_id' => $lesson->id
                    ];
                }
            }
            foreach($screens_order as $screen_order)
            {
                if (!empty($screen_order))
                {
                    $screens_order_array[]= [
                        'order' => $screen_order,
                        'lesson_id' => $lesson->id
                    ];
                }
            }

            Screen::insert($screens_text_array);
            Screen::insert($screens_image_array);
            Screen::insert($screens_order_array);

 */
        if (!$course->save()) {
            return response()->json([
                'message' => 'Error al guardar curso',
                'code' => 500,
            ]);
        }

        return response()->json([
    		'message' => 'Curso guardado correctamente',
            'code' => 200,
    	]);
    }

    public function add(Request $request)
    {
        $json = json_decode($request->course);
        $course = new Course();
        $course->name = $json->course[0]->name;

        if (!$course->save()) {
            return response()->json([
                'message' => 'Error al guardar curso',
                'code' => 500
            ]);
        } else {
            $lessons = $json->course[0]->lessons;
            $lessonsArray = array();
            foreach($lessons as $lesson)
            {
                if (!empty($lesson))
                {
                    $lessonsArray[] = [
                        'name' => $lesson->name,
                        'course_id' => $course->id
                    ];
                }
            }
            if (!Lesson::insert($lessonsArray)) {
                Course::find($course->id)->delete();
                Lesson::where('course_id', $course->id)->delete();
                return response()->json([
                    'message' => 'Error al guardar lecciones',
                    'code' => 501
                ]);
            } else {
                $last_lesson_id = Lesson::latest('id')->select('id')->first()->toArray()['id'];
                $first_lesson_id = $last_lesson_id - count($lessons) + 1;
                for ($i=0; $i < count($lessons); $i++) {
                    $chapters = $lessons[$i]->chapters;

                    foreach ($chapters as $chapter) {
                        $newChapter = new Chapter();
                        $newChapter->name = $chapter->name;
                        $newChapter->lesson_id = $first_lesson_id + $i;

                        if (!$newChapter->save()) {
                            ##### Borrar todos los capitulos #####
                            return response()->json([
                                'message' => 'Error al guardar capítulos',
                                'code' => 502
                            ]);
                        } else {
                            $screens = $chapter->screens;

                            foreach ($screens as $screen) {

                                $newScreen = new Screen();
                                $newScreen->text = $screen->text;
                                $newScreen->image_url = $screen->image_url;
                                $newScreen->order = $screen->order;
                                $newScreen->chapter_id = $newChapter->id;

                                if (!$newScreen->save()) {
                                    ##### Borrar todo lo anterior #####
                                    return response()->json([
                                        'message' => 'Error al guardar pantalla',
                                        'code' => 503
                                    ]);
                                }
                            }

                            $questions = $chapter->questions;

                            foreach ($questions as $questions) {

                                $newQuestion = new Question();
                                $newQuestion->name = $questions->name;
                                $newQuestion->order = $questions->order;
                                $newQuestion->chapter_id = $newChapter->id;

                                if (!$newQuestion->save()) {
                                    ##### Borrar todo lo anterior #####
                                    return response()->json([
                                        'message' => 'Error al guardar pregunta',
                                        'code' => 504
                                    ]);
                                } else {
                                    $answers = $questions->answers;

                                    foreach ($answers as $answer) {
                                        $newAnswer = new Answer();
                                        $newAnswer->name = $answer->name;
                                        $newAnswer->is_correct = $answer->is_correct;
                                        $newAnswer->question_id = $newQuestion->id;

                                        if (!$newAnswer->save()) {
                                            ##### Borrar todo lo anterior #####
                                            return response()->json([
                                                'message' => 'Error al guardar pregunta',
                                                'code' => 505
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return response()->json([
                'message' => 'Happiness is a warm caca',
                'code' => 200
            ]);
        }
    }
}
