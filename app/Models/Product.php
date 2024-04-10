<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product','description','cost','status','category','subcategory',];

    protected $casts = ['created_at' => 'datetime',];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class);
    }
}
