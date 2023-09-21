<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('backend.layouts.head')
@include('backend.layouts.header')
@include('backend.layouts.sidebar')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @yield('content')
    </div>
</body>

@include('backend.layouts.footer')
@yield('js')

</html>
