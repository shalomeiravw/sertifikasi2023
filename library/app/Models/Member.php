<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    //relationship with books table
    public function books(){
        return $this->hasMany(Book::class);
    }
    //relationship with loans table
    public function loans(){
        return $this->hasMany(Loan::class);
    }

}
