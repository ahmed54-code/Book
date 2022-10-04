<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Book;
use App\Media;
use App\Team;
use App\Category;

class MainController extends Controller
{
    public function index()
    {
    	$sliders = Media::where(['status' => 'ACTIVE', 'media_type' => 'slider'])->get();
        $upcoming_books = Book::where('status', 'UPCOMING')->limit(5)->get();
        $downloaded_books = Book::where('status', 'ACTIVE')->orderBy('downloaded', 'DESC')->get();
        $recomended_books = Book::where(['status' => 'ACTIVE', 'recomended' => '1'])->get();
        $categories = Category::where('status', 'ACTIVE')->get();
        $books = Book::where('status', 'ACTIVE')->paginate(10);
        $author_feature = Author::where(['status' => 'ACTIVE', 'author_feature' => 'yes'])->inRandomOrder()->first();
        $galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'gallery'])->limit(6)->get();
        return view('index')
        ->with(compact('sliders', 'upcoming_books', 'downloaded_books', 'recomended_books', 'categories', 'books', 'author_feature', 'galleries'));
    }

    public function about()
    {
    	$teams = Team::where('status','ACTIVE')->limit(4)->inRandomOrder()->get();
        return view('about')
                ->with(compact('teams')) ;
    }

    public function gallery()
    {
    	$galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'gallery'])->paginate(8);
        return view('gallery')
            ->with(compact('galleries')) ;
    }

    public function blog()
    {
        return view('blog') ;
    }

    public function author()
    {
    	$searchTerm = request()->get('letter');
        $authors = Author::where('title', 'LIKE', "$searchTerm%")->paginate(15);
        $downloaded_books = Book::orderBy('downloaded', 'DESC')->limit(4)->get();
        $author_features = Author::where('author_feature', 'yes')->limit(5)->get();
        return view('author')
            ->with(compact('authors', 'downloaded_books', 'author_features')) ;
    }

    public function author_detail($slug)
    {
        $author = Author::where('slug', $slug)->first();
        return view('author_detail')
            ->with(compact('author'));
    }

    public function contact()
    {
    	return view('contact') ;
    }
}
