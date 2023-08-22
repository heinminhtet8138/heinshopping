@extends('layouts.admin')
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="my-5">
            <h3 class="my-4 d-inline">Items</h3>
            <a href="{{route('items.create')}}" class="btn btn-primary float-end">Add Item</a>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Items List
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>codeNo</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>InStock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>codeNo</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>InStock</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->codeNo}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->discount}}</td>
                                <td>{{$item->inStock}}</td>
                                <td></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$items->links()}}
            </div>
        </div>
    </div>
</main>
@endsection