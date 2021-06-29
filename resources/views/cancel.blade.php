@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header bg-warning">
                     Cancelled
                </div>
                <div class="card-body">
                    You have cancelled your checkout. <a href="{{ route('categories.index') }}"> add new products</a>
                </div>
            </div>
        </div>
    </div>
@endsection
