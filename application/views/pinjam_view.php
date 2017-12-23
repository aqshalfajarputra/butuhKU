<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Peminjaman</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div id="notif"></div>
<br>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default panel-form">
            <form role="form">
                <div class="form-group">
                    <label>Nama Peminjam</label>
                    <input class="form-control" id="nama_peminjam" name="nama" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="number" class="form-control" id="nomor_tlp" name="telp" placeholder="Enter text">
                </div>
                <div class="form-group">
                    <label>Nama Guru</label>
                    <input class="form-control" placeholder="Enter text" name="guru" id="nama_guru">
                </div>
                <div class="form-group">
                    <label>Nama Barang</label> <br>
                    <div class="row">
                        <?php

                        $id = 0;
                        foreach ($kategori as $data) {
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse"
                                                   href="#collapse<?php echo $id ?>"><?php echo $data->nama_kategori ?></a>
                                                <input type="checkbox" name="<?php echo $data->nama_kategori ?>-master"
                                                       value="Router"
                                                       class="pull-right"
                                                       onclick="for(c in document.getElementsByName('<?php echo $data->nama_kategori ?>')) document.getElementsByName('<?php echo $data->nama_kategori ?>').item(c).checked = this.checked">

                                            </h4>
                                        </div>
                                        <div id="collapse<?php echo $id ?>" class="panel-collapse collapse">
                                            <?php
                                            foreach ($barang as $dataku) {
                                                if ($data->id_kategori == $dataku->id_kategori && $dataku->stok_barang != 0) {
                                                    ?>

                                                    <div class="panel-body">
                                                        <img src="<?php echo base_url(); ?>assets/dist/img/a1.png">
                                                        <?php echo $dataku->nama_barang ?>
                                                        <input type="checkbox" class="barang"
                                                               name="<?php echo $dataku->nama_kategori ?>"
                                                               value="<?php echo $dataku->id_barang ?>"
                                                               class="pull-right">
                                                        <br><br>
                                                        <p>Jumlah yang tersisa : <?php echo $dataku->stok_barang ?></p>
                                                        <label>Isikan Jumlah yang di Inginkan </label>
                                                        <br>
                                                        <input type="button" value="-" class="decreaseVal">
                                                        <input type="number" name="jumlah" min="1"
                                                               max="<?php echo $dataku->stok_barang ?>" value="1"
                                                               class="val" disabled>
                                                        <input type="button" value="+" class="increaseVal">
                                                    </div>

                                                    <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $id++;
                        }
                        ?>

                    </div>
                </div>

                <script>
                    $(".decreaseVal").click(function () {
                        var input_el = $(this).next('input');
                        var v = input_el.val() - 1;
                        if (v >= input_el.attr('min'))
                            input_el.val(v)
                    });


                    $(".increaseVal").click(function () {
                        var input_el = $(this).prev('input');
                        var v = input_el.val() * 1 + 1;
                        if (v <= input_el.attr('max'))
                            input_el.val(v)
                    });
                </script>

                <div class="form-group">
                    <label>Pilih Tanggal & Waktu Peminjaman</label>
                    <div class='input-group date' id='waktu_pinjam'>
                        <input id="waktu_peminjaman" name="waktu_peminjaman" type='text' class="form-control"/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#waktu_pinjam').datetimepicker({
                            format: 'YYYY-MM-DD HH:mm',

                        });
                    });
                </script>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea id="keterangan" class="form-control" name="keterangan" rows="3"></textarea>
                </div>


                <div class="form-group">

                    <button type="button" id="submit" class="btn btn-default btn-btn btn-submit"
                    ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--
<form class="form-horizontal">
    <fieldset>

        <div class="form-group">
            <label class="col-md-3 control-label" for="name">Waktu Pinjam</label>
            <div class="col-md-9">
                <input id="name" type="text" placeholder="Your name" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="username">Penanggung</label>
            <div class="col-md-9">
                <input id="username" type="text" placeholder="Your email" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 text-right">
                <button type="button" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
</form>
-->
<script>

    $(document).ready(function () {

        $.each($("input[class='barang']:checked"), function () {
            console.log('ini pesan barnag');
        });
    });

    $(document).ready(function () {
        var socket = io.connect('http://' + window.location.hostname + ':3000');
        $("#submit").click(function () {
            $.each($("input[class='barang']:checked"), function () {
                console.log('ini pesan barnag');
            });
            var favorite = [];
            var qty = [];
            var isi = $("input[name='jumlah']");
            $.each($("input[class='barang']:checked"), function () {
                var parent = $(this).parents('div.panel-body');
                var jumlah = parent.find(isi).val();
                console.log('hai', jumlah);
                qty.push(jumlah);
                favorite.push($(this).val());

            });

            var id_user = "<?php echo $this->session->userdata('id_user'); ?>";
            var nama_peminjam = $('#nama_peminjam').val();
            var telp_peminjam = $('#nomor_tlp').val();
            var penanggung = $('#nama_guru').val();
            var barang = [];
            barang = $.map(favorite, function (el, idx) {
                return [[el, qty[idx]]];
            });
            var waktu_pinjam = $('#waktu_peminjaman').val();
            var keterangan = $('#keterangan').val();

            if (nama_peminjam == "" || telp_peminjam == "" || penanggung == "" || barang == "" || waktu_pinjam == "" || keterangan == "") {
                alert('Lengkapi formulir');
            } else {
                var dataString = {
                    id_user: id_user,
                    nama_user: nama_peminjam,
                    waktu_peminjaman: waktu_pinjam,
                    waktu_pengembalian: "",
                    penanggung: penanggung,
                    status_peminjaman: "pending",
                    telp_peminjam: telp_peminjam,
                    keterangan: keterangan,
                    barang: barang
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('user/add_peminjaman');?>",
                    data: dataString,
                    dataType: "json",
                    cache: false,
                    success: function (data) {

//                    $('#nama_peminjam').val('');
//                    $('#nomor_tlp').val('');
//                    $('#nama_guru').val('');
//                    $('#waktu_peminjaman').val('');
//                    $('#keterangan').val('');

                        if (data.success == true) {

                            $("#notif").html(data.notif);


                            socket.emit('new_peminjaman', {
                                id_user: data.id_user,
                                nama_user: data.nama_user,
                                waktu_peminjaman: data.waktu_peminjaman,
                                waktu_pengembalian: data.waktu_pengembalian,
                                penanggung: data.penanggung,
                                status_peminjaman: data.status_peminjaman,
                                telp_peminjam: data.telp_peminjam,
                                keterangan: data.keterangan,
                                barang: data.barang
                            });

                        } else if (data.success == false) {

                            $("#name").val(data.name);
                            $("#username").val(data.username);
                            $("#password").val(data.password);
                            $("#role").val(data.role);
                            $("#notif").html(data.notif);

                        }

                    }, error: function (xhr, status, error) {
                        alert(error);
                    },

                });
            }


        });


        $(document).on("click", ".detail-message", function () {
            var dataString = {
                id_user: $(this).attr('id')
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('s_admin/detail');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    if (data.success == true) {
                        $("#show_id_user").val(data.id_user);
                        $("#show_name").val(data.nama);
                        $("#show_username").val(data.username);
                        $("#show_password").val(data.password);
                        $("#show_role").val(data.role);

                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });

        });

        socket.on('new_user', function (data) {

            $("#message-tbody")
                .prepend(
                    '<tr id="' + data.id_user + '"><td>' + data.id_user + '</td><td>' + data.name + '</td><td>' + data.username + '</td><td>' + data.password + '</td><td>' + data.role + '</td><td>' +
                    '<a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-success btn-sm detail-message" id="' + data.id_user + '"><span class="glyphicon glyphicon-search"></span></a>' +
                    ' <a href="<?php echo base_url()?>s_admin/hapus_user/' + data.id_user + '" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>' +
                    '</td>' +
                    '</tr>');
        });

        socket.on('edited_user', function (data) {
            console.log('ss', data.id_user);
            var id = data.id_user;
            $('tr#' + id)
                .html(
                    '<td>' + data.id_user + '</td><td>' + data.name + '</td><td>' + data.username + '</td><td>' + data.password + '</td><td>' + data.role + '</td><td>' +
                    '<a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-success btn-sm detail-message" id="' + data.id_user + '"><span class="glyphicon glyphicon-search"></span></a>' +
                    ' <a href="<?php echo base_url()?>s_admin/hapus_user/' + data.id_user + '" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>' +
                    '</td>');
        });

    });
</script>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">✕</button>
                <h4>Detail Message</h4>
            </div>

            <div class="modal-body" style="text-align:center;">
                <div class="row-fluid">
                    <div class="span10 offset1">
                        <div id="modalTab">
                            <div class="tab-content">
                                <div class="tab-pane active" id="about">

                                    <center>
                                        <form class="form-horizontal">
                                            <fieldset>
                                                <input id="show_id_user" type="text" hidden>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="name">Nama</label>
                                                    <div class="col-md-9">
                                                        <input id="show_name" type="text" class="form-control"
                                                               autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"
                                                           for="username">Username</label>
                                                    <div class="col-md-9">
                                                        <input id="show_username" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"
                                                           for="password">Password</label>
                                                    <div class="col-md-9">
                                                        <input id="show_password" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="role">Role</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="show_role"
                                                               name="message">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12 text-right">
                                                        <button type="button" id="update" class="btn btn-primary">Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>

                                        <br>
                                    </center>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>