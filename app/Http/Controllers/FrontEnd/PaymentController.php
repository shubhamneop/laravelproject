<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Sample;
use App\Order_detail;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use Auth;
use App\Cart;
use App\User_order;
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
     public function payWithpaypal(Request $request)
    {
         $this->validate($request,[
            'fullname'=>'required',
            'address1'=>'required',
            'zipcode'=>'required|numeric',
            'country'=>'required|alpha',
            'state'=>'required|alpha',
            'mobileno'=>'required|numeric',


         ]);

          if(!Session::has('cart')){
             return view('Frontend.cart',['products'=>null]);
                 }
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);


         $id = Auth::User()->id;
       $order = new Order_detail();
       $order->user_id = $id;
       $order->cart = serialize($cart);
       $order->address = serialize($request->all());

       $order->save();

       $save = new User_order();

       $save->user_id = $id;
       $save->order_id = $order->id;

       $save->save();






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
                return Redirect::to('payonfo');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
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
            $delete = Order_detail::find($id);

            $delete->delete();

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
               Session::forget('cart');
            return Redirect::to('payonfo');
        }
        \Session::put('error', 'Payment failed,$payment_id');
           $OId = Order_detail::latest()->first();
            $id = $OId->id;
            $delete = Order_detail::find($id);
            dd($delete);
            $delete->delete();

           return Redirect::to('payonfo');
    }



}
