<?php

namespace App\Http\Controllers;
use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($id)
    {   

        $course = Course::where('id', $id)->where('user_id', auth()->user()->id)->with('lessons.chapters.screens', 'lessons.chapters.questions.answers')->get();

        return response()->json([
            'code' => 200,
            'data' => $course
        ]);
    }

    public function add(Request $request)
    {
        
        $course = new Course();
        $course->name = $request->name;
        $course->user_id = auth()->user()->id;

        return response()->json([
    		'message' => 'Curso guardado correctamente',
            'code' => 200,
            $course->save()
    	]);
    }
}
