<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 20;

    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function topicRelated()
    {
        return $this->hasOne(Topic::class, 'answer_id');
    }
}
