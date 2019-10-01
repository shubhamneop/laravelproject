<?php

namespace App\Http\Controllers;
use App\User;
use App\Order_detail;
use App\Contactus;
use App\Cartdetail;
use DB;
use Charts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with charts and counts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $orders = Order_detail::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
              ->get();
         $chart = Charts::database($orders, 'bar', 'highcharts')
                  ->title("Monthly Order Placed")
                  ->elementLabel("Total Orders")
                  ->dimensions(500, 350)
                  ->responsive(true)
                  ->colors(['#ff6347','#ff0000', '#3cb371', '#0000ff','#fa4807' ,'#faf607','#0778fa', '#68fa07', '#3407fa','#07e6fa','#13fa07','#ee07fa','#fa075c','#fa0707'])
                  ->groupByMonth(date('Y'), true);

         $categorysale = Cartdetail::with('categoryname','order_detail')->select('category', DB::raw('count(*) as total'))
                        ->groupBy('category')
                        ->get();
                      foreach ($categorysale as  $value) {
                      $category[]= $value->categoryname->category_name;
                      $totalproduct[] = $value->total;
                      }
                    $category =  array_map('strtoupper',$category);
              $donut = Charts::create('donut', 'highcharts')
                       ->title('Category Wise Purchase')
                       ->labels($category)
                       ->values($totalproduct)
                       ->dimensions(500, 350)
                       ->colors(['#87e012','#ff6347','#ff0000', '#3cb371', '#0000ff','#fa4807' ,'#faf607','#0778fa', '#68fa07', '#3407fa','#07e6fa','#13fa07','#ee07fa','#fa075c','#fa0707','#262626','#262626','#65016e'])
                       ->responsive(true);

         $usercount = User::count();
         $ordercount = Order_detail::count();
         $msgcount = Contactus::count();
        return view('index',compact('usercount','ordercount','msgcount','chart','pie','donut'));
    }
}
