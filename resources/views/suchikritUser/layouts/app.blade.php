<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('suchikritUser.layouts.head')
@include('suchikritUser.layouts.header')
@include('suchikritUser.layouts.sidebar')


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @yield('content')

    </div>
</body>

@include('suchikritUser.layouts.footer')
@yield('js')

</html>
