<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class PointTransactionController extends Controller
{
    public function recordTransaction(Request $request)
    {
        $user = $request->user();

        $transaction = new PointTransaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $request->amount;
        $transaction->type = $request->type;
        $transaction->status = $request->status;
        $transaction->proof = $request->proof;
        $transaction->save();

        return response()->json([
            'success' => true,
        ]);
    }

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
