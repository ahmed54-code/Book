<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    //mass assignment 
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email', 'description', 'author_feature', 'facebook_id', 'twitter_id'];
}
