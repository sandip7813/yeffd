<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //
    }

    public function donations(){
        $donationsArr = DB::table('donations')
                        ->orderBy('created_at', 'desc')
                        ->paginate(25);
        
        //dd( $donationsArr );

        return view('admin.admin-general.donations', compact('donationsArr'));
    }
}
