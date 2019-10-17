<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Auth;
use Validator;
use App\Page;

class PageController extends BaseController
{
   function __construct(){

     return $this->middleware('role:admin',['except'=>['publish']]);
   }


   public function index(){
     $pages = Page::orderBy('id')->get();

     return $this->sendResponse($pages,'All Static Pages.');
   }


   public function store(Request $request) {

     $validator = Validator::make($request->all(),[
        'name'=>'required',
        'title'=>'required|unique:pages,title',
       'slug'=>'required|unique:pages,slug',
       'content'=>'required',
       'status'=>'required',
     ]);

      if($validator->fails()){
        return $this->sendError($validator->errors(),'Please Provide Proper Data.');
      }

      $page = Page::create($request->toArray());

      return $this->sendResponse($page,'Page Added Successfully.');
   }

   public function update(Request $request){
     $validator= Validator::make($request->all(),[
       'name'=>'required',
       'title'=>'required|unique:pages,title,'.$request->id,
      'slug'=>'required|unique:pages,slug,'.$request->id,
      'content'=>'required',
      'status'=>'required',
     ]);
     if($validator->fails()){
       return $this->sendError($validator->errors(),'Please Provide Proper Data.');
     }
      $pages =  Page::find($request->id);
      if (is_null($pages)) {
           return $this->sendError(null,'Page not found.');
       }
     $page = $pages->update($request->all());

     return $this->sendResponse($page,'Page Updated Successfully.');
   }


   public function show(Request $request){
     if(empty($request->all())){
       return $this->sendError(null,'Element not found');
     }
     $pages = Page::find($request->id);
     if (is_null($pages)) {
          return $this->sendError(null,'Page not found.');
      }
      return $this->sendResponse($pages,'Page Information.');
   }

   public function destroy(Request $request){
     if(empty($request->all())){
       return $this->sendError(null,'Element not found');
     }

     $pages = Page::find($request->id);
     if (is_null($pages)) {
          return $this->sendError(null,'Page not found.');
      }
     $page = $pages->delete();

     return $this->sendResponse($page,'Page Deleted Successfully.');

   }
}
