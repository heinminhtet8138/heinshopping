<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        $voucherNoGroups = $orders->groupBy('voucherNo')->toArray();
        foreach ($voucherNoGroups as $voucherNo => $group) {
            $orderIds = array_column($group, 'id');
            $ordersWithUser[] = Order::with('user')->whereIn('id', $orderIds)->where('status','Pending')->first();
        }
        // dd($ordersWithUser);
        return view('admin.orders.index', compact('voucherNoGroups','ordersWithUser'));

    }

    public function orderAccept(){
        $orders = Order::all();
        $voucherNoGroups = $orders->groupBy('voucherNo')->toArray();
        foreach ($voucherNoGroups as $voucherNo => $group) {
            $orderIds = array_column($group, 'id');
            $ordersWithUser[] = Order::with('user')->whereIn('id', $orderIds)->where('status','Accept')->first();
        }
        // dd($ordersWithUser);
        return view('admin.orders.index', compact('voucherNoGroups','ordersWithUser'));

    }

    public function orderComplete(){
        $orders = Order::all();
        $voucherNoGroups = $orders->groupBy('voucherNo')->toArray();
        foreach ($voucherNoGroups as $voucherNo => $group) {
            $orderIds = array_column($group, 'id');
            $ordersWithUser[] = Order::with('user')->whereIn('id', $orderIds)->where('status','Complete')->first();
        }
        // dd($ordersWithUser);
        return view('admin.orders.index', compact('voucherNoGroups','ordersWithUser'));

    }

    public function detail($voucherNo){
        $orders = Order::where('voucherNo',$voucherNo)->get();
        $orderFirst = Order::where('voucherNo',$voucherNo)->first();
        // dd($orders);
        return view('admin.orders.detail',compact('orders','orderFirst'));
    }

    public function status(Request $request, $voucherNo){
        // dd($request->status);
        Order::where('voucherNo', $voucherNo)->update(['status' => $request->status]);

        return redirect()->route('backend.orders');

    }
}
