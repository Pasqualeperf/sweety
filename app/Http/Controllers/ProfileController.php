<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $tweets = Tweet::where('user_id', $user->id)->latest();

        $tweetsWithLikes = $tweets->withCount([
            'likes as likes_count' => function ($query) {
                $query->where('liked', true);
            },
            'likes as dislike_count' => function ($query) {
                $query->where('liked', false);
            }
        ])->get();

        return view('profile.show', ['tweets' => $tweetsWithLikes, 'user' => $user]);
    }

    public function edit(User $user)
    {
        if (auth()->user()->id != $user->id) {
            abort(404);
        }

        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate(
            [
                "name" => "required|max:255",
                "avatar" => [Rule::requiredIf($user->avatar === null)],
                "profile_cover" => [Rule::requiredIf($user->profile_cover === null)],
                "password" => ["required", "min:8", "max:255", "confirmed"],
            ]
        );

        // CAMBIAMO PRIMA IL PATH CHE VIENE CREATO DAL METODO STORE E POI SALVIAMO NELL'ARRAY DI DATI DA SALVARE
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        if ($request->hasFile('profile_cover')) {
            $validated['profile_cover'] = $request->file('profile_cover')->store('covers', 'public');
        }
        $validated['slug'] = Str::slug($request['name']);
        $validated['password'] = Hash::make($validated['password']);

        $user->update($validated);

        return redirect($user->toProfile());
    }
}
