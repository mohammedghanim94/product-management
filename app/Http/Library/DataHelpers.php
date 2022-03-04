<?php 

namespace App\Http\Library;

use App\Models\Category;
use App\Models\Product;

trait DataHelpers
{

    /** fetches and returns all the unique tags from the products table */
    public function GetTags(){
        
        $products = Product::select('tags')->whereNotNull('tags')->get();
        $tags = '';
        
        if (count($products) > 0){
            foreach($products as $product){
                $in_tags =  $product->tags.',';
                $tags = $tags.$in_tags;
            }
            $tags = implode(',', array_unique(explode(',', $tags)));
        }
            

        return $tags;

    }

    /** fetches and returns all active categories for the list of parent categories */
    public function GetActiveCategories(){

        $categories = Category::select('id','name')->where('is_active','=',1)->get();
        return $categories;

    }

}