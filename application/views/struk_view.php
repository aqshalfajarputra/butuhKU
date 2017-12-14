<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Struk Obat <strong>Apotik Khazanah</strong>
        </h1>
    </div>
</div>
<!-- /.row -->
<?php if (!empty($notif)) {
    echo '<div class="alert alert-success">';
    echo $notif;
    echo '</div>';
} ?>
<form method="post" id="form-penjualan" enctype="multipart/form-data"
      action="<?php echo base_url(); ?>index.php/admin/save_transaksi">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <label>ID Penjualan</label>
                <input class="form-control" placeholder="Masukan" name="id_penjualan">
                <label>Pilih Obat</label>
                <select class="form-control" name="obat">
                    <?php
                    foreach ($obat as $o) {
                        echo '<option value="' . $o->id_obat . '">' . $o->nama_obat . '</option>';
                    }
                    ?>
                </select>
                <label>Jumlah</label>
                <input type="number" class="form-control" name="qty" placeholder="Masukan">
                <label>Keterangan</label>
                <select class="form-control" name="keterangan">
                    <option value="resep">Resep</option>
                    <option value="no_resep">Non Resep</option>
                </select>
                <br><br>
                <input type="submit" class="btn btn-success" name="submit" value="kirim">
            </div>
        </div>
    </div>
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
                    <th>ID Penjualan</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Satuan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Harga</th>
                    <th>Bayar</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($transaksi as $data) { //ngabsen data
                    echo
                        '<tr>
                  <td>' . $data->id_jual . '</td>
                  <td>' . $data->nama_obat . '</td>
                  <td>' . $data->qty . '</td>
                  <td>' . $data->keterangan . '</td>
                  <td>' . $data->harga_obat . '</td>
                  <td>' . $data->tanggal_jual . '</td>
                  <td>' . $data->qty * $data->harga_obat . '</td>
                  <td>
                  <a href="' . base_url() . 'index.php/admin/bayar" class="btn btn-md btn-primary">Proses</a>
                  </td>
                  <td>
                  <a href="' . base_url() . 'index.php/admin/hapus_transaksi/' . $data->id_jual . '" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
                  </td>
              </tr>';
                }
                ?>


                </tbody>
            </table>
        </div>
    </div>
</div>
