<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('backLayout.header')

<div class="col-md-3 left_col">
    @include('backLayout.sidebarMenu')
</div>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        @include('backLayout.topMenu')
    </div>
</div>
<!-- /top navigation -->
<!-- page content -->
<div class="right_col" role="main">
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li style="list-style: none">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @yield('content')
</div>
<!-- /page content -->
@include('backLayout.footer')