<?php

namespace App\Http\Controllers;

use App\Question;
use App\Chapter;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function add(Request $request) 
    {
        $question = new Question();
        $question->name = $request->name;
        $question->order = $request->order;
        $question->chapter_id = $request->chapter_id;

        $chapter = Chapter::find($question->chapter_id);

        if (!$chapter) {
            return response()->json([
                'error' => 'Capitulo no encontrado',
                'code' => 1
            ]);
        }

        $question->save();
        
        return response()->json([
            'message' => 'Pregunta guardada correctamente',
            'code' => 200,
        ]);
   }
}
