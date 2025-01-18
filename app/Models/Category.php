<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'added_by'];

    function rel_to_user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}