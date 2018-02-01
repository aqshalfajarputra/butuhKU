<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-4 col-md-6">
        <a href=" <?php echo base_url() ?>admin/laporan">
            <div class="panel panel-bg-lapor">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">

                            <img src="<?php echo base_url(); ?>assets/dist/img/a1.png">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="title-dash">Laporan Kerusakan</div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-lg-4 col-md-6">
        <a href=" <?php echo base_url() ?>admin/peminjaman">
            <div class="panel panel-bg-pinjam">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3 img-ico">

                            <img src="<?php echo base_url(); ?>assets/dist/img/a2.png">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="title-dash">Peminjaman Barang</div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6">
        <a href=" <?php echo base_url() ?>admin/history">
            <div class="panel panel-bg-riwayat">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3 img-ico">

                            <img src="<?php echo base_url(); ?>assets/dist/img/a3.png">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="title-dash">Riwayat</div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!--<div class="row">
    <div class="col-lg-12 col-md-12">
        <a href="">
            <div class="panel panel-bg-grafik">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3 img-ico">

                            <div id="morris-donut-chart"></div>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="title-dash"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
-->

<script>

    $(document).ready(function () {
        var socket = io.connect('http://' + window.location.hostname + ':3000');
        var notif = $("#count_notif");
        socket.on('new_peminjaman', function (data) {
            $("#notification").prepend('<a href="simple/admin/peminjaman"> <div><strong class="label label-success">Peminjaman Barang</strong><br><strong>' + data.nama_user + '</strong><span class="pull-right text-muted"><em>' + data.waktu_peminjaman + '</em></span></div><div>' + data.keterangan + '</div><br></a>')
        });

        socket.on('new_laporan', function (data) {
            $("#notification").prepend('<a href="simple/admin/laporan"> <div><strong class="label label-danger">Laporan Kerusakan</strong><br><strong>' + data.judul_laporan + '</strong><span class="pull-right text-muted"><em>' + data.waktu_laporan + '</em></span></div><div>' + data.deskripsi + '</div><br></a>')
        });

        socket.on('count_notif', function (data) {
            notif.html(data.count_notif);
        })

    });
</script>
