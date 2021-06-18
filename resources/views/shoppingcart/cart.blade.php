@extends('layouts.app')
<script>
function multiply(element) {
    var form = element.form;
    form.price.value = element.value * form.price.value;
}
</script>
@section('content')

    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Instock</th>
            <th>Brand</th>
            <th>Quantity</th>
        </tr>
        @foreach(Session::get('products') as $product) 
            <tr>
                <td>{{$product['title']}}</td>
                <td>{{$product['description']}}</td>
                <td>{{$product['instock']}}</td>
                <td>{{$product['brand']}}</td>
            <td>
                <form>
                    <input type="hidden" name="price" value={{$product['price']}}>
                    <input name="QTY" onKeyUp="multiply(this)">
                    <input name="total" readonly>
                </form>
            </td>
            </tr>
        @endforeach
        </table>
