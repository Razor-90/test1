<?php

namespace App\Http\Controllers;

use App\PromoCode;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function showCabinet()
    {
        $user = Auth::user();
        $promoCodes = PromoCode::where('user_id', $user->id)->oldest('promo_code_selection_date')->get();

        return view('home', compact('promoCodes'));
    }

}
