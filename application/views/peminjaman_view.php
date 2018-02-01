<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Aktivitas Peminjaman Barang
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-body contain">
                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                           style="width: 100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Peminjaman</th>
                                <th>ID User</th>
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
                                    <td><?php echo $data->id_user ?></td>
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
                                    <td><?php if ($data->status_peminjaman == 'pending') {
                                            echo '<span class="label label-warning" style="font-size: 16px;" >' . $data->status_peminjaman . '</span>';
                                        } else if ($data->status_peminjaman == 'dipinjam') {
                                            echo '<span class="label label-default" style="font-size: 16px;" >' . $data->status_peminjaman . '</span>';
                                        } else if ($data->status_peminjaman == 'selesai') {
                                            echo '<span class="label label-success" style="font-size: 16px;">' . $data->status_peminjaman . '</span>';
                                        }
                                        ?></td>

                                    <td>
                                        <a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm"
                                           class="btn btn-success btn-sm detail-peminjaman btn-modal"
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

<script>

    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            responsive: true
        });
        var socket = io.connect('http://' + window.location.hostname + ':3000');


        $("#update").click(function () {

            var favorite = [];
            var qty = [];
            var isi = $("input[name='jumlah']");
            $.each($("input[class='barang']:checked"), function () {
                var parent = $(this).parents('div#show_barang');
                var jumlah = parent.find(isi).val();
                console.log('hai', jumlah);
                qty.push(jumlah);
                favorite.push($(this).val());

            });


            var barang = [];
            barang = $.map(favorite, function (el, idx) {
                return [[el, qty[idx]]];
            });

            console.log('brang', barang);

            var dataString = {
                id_peminjaman: $("#show_id").html(),
                status_peminjaman: $("#show_status").html(),
                barang: barang
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/edit_status');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {


                    if (data.success == true) {

                        socket.emit('edited_status', {
                            id_peminjaman: data.id_peminjaman,
                            status_peminjaman: data.status_peminjaman
                        });


                        $('.bs-example-modal-sm').modal('toggle');
                        swal("Sukses!", "Status Selesai di Update!", "success");

                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);

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
                url: "<?php echo base_url('admin/detail_peminjaman');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {


                    var index;

                    if (data.success == true) {
                        $("#show_barang").html('');
                        $("#show_id").html(data.id_peminjaman);
                        $("#show_nama_peminjam").val(data.nama_user);
                        $("#show_waktu_peminjaman").val(data.waktu_peminjaman);
                        $("#show_waktu_pengembalian").val(data.waktu_pengembalian);
                        var barang = data.barang;
                        for (index = 0; index < barang.length; index++) {
                            $("#show_barang").append('<div class="row" style="background-color: #EEEEEE; border-radius: 5px; padding: 10px; margin : 8px 8px"> <div class="col-lg-6"><img src="<?php echo base_url()?>upload/barang/' + barang[index].foto_barang + '" class="img-responsive"> </div> <div class="col-lg-6"> <input type="checkbox" class="barang"name="' + barang[index].nama_barang + '"value="' + barang[index].id_barang + '" checked style="display:none"> <label>' + barang[index].nama_barang + '</label> <input type="number" name="jumlah" value="' + barang[index].jumlah + '"></div></div>')
                        }
                        $("#show_status").html(data.status_peminjaman);

                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                }

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
                    <b><h4 id="show_id"></h4></b>
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
                        <label> Silahkan Rubah Status :</label>
                        <!--                        <span class="label label-warning" style="font-size: 16px;" id="show_status"></span>-->
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="status">
                                    <option disabled="disabled" selected="selected">select one option</option>
                                    <option>pending</option>
                                    <option>dipinjam</option>
                                    <option>selesai</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <span class="label label-warning" style="font-size: 16px;" id="show_status"></span>
                            </div>
                        </div>
                        <script>
                            $("#status")
                                .change(function () {
                                    var str = "";
                                    $("select option:selected").each(function () {
                                        str = $(this).text() + " ";
                                    });
                                    $("#show_status").text(str);
                                })
                                .trigger("change");
                        </script>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="submit" id="update" class="btn btn-default btn-btn btn-update">Update</button>
            </div>
            <!--button update nantinya-->

        </div/>

    </div>
</div>

<!-- /.row -->

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
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control col-md-10 show_barang" disabled
                                                               name="barang">
                                                        <input type="text" class="form-control col-md-2 show_jumlah" disabled
                                                               name="jumlah">
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