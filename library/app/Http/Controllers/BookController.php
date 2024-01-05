<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $book = Book::with('member')->get();
        $member = Member::all();
    
        return view('books.index', compact('book', 'member'));
    }
    

    public function create(){
        $book = Book::all();
        return view('books.create', compact('book'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:2',
            'author' => 'required | min:2',
            'genre' => 'required | min:2',
            'year_publish' => 'required|numeric|regex:/^\d{4}$/',
            'synopsis' => 'required',
            'picture_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('picture_file')) {
            $file = $request->file('picture_file');
            $filename = time().rand(1,200).'.'.$file->extension(); // Unique filename
            $file->move(public_path('uploads'), $filename);
        
            // Create the book with the image file
            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => $filename,
            ]);
        } else {
            // Create the book without an image file
            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => null
            ]);
        }
        
        // Book::create([
        //     'title' => $request->title,
        //     'author' => $request->author,
        //     'genre' => $request->genre,
        //     'year_publish' => $request->year_publish,
        //     'synopsis' => $request->synopsis,
        //     'picture_file' => $request->
        // ]);

        // foreach($request->file('picture_file') as $file){
        //     $filename = time().rand(1,200).'.'.$file->extension(); // supaya nama file unique (hasilnya misal 20405757.jpg)
        //     $file->move(public_path('uploads'),$filename);
        //     Book::create([
        //         'book_id' => $armada->id,
        //         'filename' => $filename
        //     ]);
        // };

        return redirect('/books')->with('success', 'New Book Successfully Added');
    }

    public function edit($id){
        $book = Book::find($id);
        return view('books.edit', compact('book'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|min:2',
            'author' => 'required | min:2',
            'genre' => 'required | min:2',
            'year_publish' => 'required|numeric|regex:/^\d{4}$/',
            'synopsis' => 'required',
            'picture_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $book = Book::find($id);
        if ($request->hasFile('picture_file')) {
            $file = $request->file('picture_file');
            $filename = time().rand(1,200).'.'.$file->extension(); // Unique filename
            $file->move(public_path('uploads'), $filename);
        
            // Add the book with the image file
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => $filename,
            ]);
        } else {
            // Add the book without an image file
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => null
            ]);
        }

        // $book->update([
        //     'title' => $request->title,
        //     'author' => $request->author,
        //     'genre' => $request->genre,
        //     'year_publish' => $request->year_publish,
        //     'synopsis' => $request->synopsis
        // ]);

        return redirect('/books')->with('success', 'Changes Saved');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect('/books')->with('success', 'Book Deleted');
    }

}
