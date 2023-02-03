<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Telemedicine</title>

    <x-admin-prerendered-assets></x-admin-prerendered-assets>

</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">

        <x-admin-navbar/>


        <x-admin-sidebar/>

        <x-admin-content/>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        
        <x-admin-footer/>
    </div>
    <!-- ./wrapper -->

    
    <x-admin-postrendered-assets/>
    @yield('datatable-script')
</body>
</html>
