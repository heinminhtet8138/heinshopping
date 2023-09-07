<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
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
        $status = request('status');
        // dd($status);
        $orders = Order::all();
        // dd($orders);
        $voucherNoGroup = $orders->groupBy('voucherNo')->toArray();
        // dd($voucherNoGroup);
        foreach($voucherNoGroup as $group){
            $orderIds = array_column($group, 'id');
            // var_dump($orderIds);
            $ordersWithUser[] = Order::with('user')->whereIn('id', $orderIds)->where('status', $status)->first();
        }
        // dd($ordersWithUser);
        return view('admin.orders.index', compact('ordersWithUser'));
    }

    public function detail($voucherNo){
        // dd($voucherNo);
        $orders = Order::where('voucherNo', $voucherNo)->get();
        $ordersFirst = Order::where('voucherNo', $voucherNo)->first();

        return view('admin.orders.detail', compact('orders','ordersFirst'));
    }

    public function status(Request $request, $voucherNo){
        // dd($request,$voucherNo);
        Order::where('voucherNo', $voucherNo)->update(['status' => $request->status]);
        return redirect()->route('backend.orders.index');
    }
}
