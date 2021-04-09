<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Tweet;
use App\Http\Traits\Followable;
use App\Models\Like;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'avatar',
        'profile_cover',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'slug',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function timeline()
    {
        // Dell'utente attualmente loggato prendo gli id degli utenti che segue

        $ids = $this->follows->pluck('id');

        // alla collection che ricavo aggiungo l'id dell'attuale utente loggato.

        $ids->push($this->id);

        // richiamo tutti i tweets che hanno gli ids

        $tweets = Tweet::whereIn('user_id', $ids)->latest();

        return $tweets->withCount([
            'likes as likes_count' => function ($query) {
                $query->where('liked', true);
            },
            'likes as dislike_count' => function ($query) {
                $query->where('liked', false);
            }
        ])->get();
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function toProfile()
    {
        return route('profile', $this->slug);
    }

    public function showAvatar()
    {
        if ($this->avatar != '/images/avatar.png') {
            return '/storage/' . $this->avatar;
        }

        return $this->avatar;
    }

    public function showProfileCover()
    {
        if ($this->profile_cover != '/images/default-profile-cover.jpg') {
            return '/storage/' . $this->profile_cover;
        }

        return $this->profile_cover;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likeTweet(Tweet $tweet)
    {

        $like = Like::where('tweet_id', $tweet->id)->where('user_id', $this->id)->where('liked', true)->get();

        if ($like->count() > 0) {

            return true;
        }

        return false;
    }

    public function dislikeTweet(Tweet $tweet)
    {
        $like = Like::where('tweet_id', $tweet->id)->where('user_id', $this->id)->where('liked', false)->get();

        if ($like->count() > 0) {

            return true;
        }

        return false;
    }
}
