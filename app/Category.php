<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    //mass assignment 
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email', 'description', 'author_feature', 'facebook_id', 'twitter_id'];

    public function book()
    {
    	return $this->hasMany(Book::class, 'category_id' );
    }
}
