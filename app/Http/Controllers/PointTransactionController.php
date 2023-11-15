<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;  



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage; 
use App\Models\PointTransaction;  
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast; 

use ProtoneMedia\Splade\FileUploads\HandleSpladeFileUploads;  


class PointTransactionController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id; 

        if($user->role_id === 1 || $user->role_id === 2) {
            $this->validate($request, [
                'amount' => 'required|numeric|min:1',
                'proof' => 'required|image|mimes:jpeg,jpg,png,webp', 
                'payment_method' => 'required', 
            ]);

            if ($request->hasFile('proof')) {
                // $path = $request->file('proof')->store('public/point-transactions');
                $path = $request->file('proof')->store('public/point-transactions');
            }

            PointTransaction::create([
                'user_id' => $user_id,
                'amount' => $request->input('amount'), 
                'proof' => $path, 
                'payment_method' => $request->input('payment_method'), 
                'type' => 'topup',
                'status' => 'pending', 
            ]);
        
    
            Toast::title('Success')->message('Transaction has been received and pending for approval.')->success()->rightTop()->autoDismiss(5);
    
            return Redirect::route('wallet.index');
        }else {
    
            Toast::title('Whoops!')
                ->message('You are not allowed to do this function')
                ->warning()
                ->rightTop()
                ->autoDismiss(3);
    
            return Redirect::route('wallet.index');
        }

    }

    // // Store a new tree in the database
    // public function store(Request $request) 
    // {
    //     $request->validate([
    //         'amount' => 'required|string|max:255',
    //     ]);

    //     // Create a new tree in the database
    //     PointTransaction::create($request->all());
        
    //     // return Redirect::back();
    //     Toast::title('Success')->message('Test added successfully.')->success()->rightTop()->autoDismiss(3); 

    //     // Redirect back to the form with a success message
    //     return redirect()->route('wallet.index')->with('success', 'Tree added successfully');
    // }   

    public function getHistory(Request $request)
    {
        $user = $request->user();

        $transactions = $user->pointTransactions()->orderBy('created_at', 'desc')->get();

        return response()->json([
            'transactions' => $transactions,
        ]);
    }

    public function viewTransaction(Request $request, $id)
    {
        $transaction = PointTransaction::find($id);

        return response()->json([
            'transaction' => $transaction,
        ]);
    }
}
