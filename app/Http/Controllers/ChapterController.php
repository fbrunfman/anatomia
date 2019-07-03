<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Lesson;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('screens')->get();

        return response()->json([
            'code' => 200,
            'data' => $chapters
        ]);
    }

    public function add(Request $request) 
    {
        $chapter = new Chapter();
        $chapter->name = $request->name;
        $chapter->lesson_id = $request->lesson_id;
        $chapter->user_id = auth()->user()->id;

        $lesson = Lesson::find($chapter->lesson_id);

        if (!$lesson) {
            return response()->json([
                'error' => 'Leccion no encontrada',
                'code' => 1
            ]);
        }

        return response()->json([
            'message' => 'Capitulo guardado correctamente',
            'code' => 200,
            $chapter->save()
        ]);
   }

}
