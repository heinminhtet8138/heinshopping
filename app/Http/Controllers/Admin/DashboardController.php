<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware(function($request, $next){
            
            if(in_array(Auth::user()->role, ['Super Admin','Admin'])){
                return $next($request);
            }else{
                return back();
            }
        });
    }

    public function index(){
        return view('admin.index');
    }
}
