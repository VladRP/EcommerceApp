@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card ">
            <div class="card-header bg-success text-white">
                Success
            </div>
            @if(session()->has('something'))
                <p>Has</p>
            @endif
            <div class="card-body">
                Your order has been placed successfully. <a href="{{ route('categories.index') }}">Continue Shopping</a>
            </div>
            </div>
        </div>
    <div>
@endsection
