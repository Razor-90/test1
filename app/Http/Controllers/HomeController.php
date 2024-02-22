<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $promoCodes = PromoCode::where('user_id', $user->id)->get();

        return view('home', compact('promoCodes'));
    }
	public function welcome()
	{
		return view('home');
	}


}
