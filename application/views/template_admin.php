<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<?php $current_user = wp_get_current_user(); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/selectize.default.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/font-awesome.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/custom.css">
  <link href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.css" rel="stylesheet">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/skin-blue.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.core.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.default.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bar.chart.min.css">

  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="<?php echo site_url() ?>">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
        <a href="<?php echo site_url('logout') ?>">Logout</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        </div>
</nav>
</head>

<body class="bg-light h-100-p">
 
 
 <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>assets/js/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.spinner.js"></script>
  <!-- Jquery -->
  <script src="<?php echo base_url();?>assets/js/currencyFormatter.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/cleave.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/numeral.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/js/selectize.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/d3.min.js" type="text/javascript"></script>
  
            <div class="row">
              <?php echo $contents; ?>
            </div>

<script>
  var base_url="<?php echo base_url(); ?>"
</script>
          
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
  
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- CUSTOM JS -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<!-- SPARKLINE -->
<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.spinner.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-input-spinner.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.bar.chart.min.js"></script>
          
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

</body>
</html>
