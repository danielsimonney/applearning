<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class PostsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $post =  Post::find($row[0])->fill(['body'=> $row[1]]);
        $post->topic()->associate($row[2]);
        $post->user()->associate($row[3]);
        $post->save();
    }
}
