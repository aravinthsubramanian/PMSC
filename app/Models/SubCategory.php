<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category','subcategory','subcategory_status',];

    protected $casts = ['created_at' => 'datetime',];


    public function category()
    {
        return $this->belongsTo(MainCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
