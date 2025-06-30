<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    //Mass assignment of values or inputs (To prevent unauthorized inputs into the DB).
    protected $fillable = [
        'title',
        'author',
        'year',
        'details',
        'picture',
    ];
}

