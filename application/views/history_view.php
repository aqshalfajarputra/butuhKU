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
        <h1 class="page-header  ">
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

    });
</script>
