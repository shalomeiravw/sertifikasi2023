<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request){
        //search
        $keyword = $request->keyword;
        if(strlen($keyword)){
            $loan = $loan = Loan::join('members', 'members.id', '=', 'loans.member_id')
                                ->join('books', 'books.id', '=', 'loans.book_id')
                                ->where('members.name', 'like', '%' . $keyword . '%')
                                ->orWhere('books.title', 'like', '%' . $keyword . '%')
                                ->get(['loans.*']);
            $member = [];  
            $book = Book::all(); 
        }else{
            $loan = Loan::with(['member', 'book'])->get();
            $loan = Loan::orderBy('loan_date', 'desc')->get();
            $member = Member::all();
            $book = Book::all();
        }
        return view('loans.index', compact('loan', 'member', 'book')); 
    }

    public function create(){
        //get all loan data and pass to create view
        $loan = Loan::with(['member', 'book'])->get();
        $member = Member::orderBy('name', 'asc')->get();
        $book = Book::where('member_id', null)->get();
        $book = Book::orderBy('title', 'asc')->get();

        return view('loans.create', compact('member', 'book', 'loan'));
    }
    public function store(Request $request){
        $request->validate(([
            'member_id' => 'required',
            'book_id' => 'required',
            'loan_date' => 'required',
            'due_date' => 'required'
        ]));
        $loan = Loan::create([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date
        ]);

        //make the book unavailable for other members
        $book = Book::find($request->book_id);
        $book->member_id = $request->member_id;
        $book->loan_id = $loan->id;
        $book->save();

        return redirect('/loans')->with('success', 'Data Successfully Added');
    }

    public function edit($id){
        //retrieve the specific loan we want to edit
        $loan = Loan::with(['member', 'book'])->find($id);

        $member = Member::all();
        $book = Book::where('member_id', null)->get();

        return view('loans.edit', compact('member', 'book', 'loan'));
    }
    public function update(Request $request, $id){
        $request->validate(([
            'member_id' => 'required',
            'book_id' => 'required',
            'loan_date' => 'required',
            'due_date' => 'required'
        ]));
        //update the selected loan
        $loan = Loan::find($id);
        $loan->update([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date
        ]);

        //update books table
        $book = Book::find($request->book_id);
        $book->member_id = $request->member_id;
        $book->save();

        return redirect('/loans')->with('success', 'Changes Saved');
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);

        //retrieve the book associated with the loan
        $book = Book::where('loan_id', $loan->id)->first();

        //check if a valid book is retrieved before updating
        if ($book) {
            //udate the book's member_id and loan_id before deleting the loan
            $book->update([
                'member_id' => null,
                'loan_id' => null,
            ]);
        }
        //delete the loan
        $loan->delete();
        return redirect('/loans')->with('success', 'Data Deleted');
    }

    public function returnBook($id)
    {
        $loan = Loan::find($id);
        $book = Book::where('loan_id', $loan->id)->first();
        
        //update loans table
        $loan->return_date = now();
        $loan->save();

        //update books table
        $book->member_id = null;
        $book->save();

        return redirect('/loans')->with('success', 'Book returned');
    }
}
