<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Storage;
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





     /**
      * Display a listing of the resource.
      *
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\View\View
      */
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

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\View\View
    */
  public function create(){
       $product = null;
       $categories = Category::parentcategory()->Activecategory()->get();
 	  return view('admin.product.create',compact('categories','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
  public function store(ProductRequest $request) {


         $product = new Product;
         $product->name=$request->input('name');
         $product->description= $request->input('description');
         $product->price= $request->input('price');
         if($request->status == 'Inactive'){
         $product->status = 0;
         }else{
           $product->status = 1;
         }

         $product->save();
         $id= $product->id;


                 foreach ($request->image_path as $photo) {


                      $profileImageSaveAsName = uniqid() . "-product." .
                           $photo->getClientOriginalExtension();

                      $upload_path = 'product/'.$profileImageSaveAsName;
                      $profile_image_url = $profileImageSaveAsName;
                      $success = Storage::disk('s3')->put($upload_path, file_get_contents($photo));


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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  model $product
     *
     * @return \Illuminate\View\View
     */
    public function edit(Product $product) {
           $categories = Category::parentcategory()->Activecategory()->get();
	      return view('admin.product.edit',compact('product','categories'));
        }

     /**
     * Display the specified resource.
     *
     * @param model $product
     *
     * @return \Illuminate\View\View
     */
    public function show(Product $product) {

	 return view('admin.product.show',compact('product','image'));
        }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  model $product
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
  public function update(ProductUpdateRequest $request, Product $product){

              $input = $request->all();
              if($request->status == 'Inactive'){
                $input['status'] = 0;
              }else{
                $input['status'] = 1;
              }
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
                      $upload_path = 'product/'.$profileImageSaveAsName;
                      $profile_image_url = $profileImageSaveAsName;

                    $success = Storage::disk('s3')->put($upload_path, file_get_contents($photo));

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

     /**
      * Remove the specified resource from storage.
      *
      * @param int $id
      * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
      */
   public function destroy($id){
         Productimage::where('product_id',$id)->delete();
         Productcategory::where('product_id',$id)->delete();
         Productattributesassoc::where('product_id',$id)->delete();
           Product::where('id',$id)->delete();


         return redirect('admin/product')
         ->with('success','Product Deleted Successfully');

     }

   /**
   *Load subcategory on create and edit form of product
   *
   * @param int $id
   * @return json_encode
   */
  public function subcategory($id) {
        $subcategory = Category::where("p_id",$id)
                    ->get();
        return json_encode($subcategory);
    }











 }
