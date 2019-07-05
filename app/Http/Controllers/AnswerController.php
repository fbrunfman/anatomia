<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function add(Request $request) 
    {
        $answer = new Answer();
        $answer->name = $request->name;
        $answer->is_correct = $request->is_correct;
        $answer->question_id = $request->question_id;
        $answer->user_id = auth()->user()->id;

        $question = Question::find($answer->question_id);

        if (!$question) {
            return response()->json([
                'error' => 'Capitulo no encontrado',
                'code' => 1
            ]);
        }

        return response()->json([
            'message' => 'Pregunta guardada correctamente',
            'code' => 200,
            $answer->save()
        ]);
   }
}
