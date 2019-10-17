<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Category;

class CategoryController extends BaseController
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
        * @return json
        */
    public function index(Request $request){

       $categories = Category::with('parent','childs')->orderBy('id','DESC')->get();

      return $this->sendResponse($categories,'Listing all categories.');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return json
     */
     public function store(Request $request){
       $validator = Validator::make($request->all(),[
         'category_name' => 'required|unique:cats,category_name',
       ]);
       if($validator->fails()){
         return $this->sendError(null,'Please Fill proper data');
       }
      $input = $request->all();
      $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
      $categories = Category::create($input);
        return $this->sendResponse($categories, 'New Category added successfully.');
     }





       /**
        * Update the specified resource in storage.
        *
        * @param \Illuminate\Http\Request $request
        *
        * @return json
        */
      public function update(Request $request){
        $validator = Validator::make($request->all(),[
          'category_name' => 'required|unique:cats,category_name,'.$request->id,
        ]);
        if($validator->fails()){
          return $this->sendError(null,'Please Fill proper data');
        }
        $categories = Category::find($request->id);
        if (is_null($categories)) {
             return $this->sendError(null,'Category not found.');
         }
        $input = $request->all();

        $input['p_id'] = empty($input['p_id']) ? 0 : $input['p_id'];
        $categories->update($input);

        return $this->sendResponse($categories, 'Category updated!');
      }


      public function show(Request $request){
        if(empty($request->all())){
          return $this->sendError(null,'Element not found');
        }
        $categories = Category::with('parent')->find($request->id);
        if (is_null($categories)) {
             return $this->sendError(null,'Category not found.');
         }
         return $this->sendResponse($categories,'Category Information.');
      }
      /**
       * Remove the specified resource from storage.
       *
       * @param model $category
       *@return json
       */
      public function destroy(Request $request){
        if(empty($request->all())){
          return $this->sendError(null,'Element not found');
        }
         $categories = Category::findOrFail($request->id);
         if (is_null($categories)) {
              return $this->sendError(null,'Category not found.');
          }

         $data = $categories->delete();
         Category::wherep_id($category)->update(['p_id' => 0]);
         return $this->sendResponse($data,'Category deleted successfully.');

      }

}
