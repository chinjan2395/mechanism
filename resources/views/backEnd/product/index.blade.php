@extends('backLayout.app')
@section('title')
    Product
@stop

@section('content')

    <h1>Product <a href="{{ url('admin/product/create') }}" class="btn btn-primary pull-right btn-sm">Add New
            Product</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tbl_admin_product">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($product as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('admin/product', $item->id) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->getPrice()->amount }}</td>
                    <td>{{ $item->getQuantity()->quantity }}</td>
                    <td>
                        <a href="{{ url('admin/product/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/product', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tbl_admin_product').DataTable({
                columnDefs: [{
                    targets: [0],
                    visible: false,
                    searchable: false
                }
                ],
                order: [[0, "asc"]]
            });
        });
    </script>
@endsection