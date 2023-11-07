<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage; 
use App\Models\PointTransaction;  
use Illuminate\Support\Facades\Redirect;
use ProtoneMedia\Splade\Facades\Toast; 

class PointTransactionController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id; 

        if($user->role_id === 1 || $user->role_id === 2) {
            $this->validate($request, [
                'amount' => 'required|numeric|min:1',
            ]);

            if($request->hasFile('proof')) {
                $path = Storage::putFile('point-transactions', $request->file('proof')); 
            } 
    
            PointTransaction::create([
                'user_id' => $user_id,
                'amount' => $request->input('amount'), 
                'proof' => $path, 
                'type' => 'topup',
                'status' => 'pending', 
            ]);
            
    
            Toast::title('Success')->message('Transaction has been created pending for approval.')->success()->rightTop()->autoDismiss(3);
    
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
