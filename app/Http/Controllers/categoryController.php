<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\cat;
use DB;

class categoryController extends Controller
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
            $categories = cat::where('category_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {

         $categories = cat::orderBy('id','DESC')->paginate(5);
         $allcategories= cat::pluck('category_name','p_id')->all();
       }
    return view('admin.categories.index',compact('categories','allcategories','parents'))->with('i', ($request->input('page', 1) - 1) * 5);;



  }
  public function create(){

  	$allCategories= cat::where('p_id',0)->pluck('category_name','id')->all();
  	return view('admin.categories.create',compact('allCategories'));
  }
   public function store(CategoryRequest $request){

        $input = $request->all();
        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
        cat::create($input);
        return redirect('admin/categories')->with('success', 'New Category added successfully.');


   }
   public function show(cat $category){

      // $categories = cat::with('childs','parent')->find($id);

     return view('admin.categories.show',compact('category'));

   }

   public function edit(cat $category){


     // $categories = cat::with('parent')->findOrFail($id);
     $allCategories= cat::where('p_id',0)->get();
     return view('admin.categories.edit',compact('category','allCategories'));

   }


   public function update(CategoryUpdateRequest $request, $id)
    {


            $input = $request->all();
        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
        $category = cat::findOrFail($id);
        $category->update($input);

        return redirect('admin/categories')->with('success', 'Category updated!');
    }
    public function destroy(Request $request, cat $category){

              $category->delete();
              cat::wherep_id($category)->update(['p_id' => 0]);
      return redirect('admin/categories')->with('success','Category Deleted');
    }










}
