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
                                <th>User</th>
                                <th>Nama Peminjam</th>
                                <th>Waktu Peminjaman</th>
                                <th>Waktu Pengembalian</th>
                                <th>Penanggung</th>
                                <th>No Telp</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Barang</th>
                                <th>Jumlah</th>

                            </tr>
                            </thead>
                            <tbody id="message-tbody">

                            <?php
                            $no = 1;
                            foreach ($peminjaman->result() as $data) {
                                ?>

                                <tr id="<?php echo $data->id_peminjaman; ?>">
                                    <?php
                                    /*                                    $jumlah = 0;
                                                                        foreach ( $barang->result() as $datayu)
                                                                            if ($data->id_peminjaman == $datayu->id_peminjaman) {
                                                                                $jumlah++;
                                                                            }
                                                                        */ ?>
                                    <!--                                    <td <?php /*if ($jumlah > 1) echo "rowspan='$jumlah'"*/ ?>><?php /*echo $no */ ?></td>
-->
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $data->id_peminjaman ?></td>
                                    <td><?php echo $data->nama ?></td>
                                    <td><?php echo $data->nama_user ?></td>
                                    <td><?php echo $data->waktu_peminjaman ?></td>
                                    <td><?php echo $data->waktu_pengembalian ?></td>
                                    <td><?php echo $data->penanggung ?></td>
                                    <td><?php echo $data->telp_peminjam ?></td>
                                    <td><?php echo $data->keterangan ?></td>
                                    <td><?php if ($data->status_peminjaman == 'pending') {
                                            echo '<span class="label label-warning" style="font-size: 16px;" >' . $data->status_peminjaman . '</span>';
                                        } else if ($data->status_peminjaman == 'dipinjam') {
                                            echo '<span class="label label-default" style="font-size: 16px;" >' . $data->status_peminjaman . '</span>';
                                        } else if ($data->status_peminjaman == 'selesai') {
                                            echo '<span class="label label-success" style="font-size: 16px;">' . $data->status_peminjaman . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($barang->result() as $dataku) {
                                            ?>
                                            <?php
                                            if ($data->id_peminjaman == $dataku->id_peminjaman) {
                                                echo "$dataku->nama_barang <br>";
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($barang->result() as $dataku) {
                                            ?>
                                            <?php
                                            if ($data->id_peminjaman == $dataku->id_peminjaman) {
                                                echo "$dataku->jumlah <br>";
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>

                                    </td>

                                    <?php
                                    /*                                    $i = 0;
                                                                        foreach ($barang->result() as $dataku) {
                                                                            if ($data->id_peminjaman == $dataku->id_peminjaman) {
                                                                                if ($i++ == 0) {
                                                                                    echo "<td>$dataku->nama_barang </td><td> $dataku->jumlah pcs </td></tr>";
                                                                                } else {
                                                                                    echo "<tr class='$dataku->id_peminjaman'>
                                                                                            <td>$dataku->nama_barang </td>
                                                                                            <td> $dataku->jumlah </td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>
                                                                                            <td style='display: none;'></td>";
                                                                                }
                                                                            }
                                                                            */ ?><!--
                                        --><?php
                                    /*                                    }
                                                                        */ ?>

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
                                <th>User</th>
                                <th>Judul Laporan</th>
                                <th>Foto Laporan</th>
                                <th>Waktu Laporan</th>
                                <th>Waktu Perbaikan</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Tanggapan</th>

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
                                    <td><?php echo $data->nama ?></td>
                                    <td><?php echo $data->judul_laporan ?></td>
                                    <td><img style="max-height: 50%"
                                             src="<?php echo base_url() ?>upload/user/<?php echo $data->foto_laporan ?>">
                                        <br>
                                        <?php echo $data->foto_laporan ?>
                                    </td>
                                    <td><?php echo $data->waktu_laporan ?></td>
                                    <td><?php echo $data->waktu_perbaikan ?></td>
                                    <td><?php echo $data->deskripsi ?></td>
                                    <td><?php if ($data->status_laporan == 'pending') {
                                            echo '<span class="label label-warning" style="font-size: 16px;" >' . $data->status_laporan . '</span>';
                                        } else if ($data->status_laporan == 'proses') {
                                            echo '<span class="label label-default" style="font-size: 16px;" >' . $data->status_laporan . '</span>';
                                        } else if ($data->status_laporan == 'selesai') {
                                            echo '<span class="label label-success" style="font-size: 16px;">' . $data->status_laporan . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $data->tanggapan ?></td>
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
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        var socket = io.connect('http://' + window.location.hostname + ':3000');

    });
</script>
