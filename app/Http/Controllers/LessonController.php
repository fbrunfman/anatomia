<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('chapters.screens', 'chapters.questions.answers')->get();

        return response()->json([
            'code' => 200,
            'data' => $lessons
        ]);
    }

    public function add(Request $request) 
    {
        $lesson = new Lesson();
        $lesson->name = $request->name;
        $lesson->course_id = $request->course_id;

        $course = Course::find($lesson->course_id);

        if (!$course) {
            return response()->json([
                'error' => 'Curso no encontrado',
                'code' => 1
            ]);
        }

        
        $lesson->save();
        
        if (!$lesson->save()) {
            return response()->json([
                'message' => 'Error al guardar leccion',
                'code' => 500,
            ]);
        }
        return response()->json([
            'message' => 'Leccion guardada correctamente',
            'code' => 200,
        ]);
   }
}
