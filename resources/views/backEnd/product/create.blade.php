@extends('backLayout.app')
@section('title')
    Create new Product
@stop

<style type="text/css">
    .btn-bs-file {
        position: relative;
    }

    .btn-bs-file input[type="file"] {
        position: absolute;
        top: -9999999;
        filter: alpha(opacity=0);
        opacity: 0;
        width: 0;
        height: 0;
        outline: none;
        cursor: inherit;
    }
</style>
@section('content')

    <h1>Create New Product</h1>
    <hr/>

    {!! Form::open(['url' => 'admin/product', 'class' => 'form-horizontal','files'=>true]) !!}

    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
        {!! Form::label('amount', 'Price: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('amount', null, ['class' => 'form-control','min'=>0]) !!}
            {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
        {!! Form::label('quantity', 'Quantity: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('quantity', null, ['class' => 'form-control','min'=>0]) !!}
            {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('image', 'Image: ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div class="jc-demo-box">
                <label class="btn-bs-file btn btn-primary">
                    Browse
                    <input id="uploadImage" class="btn btn-primary form-control" type="file" name="product_image"
                           onchange="PreviewImage();"/>
                </label>
                <script type="text/javascript">

                    function PreviewImage() {
                        var oFReader = new FileReader();
                        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                        oFReader.onload = function (oFREvent) {
                            document.getElementById("cropbox").src = oFREvent.target.result;
                        };
                    }

                    function initJcrop() {
                        $('#cropbox').Jcrop({
                            aspectRatio: 1,
                            onSelect: updateCoords
                        });

                        function updateCoords(c) {
                            console.log('c', c);
                            $('#x').val(c.x);
                            $('#y').val(c.y);
                            $('#w').val(c.w);
                            $('#h').val(c.h);
                        }

                    }
                </script>

                <input type="hidden" id="x" name="x"/>
                <input type="hidden" id="y" name="y"/>
                <input type="hidden" id="w" name="w"/>
                <input type="hidden" id="h" name="h"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('description', ' ', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6 col-md-6">
            <img id="cropbox" class="img-responsive"/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
            {!! Form::hidden('added_by', $user->id) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection