<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Models\PaymentMethod;

class WalletController extends Controller {
    public function index(Request $request) {
        $user = $request->user();
        return view('wallet.index', [
            'user' => $user, 
            'payment_methods' => PaymentMethod::all(), 
        ]); 
    }
}  