<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Library\DataHelpers;
use App\Http\Library\ValidationHelpers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CategoryController extends Controller
{

    use ValidationHelpers;
    use DataHelpers;

    /** Loads the page to add a new Category */
    public function AddCategory()
    {
        //fetches all active categories for the list of parent categories
        $categories = $this->GetActiveCategories();
        return view('categories.add_category',compact('categories'));
    }

    /** Store a new category into the database */
    public function StoreCategory(Request $request){

        try{

            //validates category form data
            $validator = Validator::make($request->all(), $this->categoryValidatedRules());
            $is_active = ($request->is_active == "on") ? 1 : 0;

            $category = new Category();
            $category->name = $request->name;
            $category->parent_category_id = $request->parent_category_id;
            $category->is_active = $is_active;
            $category->save();

        }catch(Throwable $e){
            
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Category was added successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('categories.list')->with($notification);

    }

    /** Loads all categories page and fetches all the categories */
    public function ListCategories(){

        $categories = Category::latest()->paginate();
        return view('categories.list_categories',compact('categories'));

    }

    /** Loads edit category page and fetches the category data */
    public function EditCategory($category_id){

        $categories = $this->GetActiveCategories();
        $category = Category::find($category_id);
        return view('categories.edit_category',compact('category','categories'));

    }

    /** Stores updated product data into db */
    public function UpdateCategory($category_id,Request $request){

        try{

            //validates category form data
            $validator = Validator::make($request->all(), $this->categoryValidatedRules());
            $category = Category::find($category_id);

            if($category){

                $category->name = $request->name;
                $category->parent_category_id = $request->parent_category_id;
                $category->is_active = intval($request->is_active);
                $category->save();

            }else{

                $notification = array(
                'message' => 'Category no longer exists',
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
            'message' => 'Category was updated successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('categories.list')->with($notification);

    }

    //Deletes category from db
    public function DeleteCategory($category_id){

        $category = Category::find($category_id);
        $child_categories = $category->ChildCategories;
        $related_products = $category->RelatedProducts;

        //checks if there's a related (parent category) and prevent the delete operation
        if(count($child_categories) > 0){

            $notification = array(
                'message' => "This category has child categories, cannot be deleted",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
         
        //checks if there's a related product and prevent the delete operation    
        }else if(count($related_products) > 0){

            $notification = array(
                'message' => "This category has related products, cannot be deleted",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }else{

            $category->delete();
            
            $notification = array(
                'message' => 'Category was deleted successfully',
                'alert-type' => 'success'
            );
    
    
            return redirect()->route('categories.list')->with($notification);

        }

    }

}
