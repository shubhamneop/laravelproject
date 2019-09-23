<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\productattributesassoc;
use App\productcategory;
use App\productimage;
use App\cat;
use DB;

class productController extends Controller
{




     function __construct(){
        $this->middleware('permission:product-list');
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);

     }






 public function index(Request $request){



           $keyword = $request->get('search');
           $perPage = 4;

        if (!empty($keyword)) {
            $products = product::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
           $products = product::orderBy('id')->paginate(4);

 	        }
    	return view('admin.product.index',compact('products'))->with('i', ($request->input('page', 1) - 1) * 4);

   }

 public function create(){
    $product = null;
      $categories = cat::where('p_id',0)->get();
 	return view('admin.product.create',compact('categories','product'));
    }

 public function store(Request $request)
 {

     $this->validate($request,[
         'name'=>'required',
         'description'=>'required',
          'image_path'=>'required',
         'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         'category'=>'required',
         'subcategories'=>'required',
         'colour'=>'required',
         'quantity'=>'required|numeric',

                 ]);


         $pro = new product;
         $pro->name=$request->input('name');
         $pro->description= $request->input('description');
         $pro->price= $request->input('price');

         $pro->save();
         $id= $pro->id;


                 foreach ($request->image_path as $photo) {


                      $profileImageSaveAsName = uniqid() . "-product." .
                           $photo->getClientOriginalExtension();

                      $upload_path = 'product/';
                      $profile_image_url = $profileImageSaveAsName;
                      $success = $photo->move($upload_path, $profileImageSaveAsName);


                  $prodductimage = new productimage;
                  $prodductimage->product_id = $pro->id;
                  $prodductimage->image_path = $profile_image_url;
                  $prodductimage->save();
               }
           $cat = new productcategory;
           $cat->product_id=$pro->id;
           $cat->category_id=$request->input('subcategories');
           $cat->save();


          $assoc = new productattributesassoc;

          $assoc->product_id=$pro->id;
          $assoc->color=$request->input('colour');
          $assoc->quantity=$request->input('quantity');
          $assoc->save();


           return redirect('admin/product')->with('success','product added successfully');



  }


        public function edit($id){

            $product = product::with('image','attribute','category')->findOrFail($id);

           $categories = cat::where('p_id',0)->get();


	return view('admin.product.edit',compact('product','categories'));


        }

        public function show($id){
             $products = product::with('image','attribute','category')->findOrFail($id);

	 return view('admin.product.show',compact('products','image'));


        }


        public function update(Request $request, $id){
            $this->validate($request,[
                'name'=>'required',
                'description'=>'required',

               'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'category'=>'required',
               'subcategories'=>'required',
               'price'=>'required',
               'colour'=>'required',
               'quantity'=>'required',


            ]);



              $input = $request->all();
              $product = product::findOrFail($id);
              $product->update($input);

                  if($request->hasFile('image_path')){
                    $image = productimage::where('product_id',$id);
                      foreach ($image as $img) {
                      unlink(public_path('/product').'/'.$img->image_path);
                   }


                  productimage::where('product_id',$id)->delete();
                  $images = $request->file('image_path');

                  foreach ($images as $photo) {
                      $profileImageSaveAsName = uniqid() . "-product." .
                           $photo->getClientOriginalExtension();
                      $upload_path = 'product/';
                      $profile_image_url = $profileImageSaveAsName;
                      $success = $photo->move($upload_path, $profileImageSaveAsName);

                     $img = productimage::where('product_id',$id);
                     $prodductimage = new productimage;
                     $prodductimage->product_id = $product->id;
                     $prodductimage->image_path = $profile_image_url;
                     $prodductimage->save();
                       }
                    }
                      $category =  productcategory::where('product_id',$id);
                      $dataupdate = array( 'category_id' => $request->get('subcategories'));
                      $category->update($dataupdate);

                      $attribute =  productattributesassoc::where('product_id',$id);
                     $dataupdate = array(
                             'color'=>$request->get('colour'),
                             'quantity'=>$request->get('quantity'),
                               );
                     $attribute->update($dataupdate);

        return redirect('admin/product')->with('success', 'Product updated!');


        }


       public function destroy($id){
         productimage::where('product_id',$id)->delete();
         productcategory::where('product_id',$id)->delete();
         productattributesassoc::where('product_id',$id)->delete();
           product::where('id',$id)->delete();


         return redirect('admin/product')
         ->with('success','Product Deleted Successfully');

     }


      public function myformAjax($id)
    {
        $subcategory = DB::table("cats")
                    ->where("p_id",$id)
                    ->get();
        return json_encode($subcategory);
    }











 }
