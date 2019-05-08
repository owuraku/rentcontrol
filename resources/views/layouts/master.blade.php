@include('layouts.header')

<body class="animsition">
    @include('layouts.menu')
    @yield('content')
    @include('layouts.footer')
    @yield('scripts')

</body>
</html>
