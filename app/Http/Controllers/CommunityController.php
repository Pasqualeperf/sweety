<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CommunityController extends Controller
{
    public function index()
    {
        $users = User::where('id','!=', auth()->user()->id)->get();

        return view('community', ['users' => $users]);
    }
}
