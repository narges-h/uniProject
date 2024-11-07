<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'price',
        'description',
        'rating',
        'stock',
        'publishDate',
        'number_of_page',
        'coveruri',
        'translator_name',
        'lagn'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
