<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Post extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function categories(){
    	return $this->belongsToMany('App\Category')->withTimestamps();
    }
    public function tags(){
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    public function favorite_to_user(){
    	return $this->belongsToMany('App\User')->withTimestamps();
    }
    // for comments
    public function comments(){
        return $this->hasMany('App\Comment');
    }

}
