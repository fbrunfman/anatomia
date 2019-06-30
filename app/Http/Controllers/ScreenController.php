<?php

namespace App\Http\Controllers;
use App\Screen;
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
}
