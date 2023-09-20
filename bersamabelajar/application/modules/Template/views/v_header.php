<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Learning Candy</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables/dataTables.bootstrap4.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.css">
    <!-- CSS TOASTR -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/izitoast/css/iziToast.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datetimepicker/jquery.datetimepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/timer/timeTo.css">
    <link href="<?= base_url('assets/') ?>plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- JS Libraies -->
    <script src="<?= base_url() ?>assets/plugins/izitoast/js/iziToast.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/tabledit/jquery.tabledit.js"></script>

    <script src="<?= base_url() ?>assets/plugins/fileinput/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/plugins/fileinput/js/locales/fr.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/plugins/fileinput/js/locales/es.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/plugins/fileinput/themes/fas/theme.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/plugins/fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>

    <script src="<?= base_url('assets/') ?>plugins/timer/jquery.time-to.js"></script>
    <style>
        .full_modal-dialog {
            width: 98% !important;
            height: 92% !important;
            min-width: 98% !important;
            min-height: 92% !important;
            max-width: 98% !important;
            max-height: 92% !important;
            padding: 0 !important;

        }

        .full_modal-content {
            height: 99% !important;
            min-height: 99% !important;
            max-height: 99% !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <!-- Site wrapper -->
    <div class="wrapper">