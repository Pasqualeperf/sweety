<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Models\Like;

class TweetsController extends Controller
{
    public function index()
    {
        return view('home', ['tweets' => auth()->user()->timeline()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "body" => "required|max:255"
            ]
            );

        Tweet::create([
            'user_id' => auth()->user()->id,
            'body'    => $validated['body'],
        ]);

        return redirect(route('home'));
    }
}
