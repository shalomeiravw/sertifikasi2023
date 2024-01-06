<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //relationship with members table
    public function member(){
        return $this->belongsTo(Member::class);
    }

    //relationship with books table
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
