<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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

  	// $categories = cat::with('childs')->get();
    //dd($categories);

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $categories = cat::where('category_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {

        // $categories = cat::with('childs','parent')->get();
             $categories = cat::orderBy('id')->paginate(5);


         $allcategories= cat::pluck('category_name','p_id')->all();
       }
    return view('admin.categories.index',compact('categories','allcategories','parents'))->with('i', ($request->input('page', 1) - 1) * 5);;



  }
  public function create(){

  	$allCategories= cat::where('p_id',0)->pluck('category_name','id')->all();
  	return view('admin.categories.create',compact('allCategories'));
  	//return view('admin.categories.create');
  }
   public function store(Request $request){

             $this->validate($request, [

        		'category_name' => 'required|unique:cats,category_name',

        	]);

        $input = $request->all();

        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];



        cat::create($input);

        return redirect('admin/categories')->with('success', 'New Category added successfully.');


   }
   public function show($id){

      $categories = cat::with('childs','parent')->find($id);


      dd($categories);

     //$categories = cat::findOrFail($id);

     return view('admin.categories.show',compact('categories'));


   }

   public function edit($id){

       // $product = cat::with('childs')->findOrFail($id);
        // dd($product->category_name);
     $categories = cat::with('parent')->findOrFail($id);
    // dd($categories->parent->category_name);
     $allCategories= cat::where('p_id',0)->pluck('category_name','id');
     return view('admin.categories.edit',compact('categories','allCategories'));

   }


   public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_name'=>'required',

         ]);

            $input = $request->all();

             $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];

        $cat = cat::findOrFail($id);


        $cat->update($input);

        return redirect('admin/categories')->with('success', 'Category updated!');
    }
    public function destroy(Request $request, $id){




              $category = cat::find($id);

                $category->delete();

               cat::wherep_id($id)->update(['p_id' => 0]);

      return redirect('admin/categories')->with('success','Category Deleted');
    }










}
