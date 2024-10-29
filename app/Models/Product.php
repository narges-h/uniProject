<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'price',
        'description',
        'rating',
        'stock',
        'publish_date',
    ];
     

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
