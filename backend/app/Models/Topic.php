<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;

class Topic extends Model
{   use HasFactory;
    use Orderable;

    protected $fillable=['title'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
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
