<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Relationship to User (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
