<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Temaz | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <base href="{{asset('')}}">
    <link href="admin/assets/global/css/font.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="admin/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="admin/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="admin/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="admin/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="admin/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="admin/assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin/assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="admin/assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    @yield('style')
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
@include('admin.layouts.header')
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
@include('admin.layouts.sidebar')
<!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    @yield('content')
<!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
@include('admin.layouts.sidebar-right')
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('admin.layouts.footer')
<!-- END FOOTER -->
<script src="admin/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="admin/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="admin/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="admin/assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
<script type="text/javascript">
    toastr.options = {
        closeButton: true,
        debug: false,
        positionClass: "toast-bottom-right",
        onclick: null,
        showDuration: "1000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
    @if (Session::has('error'))
        toastr['error']('{!! Session::get("error") !!}');
    @elseif(Session::has('success'))
        toastr['success']('{!! Session::get("success") !!}');
    @elseif(Session::has('warning'))
        toastr['warning']('{!! Session::get("warning") !!}');
    @endif
</script>
@yield('script')
</body>

</html>