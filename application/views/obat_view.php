<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Daftar Obat <strong>Apotik Khazanah</strong>
        </h1>
    </div>
</div>
<!-- /.row -->

<?php if (!empty($notif)) {
    echo '<div class="alert alert-success">';
    echo $notif;
    echo '</div>';
} ?>

<div class="row">
    <div class="col-md-8 col-lg-8">
        <a href="<?php echo base_url(); ?>index.php/admin/add_new_obat" class="btn btn-success btn-sm"><i
                    class="glyphicon glyphicon-plus"></i> Tambah</a>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-lg-8 col-md-8">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>ID Obat</th>
                    <th>Nama Obat</th>
                    <th>Harga Obat</th>
                    <th>Stok</th>
                    <th>Produsen</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($obat as $data) { //ngabsen data
                    echo
                        '<tr>
                  <td>' . $data->id_obat . '</td>
                  <td>' . $data->nama_obat . '</td>
                  <td>' . $data->harga_obat . '</td>
                  <td>' . $data->stok . '</td>
                  <td>' . $data->produsen . '</td>
                  <td>
                  <a href="' . base_url() . 'index.php/admin/tambah_stok/' . $data->id_obat . '" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                  <a href="' . base_url() . 'index.php/admin/hapus_obat/' . $data->id_obat . '" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                  </td>
              </tr>';
                }
                ?>


                </tbody>
            </table>
        </div>
    </div>


</div>
