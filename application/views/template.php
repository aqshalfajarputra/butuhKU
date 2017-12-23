<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/style.css">


    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js'); ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js'); ?>"></script>
    <script type="text/javascript"
            src="<?php echo base_url('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'); ?>"></script>
    <link rel="stylesheet"
          href="<?php echo base_url('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'); ?>"/>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Butuh.ku</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>Kelas XIIRPL1</strong>
                                <span class="pull-right text-muted">
                                        <em>12.24 pm</em>
                                    </span>
                            </div>
                            <div>Kelas kami membutuhkan speaker poratble, digunakan untuk...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>Kelas XIIRPL1</strong>
                                <span class="pull-right text-muted">
                                        <em>12.24 pm</em>
                                    </span>
                            </div>
                            <div>Kelas kami membutuhkan speaker poratble, digunakan untuk...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Read All Messages</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->

            <!--DROP DOWN UNTUK ADMIN INSYAALLAH-->
            <!--<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Task 1</strong>
                                    <span class="pull-right text-muted">40% Complete</span>
                                </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Task 2</strong>
                                    <span class="pull-right text-muted">20% Complete</span>
                                </p>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Tasks</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                &lt;!&ndash; /.dropdown-tasks &ndash;&gt;
            </li>-->

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url(); ?>user/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">


                    <?php if ($this->session->userdata('jabatan') == 'user') {
                        echo '
                  <li >
                      <a href="' . base_url() . 'user/"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                  </li>
                  <li>
                      <a href="' . base_url() . 'user/lapor"><i class="fa fa-table fa-fw"></i> Lapor Kerusakan</a>
                  </li>
                  <li>
                      <a href="' . base_url() . 'user/pinjam"><i class="fa fa-handshake-o fa-fw"></i> Ajukan Peminjaman</a>
                  </li>
                  <li>
                      <a href="' . base_url() . 'user/aktivitas"><i class="fa fa-clock-o fa-fw"></i> Status Aktivitas</a>
                  </li>';
                    }
                    ?>

                    <!-- Admin -->
                    <?php if ($this->session->userdata('jabatan') == 'admin') {
                        echo '
                <li>
                    <a href="' . base_url() . 'admin/"> Dashboard</a>
                </li>
                <li>
                  <a href="' . base_url() . 'admin/laporan"> Laporan Kerusakan</a>
                </li>
                <li>
                   <a href="' . base_url() . 'admin/peminjaman"> Peminjaman Barang</a>
                </li>
                <li>
                   <a href="' . base_url() . 'admin/barang"> Daftar Barang</a>
                </li>               
                <li>
                   <a href="' . base_url() . 'admin/history"> History</a>
                </li>               

                ';
                    }
                    ?>

                    <!-- Super Admin -->
                    <?php if ($this->session->userdata('jabatan') == 's_admin') {
                        echo '
              <li>
                  <a href="' . base_url() . 's_admin/"> Dashboard</a>
              </li>
              <li>
                  <a href="' . base_url() . 's_admin/user"> Users</a>
              </li>
            ';
                    }
                    ?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <?php
            $this->load->view($main_view);
            ?>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


</div>
<!-- /#wrapper -->

<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

<!-- jQuery -->
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- jQuery -->

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris-data.js"></script>

<!-- Flot Charts JavaScript -->
<!--[if lte IE 8]>
<script src="js/excanvas.min.js"></script><![endif]-->
<script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/flot/flot-data.js"></script>

</body>

</html>
