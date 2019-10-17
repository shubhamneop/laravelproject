<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Auth;
use Validator;
use App\Banner;
use App\Traits\StoreImageTrait;

class BannerController extends BaseController
{
  use StoreImageTrait;
   /**
   *
   *Autherized user with permission
   *
   */
   function __construct(){
       $this->middleware('permission:banner-list');
       $this->middleware('permission:banner-create', ['only' => ['create', 'store']]);
       $this->middleware('permission:banner-edit', ['only' => ['edit', 'update']]);
       $this->middleware('permission:banner-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
   public function index(Request $request)
   {
        $banners = Banner::latest()->get();

        return $this->sendResponse($banners,'All banners');

   }


   public function store(Request $request){
     $validator = Validator::make($request->all(),[
       'name'=>'required|unique:banners,name',
       'bannername'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
     ]);

     if($validator->fails()){
       return $this->sendError(null,'Please fill data in proper format');
     }

     $requestData = $request->all();
     $requestData['bannername'] = $this->verifyAndStoreImage($request, 'bannername', 'banner');

     $banner =  Banner::create($requestData);

     return $this->sendResponse($banner,'Banner Added Successfully.');
   }


   public function update(Request $request){
     $validator = Validator::make($request->all(),[
       'name'=>'required|unique:banners,name,'.$request->id,
       'bannername'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
     ]);

     if($validator->fails()){
       return $this->sendError(null,'Please fill data in proper format');
     }

     $banners = Banner::find($request->id);
     if (is_null($banners)) {
          return $this->sendError(null,'Banner not found.');
      }
     $requestData = $request->all();
     $requestData['bannername'] = $this->verifyAndStoreImage($request, 'bannername', 'banner');

      $banners->update($requestData);

     return $this->sendResponse($banners,'Banner Updated Successfully.');
   }

   public function show(Request $request){
     if(empty($request->all())){
       return $this->sendError(null,'Element not found');
     }
     $banners = Banner::find($request->id);
     if (is_null($banners)) {
          return $this->sendError(null,'Banner not found.');
      }
      return $this->sendResponse($banners,'Banner Information.');
   }

   public function destroy(Request $request) {
     if(empty($request->all())){
       return $this->sendError(null,'Element not found');
     }
     $banners = Banner::find($request->id);
     if (is_null($banners)) {
          return $this->sendError(null,'Banner not found.');
      }
      $banner = $banners->delete();

      return $this->sendResponse($banner,'Banner deleted successfully.');
   }


}
