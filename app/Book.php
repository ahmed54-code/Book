<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

    //mass assignment 
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    // protected $fillable = ['title', 'slug', 'designation', 'dob', 'country', 'email', 'description', 'author_feature', 'facebook_id', 'twitter_id'];

    public function author_book()
    {
    	return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
    	return $this->belongsTo(Category::class, 'category_id');
    }
}
