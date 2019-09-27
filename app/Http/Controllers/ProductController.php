<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\Productattributesassoc;
use App\Productcategory;
use App\Productimage;
use App\Category;
use DB;

class ProductController extends Controller
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
            $products = Product::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
           $products = Product::orderBy('id')->paginate($perPage);

 	        }
    	return view('admin.product.index',compact('products'))->with('i', ($request->input('page', 1) - 1) * 4);

   }

 public function create(){
    $product = null;
      $categories = Category::where('p_id',0)->get();
 	return view('admin.product.create',compact('categories','product'));
    }

 public function store(ProductRequest $request)
 {


         $product = new Product;
         $product->name=$request->input('name');
         $product->description= $request->input('description');
         $product->price= $request->input('price');

         $product->save();
         $id= $product->id;


                 foreach ($request->image_path as $photo) {


                      $profileImageSaveAsName = uniqid() . "-product." .
                           $photo->getClientOriginalExtension();

                      $upload_path = 'product/';
                      $profile_image_url = $profileImageSaveAsName;
                      $success = $photo->move($upload_path, $profileImageSaveAsName);


                  $prodductimage = new productimage;
                  $prodductimage->product_id = $product->id;
                  $prodductimage->image_path = $profile_image_url;
                  $prodductimage->save();
               }


            $product->category()->attach($request->input('subcategories'));

          $assoc = new Productattributesassoc;

          $assoc->product_id=$product->id;
          $assoc->color=$request->input('colour');
          $assoc->quantity=$request->input('quantity');
          $assoc->save();


           return redirect('admin/product')->with('success','product added successfully');



  }


        public function edit(Product $product){



           $categories = Category::where('p_id',0)->get();


	   return view('admin.product.edit',compact('product','categories'));


        }

        public function show(Product $product){


	 return view('admin.product.show',compact('product','image'));


        }


        public function update(ProductUpdateRequest $request, Product $product){



              $input = $request->all();

              $product->update($input);

                  if($request->hasFile('image_path')){
                    $image = Productimage::where('product_id',$product->id);
                      foreach ($image as $img) {
                      unlink(public_path('/product').'/'.$img->image_path);
                   }


                  Productimage::where('product_id',$product->id)->delete();
                  $images = $request->file('image_path');

                  foreach ($images as $photo) {
                      $profileImageSaveAsName = uniqid() . "-product." .
                           $photo->getClientOriginalExtension();
                      $upload_path = 'product/';
                      $profile_image_url = $profileImageSaveAsName;
                      $success = $photo->move($upload_path, $profileImageSaveAsName);

                     $img = Productimage::where('product_id',$product->id);
                     $prodductimage = new Productimage;
                     $prodductimage->product_id = $product->id;
                     $prodductimage->image_path = $profile_image_url;
                     $prodductimage->save();
                       }
                    }
                        $product->category()->attach($request->input('subcategories'));

                      $attribute =  Productattributesassoc::where('product_id',$product->id);
                     $dataupdate = array(
                             'color'=>$request->get('colour'),
                             'quantity'=>$request->get('quantity'),
                               );
                     $attribute->update($dataupdate);

        return redirect('admin/product')->with('success', 'Product updated!');


        }


       public function destroy($id){
         Productimage::where('product_id',$id)->delete();
         Productcategory::where('product_id',$id)->delete();
         Productattributesassoc::where('product_id',$id)->delete();
           Product::where('id',$id)->delete();


         return redirect('admin/product')
         ->with('success','Product Deleted Successfully');

     }


      public function subcategory($id)
    {
        $subcategory = Category::where("p_id",$id)
                    ->get();
        return json_encode($subcategory);
    }











 }
