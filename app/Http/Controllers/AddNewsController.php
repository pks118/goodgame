<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tiding;

class AddNewsController extends Controller
{
    public function news()
    {
        $new = tiding::all();
        return view('index', [
            'news' => $new
        ]);


    }
}
