<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('chapters')->get();

        return response()->json([
            'code' => 200,
            'data' => $lessons
        ]);
    }
}
