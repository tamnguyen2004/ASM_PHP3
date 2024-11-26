<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'quantity', 'image', 'sale', 'category_id',
    ];

    // Thiết lập quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
