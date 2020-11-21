<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

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

use Illuminate\Support\Facades\Mail;
use App\Mail\DonationEmail;

class PaymentController extends Controller {

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
    public function index()
    {
        return view('paywithpaypal');
    }

    public function payment(Request $request){

        $amount_array   = array(10, 50, 100, 200, 500);

        return view('paywithpaypal')->with('amount_array', $amount_array);
    }

    public function paywithpaypal(Request $request){
        $this->validate($request, [
            'first_name'        => 'required|max:200',
            'last_name'         => 'required|max:200',
            'email_id'          => 'required|regex:/^.+@.+$/i',
            'donation_amount'   => 'required'
        ]);

        $donation_amt   = $request->donation_amount;

        $donation_id = DB::table('donations')->insertGetId(
                        array(
                            'first_name'        => $request->first_name, 
                            'last_name'         => $request->last_name,
                            'email_id'          => $request->email_id,
                            'mobile_num'        => $request->mobile_num,
                            'donation_amt'      => $request->donation_amount,
                            'message'           => $request->message,
                            'payment_status'    => 'pending', 
                            'created_at'        => \Carbon\Carbon::now(),
                            'updated_at'        => \Carbon\Carbon::now()
                        )
        );
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//       
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Y.E.F.F.D - Donation') /** item name **/
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setSku($donation_id)
                ->setPrice($donation_amt); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array());

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($donation_amt);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Y.E.F.F.D - Donation - for the amount $' . $donation_amt);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->_api_context);
        } 
        catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/donate');
            } 
            else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/donate');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        $paypal_payment_id  = $payment->getId();
        Session::put('paypal_payment_id', $paypal_payment_id);

        //+++++++++++++++++++ UPDATE PAYMENT ID TO DATABASE :: Start +++++++++++++++++++//
        DB::table('donations')
            ->where('id', $donation_id)
            ->update([
                'paymentId' => $paypal_payment_id
            ]);
        //+++++++++++++++++++ UPDATE PAYMENT ID TO DATABASE :: End +++++++++++++++++++//

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/donate');
    }
    
    

    public function getPaymentStatus(Request $request){
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {

            //+++++++++++++++++++ UPDATE DONATION TABLE :: Start +++++++++++++++++++//
            DB::table('donations')
                ->where('paymentId', $payment_id)
                ->update([
                    'payment_status' => 'failed',
                    'updated_at'     => \Carbon\Carbon::now()
                ]);
            //+++++++++++++++++++ UPDATE DONATION TABLE :: End +++++++++++++++++++//

            \Session::put('error', 'Payment failed');
            return Redirect::to('/donate');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {
            //+++++++++++++++++++ UPDATE DONATION TABLE :: Start +++++++++++++++++++//
            DB::table('donations')
                ->where('paymentId', $payment_id)
                ->update([
                    'payment_status'    => 'success',
                    'PayerID'           => $request->get('PayerID'),
                    'token'             => $request->get('token'),
                    'updated_at'        => \Carbon\Carbon::now()
                ]);
            //+++++++++++++++++++ UPDATE DONATION TABLE :: End +++++++++++++++++++//
            
            //+++++++++++++++++++ SEND EMAIL :: Start +++++++++++++++++++//
            /* $donation_array = DB::table('donations')
                                ->where('paymentId', $payment_id)
                                ->first();
            
            Mail::to('sandip_nandy2005@yahoo.com')
                    ->send(new DonationEmail($donation_array)); */
            //+++++++++++++++++++ SEND EMAIL :: End +++++++++++++++++++//
            
            \Session::put('success', 'Your Payment is Successful.');
            return Redirect::to('/donate');

        }

        \Session::put('error', 'Sorry! Payment failed.');
        return Redirect::to('/donate');

    }

}