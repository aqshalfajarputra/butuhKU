<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            History Aktivitas Peminjaman
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Peminjaman</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body contain">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                               style="width: 100%">
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


</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            History Aktivitas Pelaporan Kerusakan
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">Pelaporan Kerusakan</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body contain">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Laporan</th>
                                <th>Judul Laporan</th>
                                <th>Waktu Laporan</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>
                            </thead>
                            <tbody id="message-tbody">

                            <?php
                            $no = 1;
                            foreach ($laporan->result() as $data) {
                                ?>
                                <tr id="<?php echo $data->id_laporan; ?>">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $data->id_laporan ?></td>
                                    <td><?php echo $data->judul_laporan ?></td>
                                    <td><?php echo $data->waktu_laporan ?></td>
                                    <td><?php if ($data->status_laporan == 'pending') {
                                            echo '<span class="label label-warning" style="font-size: 16px;" >' . $data->status_laporan . '</span>';
                                        } else if ($data->status_laporan == 'proses') {
                                            echo '<span class="label label-default" style="font-size: 16px;" >' . $data->status_laporan . '</span>';
                                        } else if ($data->status_laporan == 'selesai') {
                                            echo '<span class="label label-success" style="font-size: 16px;">' . $data->status_laporan . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a style="cursor:pointer" data-toggle="modal" data-target=".modal_laporan"
                                           class="btn btn-success btn-sm detail-laporan btn-modal"
                                           id="laporan_<?php echo $data->id_laporan ?>"><span
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

        $(document).on("click", ".detail-laporan", function () {
            var id = $(this).attr('id').split('_').pop();
            var dataString = {
                id: id
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/detail_laporan');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {

                    if (data.success == true) {
                        $("#show_id").val(data.id_laporan);
                        $("#show_judul_laporan").val(data.judul_laporan);
                        $("#show_foto_laporan").attr("src", "<?php echo base_url('upload/user'); echo "/"?>" + data.foto_laporan + "");
                        $("#show_waktu_laporan").val(data.waktu_laporan);
                        $("#show_deskripsi").html(data.deskripsi);
                        $("#show_status_laporan").html(data.status_laporan);

                        var perbaikan = data.waktu_perbaikan;
                        var tanggapan = data.tanggapan;

                        if (perbaikan != "") {
                            $("#show_waktu_perbaikan").val(data.waktu_perbaikan);
                        } else if (perbaikan == "") {
                            $("#show_waktu_perbaikan").val("Admin Belum Menentukan Waktu Perbaikan");
                        }

                        if (tanggapan != "") {
                            $("#show_tanggapan").html(data.tanggapan);
                        } else if (tanggapan == "") {
                            $("#show_tanggapan").html("Tidak Ada Tanggapan");
                        }


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
                            $("#show_barang").append('<div class="row" style="background-color: #EEEEEE; border-radius: 5px; padding: 10px; margin : 8px 8px"> <div class="col-lg-6"><img src="<?php echo base_url()?>upload/barang/' + barang[index].foto_barang + '" style="max-width : 30%"> </div> <div class="col-lg-6"><label>' + barang[index].nama_barang + '</label><p>Jumlah Barang: ' + barang[index].jumlah + '</p></div></div>')
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


<div class="modal fade modal_laporan" role="dialog">
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
                    <label>JUDUL LAPORAN</label>
                    <input type="text" class="form-control detail" id="show_judul_laporan" disabled>

                    <label>WAKTU LAPORAN</label>
                    <input type="text" class="form-control detail" id="show_waktu_laporan" disabled>

                    <label>FOTO LAPORAN</label>
                    <img id="show_foto_laporan" class="small" width="200px" src="">
                    <br>

                    <label>DESKRIPSI</label>
                    <textarea type="text" class="form-control detail" id="show_deskripsi" disabled> </textarea>

                    <label>STATUS LAPORAN</label> <br>
                    <span class="label label-warning" style="font-size: 16px;" id="show_status_laporan"></span>
                    <br>
                    <br>

                    <label>WAKTU PERBAIKAN</label>
                    <input type="text" class="form-control detail" id="show_waktu_perbaikan" disabled>

                    <label>TANGGAPAN</label>
                    <textarea class="form-control detail" id="show_tanggapan" disabled> </textarea>

            </div>
            <!--                    <button type="submit" id="update" class="btn btn-default btn-btn btn-update">Update</button>-->
            </form>


            </div>
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <!--button update nantinya-->

    </div/>

</div>
</div>