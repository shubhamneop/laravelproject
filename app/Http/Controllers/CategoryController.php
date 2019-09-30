<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Category;
use DB;

class CategoryController extends Controller
{


    function __construct(){
        $this->middleware('permission:category-list');
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);

     }


  public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $categories = Category::where('category_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {

         $categories = Category::orderBy('id','DESC')->paginate(5);
         $allcategories= Category::pluck('category_name','p_id')->all();


       }
    return view('admin.categories.index',compact('categories','allcategories','parents'))->with('i', ($request->input('page', 1) - 1) * 5);;



  }
  public function create(){

  	$allCategories= Category::parentcategory()->pluck('category_name','id')->all();
  	return view('admin.categories.create',compact('allCategories'));
  }
   public function store(CategoryRequest $request){

        $input = $request->all();
        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
        Category::create($input);
        return redirect('admin/categories')->with('success', 'New Category added successfully.');


   }
   public function show(Category $category){

      // $categories = cat::with('childs','parent')->find($id);

     return view('admin.categories.show',compact('category'));

   }

   public function edit(Category $category){


     // $categories = cat::with('parent')->findOrFail($id);
     $allCategories= Category::parentcategory()->get();
     return view('admin.categories.edit',compact('category','allCategories'));

   }


   public function update(CategoryUpdateRequest $request, Category $category)
    {


            $input = $request->all();
        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
        // $category = Category::findOrFail($id);
        $category->update($input);

        return redirect('admin/categories')->with('success', 'Category updated!');
    }
    public function destroy(Request $request, Category $category){

              $category->delete();
              Category::wherep_id($category)->update(['p_id' => 0]);
      return redirect('admin/categories')->with('success','Category Deleted');
    }










}
