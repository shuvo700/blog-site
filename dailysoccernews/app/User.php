<?php
namespace App;
use Eloquent;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Illuminate\Notifications\Notifiable;
class User extends Eloquent implements Authenticatable
{
    use AuthenticableTrait;

    // ... Other Code
    public function role(){
        return $this->belongsTo('App\Role');
    }
    // posts
    public function posts(){
    	return $this->hasMany('App\Post');
    }
    public function favorite_post(){
    	return $this->belongsToMany('App\Post')->withTimestamps();
    }
    // for comments
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
