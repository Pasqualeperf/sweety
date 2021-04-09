<?php

namespace App\Http\Traits;
use Illuminate\Foundation\Auth\User;

trait Followable
{

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function following(User $user)
    {
        return $this->follows->contains($user);

    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }
}
