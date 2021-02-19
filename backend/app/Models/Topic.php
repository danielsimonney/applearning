<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Topic extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use Orderable;

    protected $fillable = ['title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }


    public function bestAnswer()
    {
        return $this->belongsTo(Post::class, 'answer_id');
    }

    public function getLikesTotalAttribute()
    {
        return $this->likes_count - $this->dislikes_count;
    }

    public function hasUserVoted($user)
    {
        $voted = null;
        if ($user == null) {
            return $voted;
        }
        foreach ($this->likes as $value) {
            if ($user->ownLike($value)) {
                $voted = $value->is_liked;
            }
        }
        return $voted;
    }

    // Supprime les entrees de la table pivot au delete d'un topic
    // public static function boot() {
    //     parent::boot();
    //     static::deleting(function($topic) { // before delete() method call this
    //          $topic->tags()->detach();
    //          // do the rest of the cleanup...
    //     });
    // }
}
