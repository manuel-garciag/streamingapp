<?php

namespace App\Http\Controllers;

use App\Models\Qrcode;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /*
    * Return list products or only product search
    */
    public function products(Request $request)
    {
        if ($request->has('id')) {
            $id = $request->input('id');
            $products = Qrcode::find($id);
        } else {
            $products = Qrcode::all();
        }

        return response()->json($products);
    }

    /**
     * Return list transactions of user
     */
    public function transactions(Request $request)
    {
        $user = $request->user();
        $transactions = $user->transactions;

        /**
         * Config by return transaction and amount only
         */
        if ($request->has('onlyAmount')) {
            if ($request->input('onlyAmount') == "true") {
                $transactions = $transactions->map(function ($transaction) {
                    return [
                        'id' => $transaction->id,
                        'payment_method' => $transaction->payment_method,
                        'amount' => $transaction->amount,
                        'created_at' => $transaction->created_at,
                    ];
                });
            }
        }

        return response()->json($transactions);
    }
}
