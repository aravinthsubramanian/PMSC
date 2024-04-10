<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category','category_status',];

    protected $casts = ['created_at' => 'datetime',];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
