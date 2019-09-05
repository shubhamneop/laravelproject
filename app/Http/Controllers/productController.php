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

   public function index2(Request $request){
         $products = product::orderBy('id')->paginate(5);



   	$data = DB::table('products')
     ->join('productimages','productimages.product_id','=','products.id')
     ->join('productcategories','productcategories.product_id','=','products.id')
     ->join('cats','cats.id','=','productcategories.category_id')
     ->join('productattributesassocs','productattributesassocs.product_id','=','products.id')
     ->select('products.id','products.name','products.description','productimages.image_path','cats.category_name','productattributesassocs.color','productattributesassocs.quantity')

	->get();

         return view('admin.product.index2',compact('products'))->with('i', ($request->input('page', 1) - 1) * 5);

   }

 public function create(){

      $categories = cat::where('p_id',0)->get();
   // $categories = cat::pluck('category_name','id')->all();
 	return view('admin.product.create',compact('categories'));
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


                      $profileImageSaveAsName = time() . "-product." .
                           $photo->getClientOriginalExtension();

                      $upload_path = 'product/';
                      $profile_image_url = $profileImageSaveAsName;
                  $success = $photo->move($upload_path, $profileImageSaveAsName);
                 //  $filename =  $photo->store('products');

                   productimage::create([
                    'product_id' => $pro->id,
                   'image_path' => $profile_image_url
                     ]);
               }

        //        $profileImage = $request->file('image_path');
        // $profileImageSaveAsName = time() . "-profile." .
        //     $profileImage->getClientOriginalExtension();

        // $upload_path = 'product/';
        // $profile_image_url = $profileImageSaveAsName;
        // $success = $profileImage->move($upload_path, $profileImageSaveAsName);

        // $img = new productimage;
        //  $img->image_path =$profile_image_url;
        //  $img->product_id = $pro->id;
        //  $img->save();



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
        $products = DB::table('products')
      ->join('productimages','productimages.product_id','=','products.id')
     ->join('productcategories','productcategories.product_id','=','products.id')
     ->join('cats','cats.id','=','productcategories.category_id')
     ->join('productattributesassocs','productattributesassocs.product_id','=','products.id')
     ->where('products.id','=',$id)
     ->select('products.id','products.name','products.description','productimages.image_path','cats.category_name','productattributesassocs.color','productattributesassocs.quantity')

	->get();

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
               'image_path'=>'required',
               'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'category'=>'required',
               'subcategories'=>'required',
               'price'=>'required',
               'colour'=>'required',
               'quantity'=>'required',


            ]);



              $input = $request->all();


               $cat = product::findOrFail($id);


                $cat->update($input);


                  foreach ($request->image_path as $photo) {


                     $profileImageSaveAsName = time() . "-product." .
                           $photo->getClientOriginalExtension();

                      $upload_path = 'product/';
                      $profile_image_url = $profileImageSaveAsName;
                  $success = $photo->move($upload_path, $profileImageSaveAsName);
                  // $filename = $photo->store('photos');


                    $img = productimage::where('product_id',$id);

                   $dataupdate = array(
                             'image_path'=>$profile_image_url,

                                    );
                      $img->update($dataupdate);



                       }

                    /*
                    $profileImage = $request->file('image_path');
                    $profileImageSaveAsName = time() . "-profile." .
                    $profileImage->getClientOriginalExtension();

                     $upload_path = 'product/';
                    $profile_image_url = $profileImageSaveAsName;
                    $success = $profileImage->move($upload_path, $profileImageSaveAsName);


                    $img = productimage::where('product_id',$id);


                      $dataupdate = array(
                             'image_path'=>$profile_image_url,

                                  );
                      $img->update($dataupdate);
                         */

                      $category =  productcategory::where('product_id',$id);
                $dataupdate = array(
                            'category_id' => $request->get('subcategories')

                               );

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
