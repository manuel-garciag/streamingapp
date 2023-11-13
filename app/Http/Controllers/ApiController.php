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
}
