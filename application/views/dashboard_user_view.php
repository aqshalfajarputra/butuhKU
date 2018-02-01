<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-4 col-md-6">
        <a href="<?php echo base_url() ?>user/lapor">
            <div class="panel panel-bg-lapor">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">

                            <img src="<?php echo base_url(); ?>assets/dist/img/a1.png">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="title-dash">Pelaporan Barang Rusak</div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-4 col-md-6">
        <a href="<?php echo base_url() ?>user/pinjam">
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
        <a href="<?php echo base_url() ?>user/aktivitas">
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
</div>-->

<script>

    $(document).ready(function () {
        var socket = io.connect('http://' + window.location.hostname + ':3000');

        socket.on('new_peminjaman', function (data) {
            console.log("berhasil");
        });

    });
</script>
