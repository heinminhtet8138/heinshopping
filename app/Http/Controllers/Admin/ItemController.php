<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemUpdateRequest;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate('10');
        return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        // dd($request);
        $items = Item::create($request->all());

        //image upload
        $fileName = time().'.'.$request->image->extension();

        $upload = $request->image->move(public_path('images/'), $fileName);

        if($upload){
            $items->image = "/images/".$fileName;
        }

        $items->save();

        return redirect()->route('backend.items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('admin.items.edit',compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemUpdateRequest $request, string $id)
    {
        // dd($request);
        $item = Item::find($id);
        $item->update($request->all());
        
        if($request->hasFile('new_image')){
            $fileName = time().'.'.$request->new_image->extension();

            $upload = $request->new_image->move(public_path('images/'), $fileName);

            if($upload){
                $item->image = "/images/".$fileName;
            }
        }else {
            $item->image = $request->old_image;
        }

        $item->save();
        return redirect()->route('backend.items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('backend.items.index');

    }
}
