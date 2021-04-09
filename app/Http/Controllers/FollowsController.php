<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class FollowsController extends Controller
{
    public function toggleFollow(User $user)
    {
        if (auth()->user()->following($user)) {
            auth()->user()->unfollow($user);
        } else {
            auth()->user()->follow($user);
        }

        return back();
    }
}
