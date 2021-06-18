@extends('layouts.app')

<script>
    function multiply(element) 
    {
        var form = element.form;
        form.total.value = element.value * form.price.value;
        add_prices(element);
        
    }

    function add_prices(element)
    {   
        var form = element.form;
        var values = [];
        $("input[name='total']").each(function() {
            values.push(parseFloat($(this).val()));
            });
        
        form.total_price.value = values.reduce((a, b) => a + b);
        //form.total_price.onChange();
    }
</script>

@section('content')
@if(Session::get('products'))
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Instock</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    
        @foreach(Session::get('products') as $product) 
            <tr>
                <td>{{$product['title']}}</td>
                <td>{{$product['description']}}</td>
                <td>{{$product['in_stock']}}</td>
                <td>{{$product['brand']}}</td>
                <td>
                    <form id="form_for_price">
                        <input type="hidden" name="price" value={{$product['price']}}>
                        <input name="qty" value=1 onKeyUp="multiply(this);add_prices(this)">
                        <input name="total" value={{$product['price']}} readonly>
                </form>
                </td>
            </tr>
        @endforeach
    </table>
    Total price:<input type="number" name="total_price" form="form_for_price" onClick ="add_prices(this)" >
    
    @else
        <p> No products added to cart </p>
    @endif
@endsection