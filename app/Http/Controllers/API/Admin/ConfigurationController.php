<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Configuration;
use Validator;
class ConfigurationController extends BaseController
{
  /*
  *Authorized the user with permission
  */
  function __construct(){
      $this->middleware('permission:config-list');
      $this->middleware('permission:config-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:config-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:config-delete', ['only' => ['destroy']]);

   }

   /**
    * Display a listing of the resource.
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\View\View
    */
  public function index()
  {
      $configurations = Configuration::latest()->get();
      return $this->sendResponse($configurations,'All configuration.');
  }

  public function store(Request $request){
    $validator = Validator::make($request->all(),[
      'name'=>'required',
      'value'=> 'required|email|unique:configurations,value',
    ]);

    if($validator->fails()){
      return $this->sendError(null,'Please Provide Proper Data');
    }

    $configurations = Configuration::create($request->toArray());

    return $this->sendResponse($configurations,'Configuration mail added successfully.');

  }

  public function update(Request $request){
    $validator = Validator::make($request->all(),[
      'name'=>'required',
      'value'=> 'required|email|unique:configurations,value,'.$request->id,
    ]);

    if($validator->fails()){
      return $this->sendError(null,'Please Provide Proper Data');
    }
       $configuration  =  Configuration::find($request->id);
       if (is_null($configuration)) {
            return $this->sendError(null,'Configuration not found.');
        }
       $configuration->update($request->toArray());

    return $this->sendResponse($configuration,'Configuration mail added successfully.');

  }

  public function show(Request $request){
    if(empty($request->all())){
      return $this->sendError(null,'Element not found');
    }
    $configuration = Configuration::find($request->id);
    if (is_null($configuration)) {
         return $this->sendError(null,'Configuration not found.');
     }
     return $this->sendResponse($configuration,'Coupon Information.');
  }


  public function destroy(Request $request){
    if(empty($request->all())){
      return $this->sendError(null,'Element not found');
    }
    $configuration = Configuration::findOrFail($request->id);
    if (is_null($configuration)) {
         return $this->sendError(null,'Configuration not found.');
     }
     $configurations = $configuration->delete();

     return $this->sendResponse($configurations,'Banner deleted successfully.');
  }
}
