<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Manage User <strong>Sarpra SMK TELKOM MALANG</strong>
        </h1>
    </div>
</div>

<div id="notif"></div>
<br>
<form class="form-horizontal">
    <fieldset>
        <div class="form-group">
            <label class="col-md-3 control-label" for="name">Nama</label>
            <div class="col-md-9">
                <input id="name" type="text" placeholder="Your name" class="form-control" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="username">Username</label>
            <div class="col-md-9">
                <input id="username" type="text" placeholder="Your email" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="password">Password</label>
            <div class="col-md-9">
                <input id="password" type="text" placeholder="Your subject" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="role">Role</label>
            <div class="col-md-9">
                <select class="form-control" id="sel1">

                    <?php foreach ($role as $data) {
                        echo '<option>' . $data->role . '</option>';
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 text-right">
                <button type="button" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
</form>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Daftar Transaksi
        </h3>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-9 col-md-9">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
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
                  <a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-success btn-sm detail-message" id="' . $data->id_user . '"><span class="glyphicon glyphicon-search"></span></a>
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

<script>

    $(document).ready(function () {
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
                        $("#show_role").val('')

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