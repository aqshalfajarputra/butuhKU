<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Laporan Kerusakan
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12">
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
                                <th>ID Laporan</th>
                                <th>Pelapor</th>
                                <th>Judul Laporan</th>
                                <th>Waktu Laporan</th>
                                <!--                                    <th>Foto Kerusakan</th>
                                                                        <th>Deskripsi</th>-->
                                <th>Tanggal Laporan</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>
                            </thead>
                            <tbody id="message-tbody">

                            <?php
                            $no = 1;
                            foreach ($peminjaman->result() as $data) {
                                ?>
                                <tr id="<?php echo $data->id_laporan; ?>">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $data->id_laporan ?></td>
                                    <td><?php echo $data->nama_user ?></td>
                                    <td><?php echo $data->judul_laporan ?></td>
                                    <td><?php echo $data->waktu_laporan ?></td>
                                    <td><?php echo $data->status_laporan ?></td>
                                    <td>
                                        <a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm"
                                           class="btn btn-success btn-sm detail-message"
                                           id="<?php $data->id_laporan ?>"><span
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