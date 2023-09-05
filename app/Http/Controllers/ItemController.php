<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $items = Item::all();
        return view('items.index', compact('items','categories'));
    }

    // Filter items with category id
    public function itemCategory(string $category_id){
        $itemCategories = Item::where('category_id',$category_id)->get();
        return view('items.item_category', compact('itemCategories'));
    }

    public function itemCart(){
        return view('items.item_carts');
    }

    public function orderNow(Request $request){
        // dd($request);
        $dataArr = json_decode($request->data);
        // var_dump($dataArr);
        $date = date('Y-m-d h:i:s');
        $voucherNo = strtotime($date);
        // echo $voucherNo;

        foreach ($dataArr as $key => $data) {
            $order = new Order();
            $order->voucherNo = $voucherNo;
            $order->qty = $data->qty;
            $order->total = $data->qty * ($data->price - (($data->discount/100) * $data->price));
            $order->paymentSlip = '/images/slip.png';
            $order->payment_id = 1;
            $order->item_id = $data->id;
            $order->user_id = Auth::id();
            $order->save();

        }
        return 'Order Success';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $item = Item::find($id);
        $item_categoryID = $item->category_id;
        // dd($item_categoryID);
        $item_categories = Item::where('category_id',$item_categoryID)->orderBy('id','DESC')->limit(4)->get();
        // dd($item_categories);
        return view('items.detail', compact('item','item_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
