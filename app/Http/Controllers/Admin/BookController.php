<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use App\Country;
use App\Category;
use App\Author;
use File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchTerm = request()->get('s');
        $books = Book::orWhere('title','LIKE',"%$searchTerm%")->orderBy('id','DESC')->paginate(10);
        return view('admin/book/index')
                ->with(compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        $categories = Category::get();
        $authors = Author::get();
        return view('admin/book/create')
            ->with(compact('countries', 'categories', 'authors')) ;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required',
            'slug' => 'required',
            'category_id' => 'required |not_in:0',
            'author_id' => 'required |not_in:0',
            'availability' => 'required',
            'price' => 'required',
            'country_of_publisher'=> 'required |not_in:none',
            'description' => 'required',
        ]);

        $fileName = null;
        if (request()->hasFile('book_img')) 
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $fileNamePDF = null;
        if (request()->hasFile('book_upload')) 
        {
            $file = request()->file('book_upload');
            $fileNamePDF = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileNamePDF);
        }

        Book::create([ 
            'category_id' => request()->get('category_id'),
            'author_id' => request()->get('author_id'),
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'availability' => request()->get('availability'),
            'price' => request()->get('price'), 
            'rating' => request()->get('rating'),
            'publisher' => request()->get('publisher'),
            'country_of_publisher' => request()->get('country_of_publisher'),
            'isbn' => request()->get('isbn'),
            'isbn-10' => request()->get('isbn-10'),
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'description' => request()->get('description'),
            'book_upload' => $fileNamePDF,
            'book_img' => $fileName,
            'total_pages' => request()->get('total_pages'),
            'downloaded' => request()->get('downloaded'),
            'edition_number' => request()->get('edition_number'),
            'recomended' => request()->get('recomended'),
            'status' => 'DEACTIVE'

        ]);

        return redirect()->to('/admin/book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $countries = Country::get();
        $categories = Category::get();
        $authors = Author::get();
        return view('admin/book/edit')
            ->with(compact('book','countries','categories', 'authors'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $currentImage = $book->book_img;
        $currentPDF = $book->book_upload;
        $fileName = null;
        if (request()->hasFile('book_img')) 
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $fileNamePDF = null;
        if (request()->hasFile('book_upload')) 
        {
            $file = request()->file('book_upload');
            $fileNamePDF = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileNamePDF);
        }

        $book = Book::find($id);
        $book->update([ 
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'availability' => request()->get('availability'),
            'price' => request()->get('price'), 
            'rating' => request()->get('rating'),
            'publisher' => request()->get('publisher'),
            'country_of_publisher' => request()->get('country_of_publisher'),
            'isbn' => request()->get('isbn'),
            'isbn-10' => request()->get('isbn-10'),
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'description' => request()->get('description'),
            'book_upload' => ($fileNamePDF) ? $fileNamePDF : $currentPDF,
            'book_img' => ($fileName) ? $fileName : $currentImage,
            'total_pages' => request()->get('total_pages'),
            'downloaded' => request()->get('downloaded'),
            'edition_number' => request()->get('edition_number'),
            'recomended' => request()->get('recomended'),
        ]);

        if ($fileName) {
            File::delete('./uploads/' . $currentImage);
        }

        if ($fileNamePDF) {
            File::delete('./uploads/' . $currentPDF);
        }

        return redirect()->to('/admin/book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax())
        {    
            $book = Book::find($id);
            $currentImage = $book->book_img;
            $currentPDF = $book->book_upload;
            $book->delete();
            File::delete('./uploads/' . $currentImage);
            File::delete('./uploads/' . $currentPDF);
            return 'true';  
        }
    }
    public function status(Request $request,$id)
    {
        if ($request->ajax())
        {
            sleep(1);
            $book = Book::find($id);
            $newStatus = ($book->status == 'DEACTIVE')? 'ACTIVE'  : 'DEACTIVE' ;
            $book->update([
                'status'=> $newStatus
            ]);
            return $newStatus;
        }  
    }

    public function statusActive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->update([ 'status' => 'ACTIVE']);
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->delete();
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }
}
