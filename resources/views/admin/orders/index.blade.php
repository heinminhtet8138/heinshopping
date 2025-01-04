@extends('layouts.admin')
@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="my-5">
            <h3 class="my-4 d-inline">
                @if (Request::is('backend/orderAccept'))
                    Order Accept
                @elseif(Request::is('backend/orderComplete'))
                    Order Complete
                @else
                    Order Pending
                @endif
            </h3>

            <a href="{{route('backend.orderComplete')}}" class="btn btn-success float-end mx-3">Order Complete List</a>
            <a href="{{route('backend.orderAccept')}}" class="btn btn-primary float-end">Order Accept List</a>

        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Order List
            </div>
            <div class="card-body">
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>voucherNo</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Paymet Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>voucherNo</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Paymet Type</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="item_tbody">
                        @foreach ($ordersWithUser as $order)
                            @if ($order !== null)
                                <tr>
                                    <td>{{$order->voucherNo}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td><span class="badge {{$order->status == 'Pending' ? 'text-bg-danger' : ($order->status == 'Accept' ? 'text-bg-primary' : 'text-bg-success')}}">{{$order->status}}</span></td>
                                    <td>{{$order->payment->name}}</td>

                                    
                                    <td>
                                        <a href="{{route('backend.orders.detail',$order->voucherNo)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-info"></i> Detail</a>
                                        
                                    </td>

                                </tr>  
                            @endif
                        @endforeach
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')

@endsection
