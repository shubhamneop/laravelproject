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

     /**
      * Display a listing of the resource.
      *
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\View\View
      */
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

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\View\View
   */
  public function create(){

  	$allCategories= Category::parentcategory()->pluck('category_name','id')->all();
  	return view('admin.categories.create',compact('allCategories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
   public function store(CategoryRequest $request){

        $input = $request->all();
        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
        Category::create($input);
        return redirect('admin/categories')->with('success', 'New Category added successfully.');


   }

   /**
     * Display the specified resource.
     *
     * @param Illuminate\Database\Eloquent\Model $category
     *
     * @return \Illuminate\View\View
     */
    public function show(Category $category){

     return view('admin.categories.show',compact('category'));

   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  model $banner
    *
    * @return \Illuminate\View\View
    */
   public function edit(Category $category){

     $allCategories= Category::parentcategory()->pluck('category_name','id')->all();

     return view('admin.categories.edit',compact('parent','category','allCategories'));

   }


     /**
      * Update the specified resource in storage.
      *
      * @param \Illuminate\Http\Request $request
      * @param  model $category
      * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
      */
    public function update(CategoryUpdateRequest $request, Category $category)
     {
        $input = $request->all();
        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
        $category->update($input);

        return redirect('admin/categories')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param model $category
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Category $category){

              $category->delete();
              Category::wherep_id($category)->update(['p_id' => 0]);
      return redirect('admin/categories')->with('success','Category Deleted');
    }










}
