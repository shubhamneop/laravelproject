<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\Orderdetails;
use App\Configuration;
use App\Sample;
use App\Order_detail;
use App\Address;
use App\Used_coupon;
use App\Cartdetail;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use Auth;
use DB;
use App\Cart;
use App\User_order;
use App\productattributesassoc;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    /**
    *Store order data in orderDetails and Cartdetail table when payment_mode PayPal
    *
    * @param Session $cart
    *
    * @param \Illuminate\Http\Request $request
    *
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
 public function payWithpaypal(AddressRequest $request) {


   DB::beginTransaction();
     try{
          if(!Session::has('cart')){
             return view('Frontend.cart',['products'=>null]);
                 }

                 $addressId = $request->input('address');

                  if($addressId==null){
                    $userid = Auth::User()->id;
                   $useraddress = new Address;

                   $useraddress->fullname = $request->input('fullname');
                   $useraddress->address1 = $request->input('address1');
                   $useraddress->address2 = $request->input('address2');
                   $useraddress->zipcode = $request->input('zipcode');
                   $useraddress->country = $request->input('country');
                   $useraddress->state = $request->input('state');
                   $useraddress->phoneno = $request->input('phoneno');
                   $useraddress->mobileno = $request->input('mobileno');
                   $useraddress->user_id = $userid;


                  $useraddress->save();
                    $addressId = $useraddress->id;
                  }
                   $oldCart = Session::get('cart');
                   $cart = new Cart($oldCart);
                   $totalPrice = $cart->totalPrice;
                   $newTotal = $request->input('amount');

       $coupon = Used_coupon::with('coupon','user')->orderBy('id','DESC')->first();
       $latestOrder = Order_detail::orderBy('created_at','DESC')->first();
       $id = Auth::User()->id;
       $order = new Order_detail();
       $order->user_id = $id;
       if($latestOrder==null){
         $order->order_no = 'OD'.'1'.'_'.time();
       }else{
          $order->order_no = 'OD'.($latestOrder->id + 1).'_'.time() ;
       }
       $order->cart = serialize($cart);
       $order->address_id =  $addressId;
       $order->total = $request->input('amount');
       $order->payment_mode = $request->input('PaymentMode');
       if($totalPrice>$newTotal){
          $order->coupon_id= $coupon->id;
        }

       $order->save();

       $user = Auth::User();
       $user->orderDetails()->attach(['order_id'=>$order->id],['order_nos'=>$order->order_no]);


       $order = Order_detail::find($order->id);

          $orders = unserialize($order->cart);

            foreach ($orders->items as $item) {
                 $cartdetails = new Cartdetail;
                    $cartdetails->order_id = $order->id;
                    $cartdetails->product_id=$item['item']['id'];
                    $cartdetails->product_name=$item['item']['name'];
                    $cartdetails->product_image=$item['image'];
                    $cartdetails->quantity=$item['qty'];
                    $cartdetails->price=$item['price'];
                    $cartdetails->category=$item['item']['category'][0]['id'];
                    $cartdetails->save();

                    $product = productattributesassoc::where('product_id',$item['item']['id'])->get();
                     foreach ($product as $dataid) {
                       $id=$dataid->id;
                     }
                     $productid = productattributesassoc::find($id);
                         $productquantity=$productid->quantity;
                         $productquantity = $productquantity-$item['qty'];

                       $dataupdate=array(
                         'quantity'=> $productquantity,
                       );
                     $productid->update($dataupdate);
                }
              DB::commit();

            }catch(Exception $e){
              DB::rollback();
            }


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('INR')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('INR')
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                DB::rollback();
                return Redirect::to('payonfo');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                  DB::rollback();
                return Redirect::to('payonfo');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('payonfo');

    }

    /**
    * Return payment status and payment_id
    *
    *
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
  public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
             $OId = Order_detail::latest()->first();
            $id = $OId->id;
            $cartdetails = Cartdetail::where('order_id',$id)->delete();
            $orderdelete = Order_detail::find($id);
            $orderdelete->delete();

            return Redirect::to('payonfo');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Order Placed Successfully');
             $id =  Auth::User()->id;
              $OId = Order_detail::latest()->first();
            $user =  Order_detail::where('user_id',$id)->where('id',$OId->id);
                $dataupdate = array(
                            'status'=> 'Processing',
                            'payment_id' => $payment_id

                               );

                     $user->update($dataupdate);
                     $order = Order_detail::find($OId->id);

                        $orders = unserialize($order->cart);

                      $email = Auth::User()->email;
                    Mail::to($email)->send(new Orderdetails($orders,$order));
                    $mail = Configuration::find(1);
                      Mail::to($mail->value)->send(new Orderdetails($orders,$order));
               Session::forget('cart');
            return Redirect::to('payonfo');
        }
        \Session::put('error', 'Payment failed,$payment_id');
           $OId = Order_detail::latest()->first();
            $id = $OId->id;
            $delete = Order_detail::find($id);

            $delete->delete();
           return Redirect::to('payonfo');
    }



}
