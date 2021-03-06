<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';


    public function category(){
       return $this->belongsToMany(Category::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
