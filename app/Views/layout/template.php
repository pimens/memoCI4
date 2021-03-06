<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $this->renderSection('title'); ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link href="<?php echo base_url(); ?>/assets/jquery.dataTables.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/sweetalert.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo base_url(); ?>/assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <!-- <link href="<?php echo base_url(); ?>/assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all"> -->
    <link href="<?php echo base_url(); ?>/assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>/assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Main CSS-->
    <link href="<?php echo base_url(); ?>/assets/css/theme.css" rel="stylesheet" media="all">


</head>

<body class="animsition">
    <div class="page-wrapper">
        <?= $this->include('layout/header'); ?>
        <div class="container-fluid">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>/assets/vendor/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/jquery.dataTables.js"></script>
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>


    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo base_url(); ?>/assets/vendor/wow/wow.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>/assets/vendor/animsition/animsition.min.js"></script> -->
    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo base_url(); ?>/assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo base_url(); ?>/assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/select2/select2.min.js">
    </script>
    <script src="<?php echo base_url(); ?>/assets/js/main.js"></script>
    <?= $this->renderSection('js'); ?>
</body>

</html>