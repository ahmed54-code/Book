<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';

    //mass assignment 
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    // protected $fillable = ['fullname', 'designation', 'team_img', 'dob', 'country', 'email', 'description', 'author_feature', 'facebook_id', 'twitter_id'];
}
