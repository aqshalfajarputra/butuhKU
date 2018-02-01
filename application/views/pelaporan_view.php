<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Aktivitas Laporan Kerusakan
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


<script>

    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            responsive: true
        });
        var socket = io.connect('http://' + window.location.hostname + ':3000');
        $("#update").click(function () {

            var dataString = {
                id_laporan: $("#show_id").html(),
                status_laporan: $("#show_status").html(),
                waktu_perbaikan: $("#show_waktu_perbaikan").val(),
                tanggapan: $("#show_tanggapan").val()
            };

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/edit_status_laporan');?>",
                data: dataString,
                dataType: "json",
                cache: false,
                success: function (data) {


                    if (data.success == true) {

                        socket.emit('edited_status_laporan', {
                            id_laporan: data.id_laporan,
                            waktu_perbaikan: data.waktu_perbaikan,
                            status_laporan: data.status_laporan,
                            tanggapan: data.tanggapan

                        });

                        swal("Sukses!", "Status Selesai di Update!", "success");

                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);

                    } else if (data.success == false) {

                        swal("Sukses!", "Status Selesai di Update!", "success");

                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });

        });

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
                        $("#show_id").html(data.id_laporan);
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
                            $("#show_waktu_perbaikan").attr("placeholder", "Admin Belum Menentukan Waktu Perbaikan");
                        }

                        if (tanggapan != "") {
                            $("#show_tanggapan").html(data.tanggapan);
                        } else if (tanggapan == "") {
                            $("#show_tanggapan").attr("placeholder", "Tidak Ada Tanggapan");
                        }


                    }

                }, error: function (xhr, status, error) {
                    alert(error);
                },

            });

        });


    });
</script>
<div class="modal fade modal_laporan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content detail-content">
            <div class="modal-header detail-header">
                <button type="button" class="btn pull-right" data-dismiss="modal">&times;</button>
                <!--<h4 class="modal-title detail-title">Modal Header</h4>-->
            </div>
            <div class="modal-body detail-body">
                <form>
                    <b><h1 id="show_id"></h1></b>
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
                    <label> Silahkan Rubah Status :</label>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="status">
                                <option>pending</option>
                                <option>proses</option>
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
                    <br>

                    <label>WAKTU PERBAIKAN</label> <br>
                    <label> Silahkan Tentukan Waktu Perbaikan :</label>
                    <div class='input-group date' id='waktu_perbaikan'>
                        <input id="show_waktu_perbaikan" name="show_waktu_perbaikan" type='text' class="form-control"/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#waktu_perbaikan').datetimepicker({
                                format: 'DD-MM-YYYY HH:mm',

                            });
                        });
                    </script>

                    <label>TANGGAPAN</label>
                    <textarea class="form-control detail" id="show_tanggapan" placeholder=""></textarea>


            </div>
            <div class="modal-footer">
                <button id="update" class="btn btn-default btn-btn btn-update">Update</button>
            </div>
            <!--                    <button type="submit" id="update" class="btn btn-default btn-btn btn-update">Update</button>-->
            </form>
            <!--button update nantinya-->

        </div/>

    </div>
</div>