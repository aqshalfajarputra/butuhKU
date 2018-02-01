<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>butuhKU</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/dist/img/Slice_11.png"/>

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
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"
    " rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/style.css">


    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">

    <style>
        .badge-notify {
            background: red;
        }

        .pending {
            background-color: #ffbb33;
        }

        .dipinjam {
            background-color: #00C851;
        }

        .selesai {
            background-color: #4285F4;
        }

        /*Some CSS*/
        * {
            margin: 0;
            padding: 0;
        }

        .magnify {
            width: 200px;
            margin: 50px auto;
            position: relative;
            cursor: none
        }

        /*Lets create the magnifying glass*/
        .large {
            width: 175px;
            height: 175px;
            position: absolute;
            border-radius: 100%;

            /*Multiple box shadows to achieve the glass effect*/
            box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85),
            0 0 7px 7px rgba(0, 0, 0, 0.25),
            inset 0 0 40px 2px rgba(0, 0, 0, 0.25);

            /*hide the glass by default*/
            display: none;
        }

        /*To solve overlap bug at the edges during magnification*/
        .small {
            display: block;
        }

        .styled-input-single {
            position: relative;
            padding: 20px 0 20px 40px;
            text-align: left;
        }

        .styled-input-single label {
            cursor: pointer;
        }

        .styled-input-single label:before, .styled-input-single label:after {
            content: '';
            position: absolute;
            top: 50%;
            border-radius: 50%;
        }

        .styled-input-single label:before {
            left: 0;
            width: 30px;
            height: 30px;
            margin: -15px 0 0;
            background: #f7f7f7;
            box-shadow: 0 0 1px grey;
        }

        .styled-input-single label:after {
            left: 5px;
            width: 20px;
            height: 20px;
            margin: -10px 0 0;
            opacity: 0;
            background: #37b2b2;
            -webkit-transform: translate3d(-40px, 0, 0) scale(0.5);
            transform: translate3d(-40px, 0, 0) scale(0.5);
            -webkit-transition: opacity 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
            transition: opacity 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
            transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out;
            transition: opacity 0.25s ease-in-out, transform 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
        }

        .styled-input-single input[type="radio"],
        .styled-input-single input[type="checkbox"] {
            position: absolute;
            top: 0;
            left: -9999px;
            visibility: hidden;
        }

        .styled-input-single input[type="radio"]:checked + label:after,
        .styled-input-single input[type="checkbox"]:checked + label:after {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }

        .styled-input--square label:before, .styled-input--square label:after {
            border-radius: 0;
        }

        .styled-input--rounded label:before {
            border-radius: 10px;
        }

        .styled-input--rounded label:after {
            border-radius: 6px;
        }

        .styled-input--diamond .styled-input-single {
            padding-left: 45px;
        }

        .styled-input--diamond label:before, .styled-input--diamond label:after {
            border-radius: 0;
        }

        .styled-input--diamond label:before {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .styled-input--diamond input[type="radio"]:checked + label:after,
        .styled-input--diamond input[type="checkbox"]:checked + label:after {
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            opacity: 1;
        }



    </style>


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
            <a class="navbar-brand" href="index.html">butuhKu</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <?php
                if ($this->session->userdata('jabatan') == 'admin') {
                    ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>
                        <span class="badge badge-notify"
                              id="count_notif"><?php echo $this->db->where('read_status', 0)->count_all_results('transaksi') ?></span>
                    </a>
                    <?php
                } else if ($this->session->userdata('jabatan') == 'user') {
                    ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>
                        <?php
                        foreach ($this->session->userdata('waktu_peminjaman') as $dataku) {
                            $data = $dataku->waktu_peminjaman;
                            $data = substr($data, 0, strpos($data, " "));
                            if (date($data) - date('d-m-Y') > 1) {
                                ?>
                                <span class="badge badge-notify" id="count_notif">
                            <?php
                            echo count($data);
                            ?>
                            </span>
                                <?php
                            }
                        }
                        ?>

                    </a>
                    <?php
                }
                ?>

                <?php
                /*                if ($this->session->userdata('jabatan') == 'user') {
                                    */ ?><!--
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>
                        <span class="badge badge-notify"
                              id="count_notif"><?php /*echo $this->db->where('status_peminjaman !=', "pending")->count_all_results('peminjaman') + $this->db->where('status_laporan !=', "pending")->count_all_results('laporan') */ ?></span>
                    </a>
                    --><?php
                /*                }
                                */ ?>


                <ul class="dropdown-menu dropdown-messages">
                    <li id="notification">
                        <?php
                        if ($this->session->userdata('jabatan') == 'admin') {
                            foreach ($notification as $data) {
                                if ($data->id_peminjaman != 0 && $this->session->userdata('jabatan') == 'admin') {
                                    echo '
                                <a href="' . base_url() . 'admin/peminjaman">
                                    <div>
                                    <strong class="label label-success">Peminjaman Barang</strong><br>
                                        <strong>' . $data->nama_user . '</strong>
                                        <span class="pull-right text-muted">
                                                                <em>' . $data->waktu_peminjaman . '</em>
                                                            </span>
                                    </div>
                                    <div>' . $data->keterangan . '</div>
                                <br>
                                </a>
                                
                                ';
                                } elseif ($data->id_laporan != 0 && $this->session->userdata('jabatan') == 'admin') {
                                    echo '
                                <a href="' . base_url() . 'admin/laporan">
                                    <div>
                                    <strong class="label label-danger">Laporan Kerusakan</strong><br>
                                        <strong>' . $data->judul_laporan . '</strong>
                                        <span class="pull-right text-muted">
                                                                <em>' . $data->waktu_laporan . '</em>
                                                            </span>
                                    </div>
                                    <div>' . $data->deskripsi . '</div>
                                <br>
                                </a>
                                 ';
                                }
                            }

                        } else if ($this->session->userdata('jabatan') == 'user') {
                            foreach ($this->session->userdata('waktu_peminjaman') as $dataku) {
                                if ($dataku->status_peminjaman == "dipinjam") {
                                    echo '
                                <a>
                                    <div>
                                    <strong class="label label-danger">Peringatan!!!</strong><br>
                                        <strong> ID Peminjaman : ' . $dataku->id_peminjaman . '</strong>
                                        <span class="pull-right text-muted">
                                                                <em>' . $dataku->waktu_peminjaman . '</em>
                                                            </span>
                                    </div>
                                    <div>Segera Kembalikan Barang yang Anda Pinjam!!</div>
                                <br>
                                </a>
                                ';
                                }
                            }
                        }
                        ?>
                    </li>

                    <li class="divider"></li>

                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a><i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('nama') ?></a>
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
                      <a href="' . base_url() . 'user/" id="dashboard-user"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                  </li>
                  <li>
                      <a href="' . base_url() . 'user/lapor"><i class="fa fa-table fa-fw"></i> Lapor Kerusakan</a>
                  </li>
                  <li>
                      <a href="' . base_url() . 'user/pinjam"><i class="fa fa-signing fa-fw"></i> Ajukan Peminjaman</a>
                  </li>
                  <li>
                      <a href="' . base_url() . 'user/aktivitas"><i class="fa fa-clock-o fa-fw"></i> History Aktivitas</a>
                  </li>';
                    }
                    ?>

                    <!-- Admin -->
                    <?php if ($this->session->userdata('jabatan') == 'admin') {
                        echo '
                <li>
                    <a href="' . base_url() . 'admin/" ><i class="fa fa-home fa-fw"></i> Dashboard</a>
                </li>
                <li>
                  <a href="' . base_url() . 'admin/laporan"><i class="fa fa-list-alt fa-fw"></i> Laporan Kerusakan</a>
                </li>
                <li>
                   <a href="' . base_url() . 'admin/peminjaman"><i class="fa fa-list fa-fw"></i> Peminjaman Barang</a>
                </li>
                <li>
                   <a href="' . base_url() . 'admin/barang"><i class="fa fa-table fa-fw"></i> Daftar Barang</a>
                </li>
                <li>
                    <a href="' . base_url() . 'admin/history"><i class="fa fa-clock-o fa-fw"></i> History</a>
                </li>

                ';
                    }
                    ?>

                    <!-- Super Admin -->
                    <?php if ($this->session->userdata('jabatan') == 's_admin') {
                        echo '
              
              <li>
                  <a class="nav-active" href="' . base_url() . 's_admin/user"><i class="fa fa-user fa-fw"></i> Users</a>
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


<!-- jQuery -->
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-select/dist/js/i18n/defaults-en_US.min.js"></script>

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
<script src="<?php echo base_url(); ?>assets/dist/js/sweetalert.min.js"></script>

<script>

    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            responsive: true
        });


    });
</script>

</body>

</html>
