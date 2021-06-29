@extends('layouts.app')

@section('content')
    <h1>Your shopping cart</h1>
        <table>
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Brand</th>
                    <th scope="col">     </th>
                    <th scope="col">Quantity</th>
                    <th scope="col">     </th>
                    <th scope="col">Price</th>
                    <th scope="col">     </th>
                </tr>
            </thead>
            @foreach($cartitems as $cartitem)
                @if($cartitem->quantity!=0)
                    <tr scope="row">
                        <td>{{$cartitem->product->title}}</td>
                        <td>{{$cartitem->product->description}}</td>
                        <td>{{$cartitem->product->brand}}</td>
                        <td>
                            <form id="decrease-increase-form" action="/cartitems/decrease/{{$cartitem->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="Submit" class="btn btn-danger">-</button>
                            </form>
                        </td>
                        <td>{{$cartitem->quantity}}</td>
                        <td>
                            <form id="decrease-increase-form" action="/cartitems/increase/{{$cartitem->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="Submit" class="btn btn-primary">+</button>
                            </form>
                        <td>
                        <td>{{$cartitem->total_price}}</td>
                        <td>{{Config::get('constants.CURRENCY')}}</td>
                        <td>
                            <form action="/cartitems/{{$cartitem->id}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type='hidden' name="id" value="{{$cartitem->id}}">
                                <button type=submit class="btn btn-danger">Deletefromcart</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    <p>Total cost: {{ number_format($cartitems->sum('total_price'), 0) }} {{Config::get('constants.CURRENCY')}}</p>
    @if($cartitems->count()!=0)
        <button class="btn btn-primary btn-block" id="checkout-button"><i class="fa fa-cc-stripe"></i> Pay {{ number_format($cartitems->sum('total_price'), 0) }}</button>
        <a class="btn btn-primary" href="{{route('success')}}" style="width:100%">Pay to courier</a>
    @endif
    <h3>Transport tax is {{Config::get('constants.TRANSPORT_TAX')}} {{Config::get('constants.CURRENCY')}}.</h3>
    <h5>If the order exceeds {{Config::get('constants.TRANSPORT_FREE')}} {{Config::get('constants.CURRENCY')}}, the transport is free.</h5>
@endsection
@push('header')
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
@endpush
@push('footer')
    <script type="text/javascript">
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        var checkoutButton = document.getElementById("checkout-button");
        var form
        checkoutButton.addEventListener("click", function () {
            fetch("{{ route('checkout') }}", {
            method: "POST",
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (session) {
            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
            if (result.error) {
                alert(result.error.message);
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
    });
</script>
@endpush
