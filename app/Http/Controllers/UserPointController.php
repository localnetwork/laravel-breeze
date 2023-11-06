<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPointController extends Controller
{
    public function addPoints(Request $request)
    {
        $user = $request->user();

        $user->points += $request->points;
        $user->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function subtractPoints(Request $request)
    {
        $user = $request->user();

        $user->points -= $request->points;
        $user->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function getBalance(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'balance' => $user->points,
        ]);
    }
}
