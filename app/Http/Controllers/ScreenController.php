<?php

namespace App\Http\Controllers;
use App\Screen;
use App\Chapter;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index()
    {
        $screens = Screen::all();

        return response()->json([
            'code' => 200,
            'data' => $screens
        ]);
    }

    public function add(Request $request) 
    {
        $screen = new Screen();
        $screen->text = $request->text;
        $screen->order = $request->order;
        $screen->image_url = $request->image_url;
        $screen->chapter_id = $request->chapter_id;
        $screen->user_id = auth()->user()->id;

        $chapter = Chapter::find($screen->chapter_id);

        if (!$chapter) {
            return response()->json([
                'error' => 'Capitulo no encontrada',
                'code' => 1
            ]);
        }

        return response()->json([
            'message' => 'Pantalla guardada correctamente',
            'code' => 200,
            $screen->save()
        ]);
   }
}
