<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            History Aktivitas Peminjaman
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 col-md-10 col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Peminjaman</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Peminjaman</th>
                                <th>Nama Peminjam</th>
                                <th>Waktu Peminjaman</th>
                                <th>Waktu Pengembalian</th>
                                <th>Barang & Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>
                            </thead>
                            <tbody id="message-tbody">

                            <?php
                            $no = 1;
                            foreach ($peminjaman->result() as $data) {
                                ?>
                                <tr id="<?php echo $data->id_peminjaman; ?>">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $data->id_peminjaman ?></td>
                                    <td><?php echo $data->nama_user ?></td>
                                    <td><?php echo $data->waktu_peminjaman ?></td>
                                    <td><?php echo $data->waktu_pengembalian ?></td>
                                    <td>
                                        <?php
                                        foreach ($barang->result() as $dataku) {
                                            ?>
                                            <?php
                                            if ($data->id_peminjaman == $dataku->id_peminjaman) {
                                                echo "$dataku->nama_barang , $dataku->jumlah pcs <br>";
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $data->status_peminjaman ?></td>
                                    <td>
                                        <a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm"
                                           class="btn btn-success btn-sm detail-peminjaman"
                                           id="peminjaman_<?php echo $data->id_peminjaman ?>"><span
                                                    class="glyphicon glyphicon-search"></span></a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            History Aktivitas Pelaporan Kerusakan
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 col-md-10 col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">Pelaporan Kerusakan</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody id="message-tbody">
                            <!---->
                            <!--                --><?php //foreach ($users->result() as $data) {
                            //                    echo '
                            //                  <tr id="' . $data->id_user . '">
                            //                  <td>' . $data->id_user . '</td>
                            //                  <td>' . $data->nama . '</td>
                            //                  <td>' . $data->username . '</td>
                            //                  <td>' . $data->password . '</td>
                            //                  <td>' . $data->role . '</td>
                            //                  <td>
                            //                  <a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-success btn-sm detail-message" id="' . $data->id_user . '"><span class="glyphicon glyphicon-search"></span></a>
                            //                  <a href="' . base_url() . 's_admin/hapus_user/' . $data->id_user . '" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                            //                  </td>
                            //              </tr>';
                            //
                            //                }
                            //                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>

    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            responsive: true
        });
        var socket = io.connect('http://' + window.location.hostname + ':3000');
        $("#submit").click(function () {


            var dataString = {
                name: $("#name").val(),
                username: $("#username").val(),
                password: $("#password").val(),
                role: $("#role").val()
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('s_admin/add_user');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    $("#name").val('');
                    $("#username").val('');
                    $("#password").val('');
                    $("#role").val('');

                    if (data.success == true) {

                        $("#notif").html(data.notif);


                        socket.emit('new_user', {
                            name: data.name,
                            username: data.username,
                            password: data.password,
                            role: data.role,
                            id_user: data.id_user
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

        });

        $("#update").click(function () {

            var dataString = {
                id_user: $("#show_id_user").val(),
                name: $("#show_name").val(),
                username: $("#show_username").val(),
                password: $("#show_password").val(),
                role: $("#show_role").val()
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('s_admin/edit_user');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    $("#show_id_user").val(''),
                        $("#show_name").val(''),
                        $("#show_username").val(''),
                        $("#show_password").val(''),
                        $("#show_role").val('');

                    if (data.success == true) {

                        $("#notif").html(data.notif);


                        socket.emit('edited_user', {
                            name: data.name,
                            username: data.username,
                            password: data.password,
                            role: data.role,
                            id_user: data.id_user
                        });

                        $('.bs-example-modal-sm').modal('toggle');

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

        });

        $(document).on("click", ".detail-peminjaman", function () {
            var id = $(this).attr('id').split('_').pop();
            var dataString = {
                id: id
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('user/detail_peminjaman');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {


                    var index;

                    if (data.success == true) {
                        $("#show_barang").html('');
                        $("#show_id").val(data.id_peminjaman);
                        $("#show_nama_peminjam").val(data.nama_user);
                        $("#show_waktu_peminjaman").val(data.waktu_peminjaman);
                        $("#show_waktu_pengembalian").val(data.waktu_pengembalian);
                        var barang = data.barang;
                        for (index = 0; index < barang.length; index++) {
                            $("#show_barang").append('<div class="row" style="background-color: #EEEEEE; border-radius: 5px; padding: 10px; margin : 8px 8px"> <div class="col-lg-6"><img src="<?php echo base_url()?>assets/dist/img/' + barang[index].foto_barang + '"> </div> <div class="col-lg-6"><label>' + barang[index].nama_barang + '</label><p>Jumlah Barang: ' + barang[index].jumlah + '</p></div></div>')
                        }
                        $("#show_status").html(data.status_peminjaman);

                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });

        });


    });
</script>

<div class="modal fade bs-example-modal-sm" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content detail-content">
            <div class="modal-header detail-header">
                <button type="button" class="btn pull-right" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title detail-title">Modal Header</h4>-->
            </div>
            <div class="modal-body detail-body">
                <form>
                    <b><h1 id="show_id">01</h1></b>
                    <br>
                    <label>NAMA PEMINJAM</label>
                    <input type="text" class="form-control detail" id="show_nama_peminjam" disabled>

                    <label>WAKTU PEMINJAMAN</label>
                    <input type="text" class="form-control detail" id="show_waktu_peminjaman" disabled>

                    <label>WAKTU PENGEMBALIAN</label>
                    <input type="text" class="form-control detail" id="show_waktu_pengembalian" disabled>

                    <label>BARANG</label>
                    <div id="show_barang">

                    </div>

                    <br>
                    <label>STATUS</label>
                    <div class="form-group">
                        <!--                        <label for="sel1">  list (select one):</label> bisa dihilangkan sesuai role-->
                        <span class="label label-warning" style="font-size: 16px;" id="show_status"></span>
                        <!--<select class="form-control" id="show_status" disabled>
                            <option>Pending</option>
                            <option>Proses<//option>
                            <option>Done</option>
                        </select>-->
                    </div>
                    <!--                    <button type="submit" id="update" class="btn btn-default btn-btn btn-update">Update</button>-->
                </form>


            </div>
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            <!--button update nantinya-->

        </div/>

    </div>
</div>

<!-- /.row -->
</div>


<!--
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">✕</button>
                <h4>Detail Peminjaman</h4>
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
                                                    <label class="col-md-3 ">No</label>
                                                    <div class="col-md-9">
                                                        <input type="text" disabled class="form-control"
                                                               autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">ID Peminjaman</label>
                                                    <br>
                                                    <div class="col-md-9">
                                                        <input id="show_id" disabled type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"
                                                           for="show_nama_peminjam">Nama Peminjam</label>
                                                    <div class="col-md-9">
                                                        <input id="show_nama_peminjam" disabled type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="show_waktu_peminjaman">Waktu Peminjaman</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled id="show_waktu_peminjaman"
                                                               name="waktu_peminjaman">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="show_waktu_pengembalian">Waktu Pengembalian</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled id="show_waktu_pengembalian"
                                                               name="waktu_pengembalian">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Barang & Jumlah</label>
                                                    <div class="col-md-9" id="show_barang">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="show_status">Status</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled id="show_status"
                                                               name="status">
                                                    </div>
                                                    <br>
                                                    <br>
                                                <div class="form-group">

                                                    <div class="col-md-12">
                                                        <button type="button" id="update" class="btn btn-success">Update
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
</div>-->