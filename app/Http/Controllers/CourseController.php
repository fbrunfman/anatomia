<?php

namespace App\Http\Controllers;
use App\Course;
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

    public function add(Request $request)
    {   
        $course = new Course();
        $course->name = $request->name;
        
        $course->save();
        
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
}
