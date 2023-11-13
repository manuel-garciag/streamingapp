<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Omnipay\Omnipay;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay()
    {
        try {

            //Get ID from url before send request
            $previous = url()->previous();
            $arrUrl = explode('/', $previous);
            $qrcode_id = last($arrUrl);
            //Consult ID in DB by get amount
            $qrcode = DB::table('qrcodes')->find($qrcode_id);

            $response = $this->gateway->purchase(array(
                'amount' => $qrcode->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array('payer_id' => $request->input('PayerID'), 'transactionReference' => $request->input('paymentId')));
            $response = $transaction->send();
            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                //Transaccion //
                //Get ID from url before send request
                $previous = url()->previous();
                $arrUrl = explode('/', $previous);
                $qrcode_id = last($arrUrl);
                //Consult ID in DB by get amount
                $qrcode = DB::table('qrcodes')->find($qrcode_id);

                $payTransaction = new Transaction();
                $payTransaction->user_id = Auth::id();
                $payTransaction->qrcode_owner_id = $qrcode->user_id;
                $payTransaction->qr_code_id = $qrcode->id;
                $payTransaction->payment_method = "PAY";
                $payTransaction->message = "MSG";
                $payTransaction->amount = $payment->amount;
                $payTransaction->status = "1";
                $payTransaction->save();

                // Redirige a la página de transacciones después de guardar los datos
                return redirect()->route('transactions.index')->with('success', 'Payment is Successful. Your Transaction Id is: ' . $arr['id']);
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Payment declined!!';
        }
    }
    public function error()
    {
        return 'User declined the payment!';
    }
}
