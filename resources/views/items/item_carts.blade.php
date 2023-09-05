@extends('layouts.front-end')
@section('content')
    <div class="container my-5">
        <h3 class="text-center py-5">My Shopping Carts</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Item Discount</th>
                        <th>Item Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody id="cartTbody">
                    
                </tbody>
            </table>
        </div>
        <div class="d-grid gap-2 mb-5 pb-5">
            @guest
                <a href="/login" class="btn btn-primary" type="button">Login</a>
            @else
                <button class="btn btn-success" type="button" id="orderNow">Order Now</button>

            @endguest
        </div>
    </div>
    <div class="my-5 py-5"></div>
@endsection
@section('script')
    <script>
        let itemString = localStorage.getItem('heinShop_items');
        if(itemString){
            let itemArray = JSON.parse(itemString);
            let data = '';
            let total = 0;
            $.each(itemArray, function(i,v){
                let amount = v.price - ((v.discount/100)*v.price)
                data += `<tr class="text-center">
                        <td><img src="${v.image}" class="img-fluid w-25 h-25"></td>
                        <td>${v.name}</td>
                        <td>${v.price} MMK</td>
                        <td>${v.discount}%</td>
                        <td>${v.qty}</td>
                        <td>${v.qty * amount} MMK</td>
                    </tr>`;
                    total += Number(v.qty * amount);
            })
            data += `<tr>
                    <td colspan="5" class="text-center">Total</td>
                    <td>${total} MMK</td>
                </tr>`;
            $('#cartTbody').html(data);
        }

        $('#orderNow').click(function(){
            let itemString = localStorage.getItem('heinShop_items');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post("{{route('orderNow')}}",{data:itemString},function(respond){
                console.log(respond);
            })

        })    
    </script>
@endsection