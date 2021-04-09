<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like(Tweet $tweet)
    {
        $like = Like::where('user_id', auth()->user()->id)
        ->where('tweet_id', $tweet->id)
        ->get();

        // Se esiste un record Like dove il tweet è quello selezionato e l'utente è quello attualmente loggato lo distrugge.

        if ($like) {
        Like::destroy($like);
        }

        Like::updateOrCreate([
            'user_id' => auth()->user()->id,
            'tweet_id' => $tweet->id,
            'liked' => true,
        ]);

        return back();
    }

    public function dislike(Tweet $tweet)
    {
        $like = Like::where('user_id', auth()->user()->id)
                           ->where('tweet_id', $tweet->id)
                           ->get();

        if ($like) {
            Like::destroy($like);
        }

        Like::updateOrCreate([
            'user_id' => auth()->user()->id,
            'tweet_id' => $tweet->id,
            'liked' => false,
        ]);

        return back();
    }
}
