<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product','title','path',];

    protected $casts = ['created_at' => 'datetime',];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
