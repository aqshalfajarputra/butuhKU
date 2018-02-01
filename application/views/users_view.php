<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Manajemen User <br><strong>Sarpra SMK TELKOM MALANG</strong>
        </h1>
    </div>
</div>

<div id="notif"></div>
<br>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h3 class="section-header">
            Tambah User
        </h3>
        <div class="panel panel-default panel-form">
            <form role="form">
                <div class="form-group">
                    <label class="control-label" for="name">Nama</label>
                    <input id="name" type="text" placeholder="Your name" class="form-control" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label" for="username">Username</label>
                    <input id="username" type="text" placeholder="Your email" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="password">Password</label>
                    <input id="password" type="text" placeholder="Your subject" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="role">Role</label>

                    <select class="form-control" id="role" name="message">
                        <option value="s_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="telp">No Telp</label>
                    <input id="telp" type="number" placeholder="Masukan Nomor Telepon (Optional)" class="form-control">
                </div>

                <div class="form-group">
                    <button type="button" id="submit" class="btn btn-default btn-btn btn-submit">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Daftar User
        </h3>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default panel-form">
            <div class="panel-body contain">
                <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                       style="width: 100%">
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

                <?php foreach ($users->result() as $data) {
                    echo '
                  <tr id="' . $data->id_user . '">
                  <td>' . $data->id_user . '</td>
                  <td>' . $data->nama . '</td>
                  <td>' . $data->username . '</td>
                  <td>' . $data->password . '</td>
                  <td>' . $data->role . '</td>
                  <td>
                  <a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-success btn-sm detail-message  btn-modal" id="' . $data->id_user . '"><span class="glyphicon glyphicon-search"></span></a>
                  <a href="' . base_url() . 's_admin/hapus_user/' . $data->id_user . '" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                  </td>
              </tr>';

                }
                ?>

                </tbody>
                </table>
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
                role: $("#role").val(),
                telp: $("#telp").val()
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
                    $("#telp").val('');

                    if (data.success == true) {

                        $("#notif").html(data.notif);


                        socket.emit('new_user', {
                            name: data.name,
                            username: data.username,
                            password: data.password,
                            role: data.role,
                            id_user: data.id_user,
                            telp: data.telp_user
                        });

                    } else if (data.success == false) {

                        $("#name").val(data.name);
                        $("#username").val(data.username);
                        $("#password").val(data.password);
                        $("#role").val(data.role);
                        $("#telp").val(data.telp_user);
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
                role: $("#show_role").val(),
                telp: $("#show_telp").val()
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
                    $("#show_telp").val('');


                    if (data.success == true) {

                        $("#notif").html(data.notif);


                        socket.emit('edited_user', {
                            name: data.name,
                            username: data.username,
                            password: data.password,
                            role: data.role,
                            id_user: data.id_user,
                            telp: data.telp_user
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
                        if (data.telp_user != 0) {
                            $("#show_telp").val(data.telp_user);
                        } else {
                            $("#show_telp").val('');
                        }

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

        socket.on('new_peminjaman', function (data) {
            console.log("berhasil");
        });

    });
</script>
<div class="modal fade bs-example-modal-sm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content detail-content">
            <div class="modal-header detail-header">
                <button type="button" class="btn pull-right" data-dismiss="modal">✕</button>
                <h4>Detail Message</h4>
            </div>

            <div class="modal-body detail-body">
                <form>
                                                <input id="show_id_user" type="text" hidden>

                    <label for="name">Nama</label>


                    <input id="show_name" type="text" class="form-control detail"
                                                               autofocus>


                    <label
                                                           for="username">Username</label>
                    <input id="show_username" type="text" class="detail form-control detail">


                    <label
                                                           for="password">Password</label>
                    <input id="show_password" type="text" class="form-control detail">


                    <label for="role">Role</label>

                    <input type="text" class="form-control detail" id="show_role"
                           name="role">

                    <label for="role">No Telp</label>

                    <input type="number" class="form-control detail" id="show_telp"
                           name="telp" placeholder="Silahkan Tambahkan No Telp untuk User Ini (Optional)">


                </form>


                                </div>
            <div class="modal-footer">
                <button type="button" id="update" class="btn btn-default btn-btn btn-update">Edit
                </button>
            </div>
        </div>
    </div>
</div>

