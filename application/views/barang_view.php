<!--/**
 * Created by PhpStorm.
 * User: Aqshal-kun
 * Date: 1/9/2018
 * Time: 10:24 PM
 */-->

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12">
        <h1 class="page-header">
            Daftar Barang
        </h1>
        <button style="cursor:pointer" data-toggle="modal" data-target=".tambah_barang"
                class="btn btn-success btn-lg btn-tb">
            Tambah Barang
        </button>
        <br>
        <br>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-12">
        <h1 class="page-header">
            Daftar Kategori
        </h1>
        <button style="cursor:pointer" data-toggle="modal" data-target=".tambah_kategori"
                class="btn btn-success btn-lg btn-tb"> Tambah Kategori
        </button>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse"> Daftar Barang</a>
                    </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok Barang</th>
                            <th>Kategori</th>
                            <th>Aksi</th>

                        </tr>
                        </thead>
                        <tbody id="barang-tbody">

                        <?php
                        $no = 1;
                        foreach ($barang->result() as $data) {
                            ?>
                            <tr id="<?php echo $data->id_barang; ?>">
                                <td><?php echo $no ?></td>
                                <td><?php echo $data->id_barang ?></td>
                                <td><?php echo $data->nama_barang ?></td>
                                <td><?php echo $data->stok_barang ?></td>
                                <td><?php echo $data->nama_kategori ?></td>
                                <td>
                                    <a style="cursor:pointer" data-toggle="modal" data-target=".detil_barang_modal  "
                                       class="btn btn-success btn-sm detail-barang btn-modal"
                                       id="barang_<?php echo $data->id_barang ?>"><span
                                                class="glyphicon glyphicon-search"></span></a>
                                    <a href="<?php echo base_url() ?>admin/hapus_barang/<?php echo $data->id_barang ?>"
                                       class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
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


    <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1">Klik Untuk Mengolah Kategori</a>
                            </h4>
                        </div>

                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>

                                    </tr>
                                    </thead>
                                    <tbody id="kategori-tbody">

                                    <?php
                                    $no = 1;
                                    foreach ($kategori->result() as $data) {
                                        ?>
                                        <tr id="<?php echo $data->id_kategori; ?>">
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $data->id_kategori ?></td>
                                            <td><?php echo $data->nama_kategori ?></td>
                                            <td>
                                                <a style="cursor:pointer" data-toggle="modal"
                                                   data-target=".detil_kategori_modal"
                                                   class="btn btn-success btn-sm detail-kategori btn-modal"
                                                   id="kategori_<?php echo $data->id_kategori ?>"><span
                                                            class="glyphicon glyphicon-search"></span></a>
                                                <a href="<?php echo base_url() ?>admin/hapus_kategori/<?php echo $data->id_kategori ?>"
                                                   class="btn btn-danger btn-sm"><i
                                                            class="glyphicon glyphicon-trash"></i></a>
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
            <div class="col-md-12">
                <div class="panel-group">
                    <h3 class="page-header">
                        Daftar Barang yang Dipinjam
                    </h3>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2">Klik Untuk Melihat Barang yang Dipinjam</a>
                            </h4>
                        </div>

                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>

                                    </tr>
                                    </thead>
                                    <tbody id="kategori-tbody">

                                    <?php
                                    $no = 1;
                                    foreach ($dipinjam->result() as $data) {
                                        ?>
                                        <tr id="<?php echo $data->id_barang; ?>">
                                            <td><?php echo $data->id_barang ?></td>
                                            <td><?php echo $data->nama_barang ?></td>
                                            <td><?php echo $data->nama_kategori ?></td>
                                            <td><?php echo $data->jumlah ?></td>

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


    </div>


</div>

<div class="modal fade tambah_barang" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content detail-content">
            <div class="modal-header detail-header">
                <button type="button" class="btn pull-right" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title detail-title">Modal Header</h4>-->
            </div>
            <div class="modal-body detail-body">
                <form>
                    <label>NAMA BARANG</label>
                    <input type="text" class="form-control detail" id="nama_barang">

                    <label>STOK BARANG</label>
                    <input type="number" class="form-control detail" id="stok_barang">

                    <label>KATEGORI</label>
                    <select class="form-control detail" id="id_kategori">
                        <option disabled="disabled" selected="selected">select one option</option>
                        <?php foreach ($kategori->result() as $data) {
                            echo '<option value="' . $data->id_kategori . '">' . $data->nama_kategori . '</option>';
                        }
                        ?>
                    </select>
                    <label>FOTO BARANG</label>
                    <span>( File Extension Hanya JPEG/PNG )</span>
                    <input class="form-control" id="inp" type='file' onchange="encodeImagetoBase64(this)">
            </div>
            <div class="modal-footer">
                <button type="button" id="add_barang" class="btn btn-default btn-default">Tambah</button>
            </div>

            <!--button update nantinya-->
            </form>

        </div>

    </div>
</div>

<div class="modal fade detil_barang_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content detail-content">
            <div class="modal-header detail-header">
                <button type="button" class="btn pull-right" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title detail-title">Modal Header</h4>-->
            </div>
            <div class="modal-body detail-body">
                <form>
                    <input type="hidden" class="form-control detail" id="show_id_barang">

                    <label>NAMA BARANG</label>
                    <input type="text" class="form-control detail" id="show_nama_barang">

                    <label>STOK BARANG</label>
                    <input type="number" class="form-control detail" id="show_stok_barang">

                    <label>KATEGORI</label>
                    <select class="form-control detail" id="show_id_kategori">
                        <option disabled="disabled" selected="selected">select one option</option>
                        <?php foreach ($kategori->result() as $data) {
                            echo '<option value="' . $data->id_kategori . '">' . $data->nama_kategori . '</option>';
                        }
                        ?>
                    </select>
                    <label>FOTO BARANG</label>
                    <img id="show_foto_barang" class="small" width="100px" src="">

                    <span>( File Extension Hanya JPEG/PNG )</span>
                    <input class="form-control" id="inpNew" type='file' onchange="encodeImagetoBase642(this)">
            </div>
            <div class="modal-footer">
                <button type="button" id="update_barang" class="btn btn-default btn-default">Update</button>
            </div>

            <!--button update nantinya-->
            </form>

        </div>

    </div>
</div>

<div class="modal fade tambah_kategori" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content detail-content">
            <div class="modal-header detail-header">
                <button type="button" class="btn pull-right" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title detail-title">Modal Header</h4>-->
            </div>
            <div class="modal-body detail-body">
                <form>
                    <label>NAMA Kategori</label>
                    <input type="text" class="form-control detail" id="nama_kategori">

                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" id="add_kategori" class="btn btn-default btn-btn btn-update">Tambah</button>
            </div>
            <!--button update nantinya-->

        </div>

    </div>
</div>

<div class="modal fade detil_kategori_modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content detail-content">
            <div class="modal-header detail-header">
                <button type="button" class="btn pull-right" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title detail-title">Modal Header</h4>-->
            </div>
            <div class="modal-body detail-body">
                <form>
                    <input type="hidden" class="form-control detail" id="show_id_kategori2">
                    <label>NAMA KATEGORI</label>
                    <input type="text" class="form-control detail" id="show_nama_kategori">

                </form>


            </div>
            <div class="modal-footer">
                <button type="submit" id="update-kategori" class="btn btn-default btn-btn btn-update">Update</button>
            </div>
            <!--button update nantinya-->

        </div>

    </div>
</div>


<script>

    $(document).ready(function () {

        $('.dataTables-example').DataTable({
            responsive: true
        });

        $(document).on("click", ".detail-barang", function () {
            var id = $(this).attr('id').split('_').pop();
            console.log('inin', id);
            var dataString = {
                id_barang: id
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/detail_barang');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    if (data.success == true) {
                        $("#show_id_barang").val(data.id_barang);
                        $("#show_nama_barang").val(data.nama_barang);
                        $("#show_stok_barang").val(data.stok_barang);
                        $("#show_foto_barang").attr("src", "<?php echo base_url('upload'); echo "/barang/"?>" + data.foto_barang + "");
                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });


        });


        $(document).on("click", ".detail-kategori", function () {
            var id = $(this).attr('id').split('_').pop();
            var dataString = {
                id_kategori: id
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/detail_kategori');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    if (data.success == true) {
                        $("#show_id_kategori2").val(data.id_kategori);
                        $("#show_nama_kategori").val(data.nama_kategori);
                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });


        });


        $("#update-kategori").click(function () {
            var id = $("#show_id_kategori2").val();
            var nama = $("#show_nama_kategori").val();
            console.log('id', id);
            var dataString = {
                id_kategori: id,
                nama_kategori: nama
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/edit_kategori');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    if (data.success == true) {

                        swal("Sukses!", "Barang sudah di Tambahkan!", "success");
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else if (data.success == false) {

                        $("#nama_kategori").val(data.nama_kategori);

                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });

        });


        $("#add_kategori").click(function () {
            var socket = io.connect('http://' + window.location.hostname + ':3000');

            var dataString = {
                nama_kategori: $("#nama_kategori").val(),

            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/add_kategori');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    $("#nama_kategori").val('');

                    if (data.success == true) {

                        socket.emit('add_barang', {
                            nama_kategori: data.nama_kategori,
                        });

                        $('.tambah_kategori').modal('toggle');
                        swal("Sukses!", "Barang sudah di Tambahkan!", "success");
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else if (data.success == false) {

                        $("#nama_kategori").val(data.nama_kategori);

                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });

        });

    });

    function encodeImagetoBase64(element) {

        var file = element.files[0];

        var reader = new FileReader();

        reader.onloadend = function () {

            var FR = reader.result;
            var socket = io.connect('http://' + window.location.hostname + ':3000');
            var inp = $("#inp").val();


            $("#add_barang").click(function () {
                console.log('FR', FR);

                var dataString = {
                    nama_barang: $("#nama_barang").val(),
                    stok_barang: $("#stok_barang").val(),
                    id_kategori: $("#id_kategori").val(),
                    foto_barang: FR

                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/add_barang');?>",
                    data: dataString,
                    dataType: "json",
                    cache: false,
                    success: function (data) {

                        $("#nama_barang").val('');
                        $("#stok_barang").val('');
                        $("#id_kategori").val('');
                        $("#inp").val('');

                        if (data.success == true) {

                            socket.emit('add_barang', {
                                id_barang: data.id_barang,
                                nama_barang: data.nama_barang,
                                stok_barang: data.stok_barang,
                                id_kategori: data.id_kategori,
                                foto_barang: data.foto_barang
                            });

                            $('.add_barang').modal('toggle');
                            swal("Sukses!", "Barang sudah di Tambahkan!", "success");
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);

                        } else if (data.success == false) {

                            $("#nama_barang").val(data.nama_barang);
                            $("#stok_barang").val(data.stok_barang);
                            $("#id_kategori").val(data.id_kategori);

                        }

                    }, error: function (xhr, status, error) {
                        alert(error);
                    },

                });

            });

        };

        reader.readAsDataURL(file);

    }

    function encodeImagetoBase642(element) {

        var file = element.files[0];

        var reader = new FileReader();

        reader.onloadend = function () {

            var FR = reader.result;
            var socket = io.connect('http://' + window.location.hostname + ':3000');
            var inp = $("#inpNew").val();

            $("#update_barang").click(function () {
                console.log('clicked');

                var dataString = {
                    id_barang: $("#show_id_barang").val(),
                    nama_barang: $("#show_nama_barang").val(),
                    stok_barang: $("#show_stok_barang").val(),
                    id_kategori: $("#show_id_kategori").val(),
                    foto_barang: FR

                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin/edit_barang');?>",
                    data: dataString,
                    dataType: "json",
                    cache: false,
                    success: function (data) {

                        if (data.success == true) {

                            socket.emit('edit_barang', {
                                id_barang: data.id_barang,
                                nama_barang: data.nama_barang,
                                stok_barang: data.stok_barang,
                                id_kategori: data.id_kategori,
                                foto_barang: data.foto_barang
                            });

                            $('.edit_barang').modal('toggle');
                            swal("Sukses!", "Barang sudah di Edit!", "success");
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);

                        } else if (data.success == false) {

                            $("#show_id_barang").val(data.id_barang);
                            $("#show_nama_barang").val(data.nama_barang);
                            $("#show_stok_barang").val(data.stok_barang);
                            $("#show_id_kategori").val(data.id_kategori);

                        }

                    }, error: function (xhr, status, error) {
                        alert(error);
                    },

                });

            });

        };

        reader.readAsDataURL(file);

    }

</script>




