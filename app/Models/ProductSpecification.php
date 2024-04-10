<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    use HasFactory;

    protected $fillable = ['product','specification',];

    protected $casts = ['created_at' => 'datetime',];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
