<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //relationship with members table
    public function member(){
        return $this->belongsTo(Member::class);
    }
    //relationship with loans table
    public function loan(){
        return $this->belongsTo(Loan::class);
    }
    
}
