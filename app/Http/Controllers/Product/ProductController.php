<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Library\DataHelpers;
use App\Http\Library\FilesHelpers;
use App\Http\Library\ValidationHelpers;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{

    use ValidationHelpers;
    use DataHelpers;
    use FilesHelpers;
    
    /** Loads the page in which a user can add a new product */
    public function AddProduct(){

        //fetches all active categories for the list of parent categories
        $categories = $this->GetActiveCategories();
        //fetches all the unique tags from the products table
        $tags = $this->GetTags();

        return view('products.add_product',compact('categories','tags'));

    }

    /** Stores products form data in database */
    public function StoreProduct(Request $request){

        try{

            //validates product form data
            $validator = Validator::make($request->all(), $this->productValidatedRules());

            $actual_image = '';

            //upload image and returns the name and path
            if ($request->file('image')) {
                $actual_image = $this->UploadImage($request->file('image'),'upload/product_images/');
            }

            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->tags = $request->product_tags;
            $product->picture = $actual_image;
            $product->save();

        }catch(Throwable $e){
            
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Product was added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('products.list')->with($notification);

    }

    /** Loads all products page and fetches all the products */
    public function ListProducts(){
        $products = Product::latest()->paginate();
        return view('products.list_products',compact('products'));
    }

    /** Loads edit product page and fetches the product data */
    public function EditProduct($product_id){

        $product = Product::find($product_id);
        //fetches all active categories for the list of parent categories
        $categories = $this->GetActiveCategories();
        //fetches all the unique tags from the products table
        $tags = $this->GetTags();

        return view('products.edit_product',compact('product','categories','tags'));
    }

    /** Stores updated product data into db */
    public function UpdateProduct($product_id,Request $request){
       
        try{

            //validates product form data
            $validator = Validator::make($request->all(), $this->productValidatedRules());
            $product = Product::find($product_id);

            if($product){
                
                //upload image and returns the name and path
                if ($request->file('image')) {
                    $product->picture = $this->UploadImage($request->file('image'),'upload/product_images/');
                }

                $product->name = $request->name;
                $product->description = $request->description;
                $product->category_id = $request->category_id;
                $product->tags = $request->product_tags;
                $product->save();

            }else{

                $notification = array(
                'message' => 'Product no longer exists',
                'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }

        }catch(Throwable $e){
            
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Product was updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('products.list')->with($notification);

    }

    /** Deletes product from database */
    public function DeleteProduct($product_id){

        try{

            $product = Product::find($product_id)->delete();

        }catch(Throwable $e){
            
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return redirect()->back()->with($notification);

        }

        $notification = array(
            'message' => 'Product was updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('products.list')->with($notification);
        
    }

}
