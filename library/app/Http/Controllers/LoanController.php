<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(){
        $loan = Loan::with(['member', 'book'])->get();
        $member = Member::all();
        $book = Book::all();

        return view('loans.index', compact('loan', 'member', 'book')); 
    }

    public function create(){
        
    }

    public function store(Request $request){

    }
}
