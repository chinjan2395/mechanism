@extends('backLayout.app')
@section('title')
    Product
@stop

@section('content')

    <h1>Product</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>ID.</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $product->id }}</td>
                <td> {{ $product->name }} </td>
                <td> {{ $product->description }} </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection