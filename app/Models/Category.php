<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_category_id',
        'is_active',
    ];

    public function ParentCategory(){
        return $this->hasOne(Category::class,'id','parent_category_id');
    } 

    public function ChildCategories(){
        return $this->hasMany(Category::class,'parent_category_id','id');
    }

    public function RelatedProducts(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
