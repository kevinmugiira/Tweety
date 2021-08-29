<?php

namespace App\Models;

#use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;

trait Likable
{

    public function scopeWithLikes(Builder $query)
    {
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
        /*

           left join (
               select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id
    ) likes on likes.tweet_id = tweets.id   */
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isDislikedBy(User $user)
    {
        $this->likes()->where('user_id', $user->id)->exists();
        #instead of doing it like the above statement, use a collection as defined below
        /*return (bool)$user->likes
            ->where('tweet_id', $this->id)->value('liked')
            ->where('liked', false)
            ->count();  */
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id()
        ],
            [
                'liked' => $liked,
            ]
        );
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function isLikedBy(User $user)
    {
        $this->likes()->where('user_id', $user->id)->exists();
        #instead of doing it like the above statement, use a collection as defined below
        /*  return (bool) $user->likes
              ->where('tweet_id', $this->id)->value('liked')
              ->where('liked', true)
              ->count();  */
    }
}
