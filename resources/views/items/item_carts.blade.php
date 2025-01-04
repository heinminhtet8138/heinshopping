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
        <div class="d-grid gap-2">
            @guest
                <a href="/login" class="btn btn-primary" type="button">Login</a>

            @else   
                {{-- <button class="btn btn-primary" type="button" id="orderNow">Order Now</button> --}}
                <form id="paymentForm" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="paymentSlip">Payment Slip</label>
                        <input type="file" class="form-control" name="paymentSlip" id="paymentSlip" accept="image/*">
                        
                    </div>
                    <div class="col-md-6">
                        <label for="paymentMethod"></label>
                        <select name="paymentMethod" id="paymentMethod" class="form-select">
                            <option value="">Choose payment method</option>
                            @foreach ($payments as $payment)
                                <option value="{{$payment->id}}">{{$payment->name}}</option>
                                
                            @endforeach
                            <!-- Add other options as needed -->
                        </select>
                    </div>
                    
                    <!-- Add other form fields here as needed -->
                    <button type="submit" class="btn btn-primary my-3">Order Now</button>
                </form>
            @endguest
          </div>
    </div>

<!-- Success Model -->
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="orderSuccessModalLabel">Item Order Success</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="text-center">
                <h1 class="text-success fs-1"><i class="bi bi-check-circle-fill"></i></h1>
                <p>Your order is successful!</p>
            </div>          
        </div>
        <div class="modal-footer">
            <a href="/" class="btn btn-primary">Ok</a>
        </div>
        </div>
    </div>
</div>

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

        // $('#orderNow').click(function(){
        //     let itemString = localStorage.getItem('heinShop_items');
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.post("{{route('orderNow')}}",{data:itemString},function(respond){
        //         console.log(respond);
        //     })
        // }) 
     
        // Ajax with form data

        $(document).ready(function () {
            $('#paymentForm').on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this);
                console.log(formData);

                // Serialize and include localStorage data

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let itemString = localStorage.getItem('heinShop_items');
                formData.append('orderItems',itemString);
                // processData: false,
                // contentType: false, ပေးမှသာ form data ပို့လို့ရ
                // jQuery ကို formData ခေါင်း စဉ်တွေ သက်မှတ်ချက်တွေမထားဖို့ပြောတာ

                $.ajax({
                    type: 'POST',
                    url: "{{route('orderNow')}}", // Replace with your route
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response){
                            $('#orderSuccessModal').modal('show');
                            localStorage.clear();

                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
    });
});

    
    </script>
@endsection