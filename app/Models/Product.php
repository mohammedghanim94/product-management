<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'tags',
        'picture'
    ];

    public function ProductCategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
