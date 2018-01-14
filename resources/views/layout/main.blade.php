<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layout.header')        
    </head>
    

<body class="pattern-1">
<div class="boxed">
    @include('layout.account')

    @include('layout.nav') 

    @yield('content')

    @include('layout.footer')
    <div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>

</div>

</body>
</html>