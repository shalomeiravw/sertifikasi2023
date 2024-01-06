<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function dashboard(){
        //show all books in dashboard
        $book = Book::orderBy('title', 'asc')->get();
        return view('welcome', compact('book'));
    }

    public function index(Request $request){
        //search
        $keyword = $request->keyword;
        if(strlen($keyword)){
            $book = Book::where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('author', 'like', '%' . $keyword . '%')
                        ->orWhere('genre', 'like', '%' . $keyword . '%')
                        ->orWhere('year_publish', 'like', '%' . $keyword . '%')
                        ->get();
            $member = [];
        }else{
            //when no search, show all books
            $book = Book::with('member')->get();
            $book = Book::orderBy('title', 'asc')->get();
            $member = Member::all();
        }
        return view('books.index', compact('book', 'member'));
    }
    
    public function create(){
        //get all book data and pass to create view
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
        
            //create the book with the image file
            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => $filename,
            ]);
        } else {
            //create the book without an image file
            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => null
            ]);
        }
        return redirect('/books')->with('success', 'Book Successfully Added');
    }

    public function edit($id){
        //get the data of the selected book
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
            $filename = $file->storeAs('uploads', 'book_' . $id . '.' . $file->extension(), 'public');
        
            //add the book with the image file
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => $filename,
            ]);
        } else {
            //add the book without an image file
            $book->update([
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'year_publish' => $request->year_publish,
                'synopsis' => $request->synopsis,
                'picture_file' => null
            ]);
        }
        return redirect('/books')->with('success', 'Changes Saved');
    }

    public function destroy($id)
    {
        //delete delected book
        $book = Book::find($id);
        $book->delete();
        return redirect('/books')->with('success', 'Book Deleted');
    }

}
