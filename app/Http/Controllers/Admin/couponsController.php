<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\coupon;
use Illuminate\Http\Request;

class couponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    
      function __construct(){
        $this->middleware('permission:coupon-list');
        $this->middleware('permission:coupon-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:coupon-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:coupon-delete', ['only' => ['destroy']]);

     }



    public function index(Request $request)
    {

        $keyword = $request->get('search');
        $perPage = 5;
        // $coupons = coupon::orderBy('id')->paginate(10);
                 if (!empty($keyword)) { 
            $coupons = coupon::where('code', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $coupons = coupon::latest()->paginate($perPage);
        }

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {  
         $this->validate($request,[
            'title'=>'required',
             'code'=>'required|regex:/^[a-zA-Z0-9_\-]*$/|unique:coupons,code',
             'type'=>'required',
           'discount'=>'required',

        ]);

          /*
           if ($request->input('type')=='percent') {
               $requestData = $request->input('discount')/100;
           }
        $requestData = $request->all();
        
        coupon::create($requestData);
        */

        $input = new coupon;
        $input->title = $request->input('title');
        $input->code = $request->input('code');
        $input->type = $request->input('type');
       
          
        $input->discount =$request->input('discount') ;

        $input->save();
        



        return redirect('admin/coupons')->with('success', 'coupon added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coupon = coupon::findOrFail($id);

        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coupon = coupon::findOrFail($id);

        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
          $this->validate($request,[
            'title'=>'required',
             'code' => 'required',
             //'regex:/^[a-zA-Z0-9]*([a-zA-Z][0-9]|[0-9][a-zA-Z])[a-zA-Z0-9]*$/',
                            'type'=>'required',

           'discount'=>'required',

        ]);

        $requestData = $request->all();
        
        $coupon = coupon::findOrFail($id);
        $coupon->update($requestData);

        return redirect('admin/coupons')->with('success', 'coupon updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        coupon::destroy($id);

        return redirect('admin/coupons')->with('success', 'coupon deleted!');
    }
}
