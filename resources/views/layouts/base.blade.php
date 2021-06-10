<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.partials._styles')

    <!-- just in case when we need additional styles -->
    @yield('styles')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.partials._navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.partials._sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('main')
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('layouts.partials._footer')

    </div>
    <!-- ./wrapper -->

    @include('layouts.partials._scripts')
    @yield('scripts')
</body>

</html>