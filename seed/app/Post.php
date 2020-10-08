<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $table = "posts";
    // public $timestamps= false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 
    ];
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
