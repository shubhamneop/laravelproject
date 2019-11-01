<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\CustomerExport;
use Excel;
use Auth;
use App\User;
use App\Category;
use App\Order_detail;
use App\Used_coupon;
use App\Cartdetail;

class ReportController extends Controller
{

  function ___construct()
  {
      $this->middleware('permission:report-list');
      $this->middleware('permission:report-create', ['only' => ['create', 'store']]);
      $this->middleware('permission:report-edit', ['only' => ['edit', 'update']]);
      $this->middleware('permission:report-delete', ['only' => ['destroy']]);

  }
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

      $keyword=$request->get('search');

      $start = date("Y-m-d",strtotime($request->get('fromdate')));
      $end = date("Y-m-d",strtotime($request->get('todate')));
      $perPage = 5;
      if (!empty($keyword)) {
        $users = User::whereHas('roles' , function($q){
         $q->where('name', 'customer');
       })->where('email','LIKE',"%$keyword%")
         ->orwhere('name','LIKE',"%$keyword%")
         ->orwhere('lastname','LIKE',"%$keyword%")
              ->paginate($perPage);

      }else{
       if ('1970-01-01'!=($start)) {
         $start = $start.' '.'00:00:00';
         $end = $end.' '.'23:59:58';
             $users = User::whereHas('roles' , function($q){
              $q->where('name', 'customer');
            })->whereBetween('created_at',[$start,$end])
                   ->paginate($perPage);

        } else {

           $users = User::whereHas('roles' , function($q){
            $q->where('name', 'customer');
           })->orderBy('id','DESC')->paginate($perPage);
       }

     }
        return view('admin.reports.customer.index',compact('users'))->with('i', ($request->input('page', 1) - 1) * 5);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {      $user = User::find($id);
          $orders = $user->orderDetails;

        return view('admin.reports.customer.show',compact('orders'));

    }


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function allCoupon(Request $request){

           $keyword = $request->get('search');
           $perPage = 5;

      if (!empty($keyword)) {
            $coupons = Used_coupon::whereHas('user', function ($query) use($keyword) {
                                     $query->where('email','LIKE', "%$keyword%");
                                   })->orwhereHas('coupon',function($query) use($keyword){
                                     $query->where('code','LIKE',"%$keyword%");
                                   })->with('coupon','user','order_detail')->latest()->paginate($perPage);

         } else {

            $coupons = Used_coupon::with('coupon','user','order_detail')->where('coupon_id','!=',0)->orderBy('id','DESC')->paginate($perPage);
        }



    return view('admin.reports.coupons.index',compact('coupons'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function sales(Request $request){
        $id = $request->get('category_id');

        $keyword=$request->get('search');
        $start = date("Y-m-d",strtotime($request->get('fromdate')));
        $end = date("Y-m-d",strtotime($request->get('todate')));
        if(!empty($id) && !empty($keyword)){


          $sales = Cartdetail::whereHas('categoryname',function($q) use($id)
             {
              $q->where('category',$id);
            })->where('product_name','LIKE',"%$keyword%")
                                ->latest()->paginate(5);

        }else{
         if(!empty($id)){
          $sales = Cartdetail::whereHas('categoryname',function($q) use($id)
             {
              $q->where('category',$id);
            })->with('order_detail')->latest()->paginate(5);
          }else {
         if(!empty($keyword)){
           $sales= Cartdetail::where('product_name','LIKE',"%$keyword%")
                               ->orwhere('price','LIKE',"%$keyword%")
                              ->latest()->paginate(5);

         }else {

          if('1970-01-01'!=($start)){
                 $start = $start.' '.'00:00:00';
                 $end = $end.' '.'23:59:58';
                 $sales= Cartdetail::with('categoryname','order_detail')
                        ->whereBetween('created_at',[$start,$end])->latest()->paginate(5);



            }else{
            $sales = Cartdetail::with('categoryname','order_detail')->latest()->paginate(5);
         }
        }
      }
    }


       $subcategory = Category::subCategory()->get();

      return view('admin.reports.sales.index',compact('sales','subcategory'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

      public function customer($type,$search=NULL)
      	{

          if($search){
            $data = User::whereHas('roles' , function($q){
              $q->where('name', 'customer');
            })->select('name','lastname','email', 'created_at AS Registered_at')->where('email','LIKE',"%$search%")
              ->orwhere('name','LIKE',"%$search%")
              ->orwhere('lastname','LIKE',"%$search%")->orderBy('id','DESC')->get();
          }else{

      		$data = User::whereHas('roles' , function($q){
           $q->where('name', 'customer');
         })->select('name','lastname','email', 'created_at AS Registered_at')->orderBy('id','DESC')->get();
       }
      		return Excel::create('Customer_report', function($excel) use ($data) {
      			$excel->sheet('mySheet', function($sheet) use ($data)
      	        {
      				$sheet->fromArray($data);
      	        });
      		})->download($type);
      	}

        public function sale($type,$search=NULL){
          if($search){
            $data = Cartdetail::join('cats','cats.id','=','cartdetails.category')
                  ->select('cartdetails.id','cartdetails.product_name','cartdetails.quantity','cartdetails.price','cats.category_name','cartdetails.created_at AS Placed_At')
                  ->where('cartdetails.product_name','LIKE',"%$search%") 
                  ->get();

          }else {

          $data = Cartdetail::join('cats','cats.id','=','cartdetails.category')
                ->select('cartdetails.id','cartdetails.product_name','cartdetails.quantity','cartdetails.price','cats.category_name','cartdetails.created_at AS Placed_At')->get();

          }
          return Excel::create('Sales_report', function($excel) use ($data) {
      			$excel->sheet('mySheet', function($sheet) use ($data)
      	        {
      		      $sheet->fromArray($data);
      	        });
      		})->download($type);
        }


        public function coupons($type,$search=NULL){
          if($search){
            $data = Used_coupon::join('coupons','coupons.id','=','used_coupons.coupon_id')
                               ->join('users','users.id','used_coupons.user_id')
                               ->join('order_details','order_details.coupon_id','used_coupons.id')
                  ->select('used_coupons.id','coupons.code','coupons.discount','coupons.type','users.name','order_details.order_no')
                  ->where('users.email','LIKE',"%$search%")
                  ->orwhere('coupons.code','LIKE',"$search")
                  ->get();
          }else{
          $data = Used_coupon::join('coupons','coupons.id','=','used_coupons.coupon_id')
                             ->join('users','users.id','used_coupons.user_id')
                             ->join('order_details','order_details.coupon_id','used_coupons.id')
                ->select('used_coupons.id','coupons.code','coupons.discount','coupons.type','users.name','order_details.order_no')->get();
           }
          return Excel::create('Coupons_report', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
                {
                $sheet->fromArray($data);
                });
          })->download($type);
        }





}
