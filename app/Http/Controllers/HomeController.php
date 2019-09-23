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
     * Show the application dashboard.
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
            ->colors(['red', 'green', 'blue', 'yellow', 'orange', 'cyan', 'magenta'])
            ->groupByMonth(date('Y'), true);

            $categorysale = Cartdetail::with('categoryname','order_detail')->select('category', DB::raw('count(*) as total'))
                        ->groupBy('category')
                        ->get();
                      foreach ($categorysale as  $value) {
                      $category[]= $value->categoryname->category_name;
                      $totalproduct[] = $value->total;
                      }

              $donut = Charts::create('donut', 'highcharts')
                    ->title('Category Wise Purchase')
                       ->labels($category)
                       ->values($totalproduct)
                       ->dimensions(500, 350)
                       ->colors(['red', 'green', 'blue','orange' ,'yellow', 'cyan', 'magenta'])
                       ->responsive(true);

          $pie = Charts::database(Cartdetail::with('categoryname')->get(),'pie','highcharts')
           ->title("Order Placed")
           ->elementLabel("Total products")
          ->dimensions(500, 350)
          ->responsive(true)
          ->colors(['red', 'green', 'blue','orange' ,'yellow', 'cyan', 'magenta'])
          ->groupBy('category');

         $usercount = User::count();
         $ordercount = Order_detail::count();
         $msgcount = Contactus::count();
        return view('index',compact('usercount','ordercount','msgcount','chart','pie','donut'));
    }
}
