<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pembelian Stok Barang <strong>Apotik Khazanah</strong>
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
    <div class="col-lg-6 col-md-6">
        <form method="post" id="form-pendaftaran" enctype="multipart/form-data"
              action="<?php echo base_url(); ?>index.php/admin/update_stok">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="form-group">
                        <label>ID Obat</label>
                        <input class="form-control" name="id_obat" value="<?php echo $detil->id_obat ?>"
                               readonly="readonly">
                        <label>Nama Obat</label>
                        <input type="text" class="form-control" name="nama_obat" value="<?php echo $detil->nama_obat ?>"
                               readonly="readonly">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="qty" placeholder="Masukan">
                        <label>Suplier</label>
                        <select class="form-control" name="suplier">
                            <?php
                            foreach ($stok as $s) {
                                echo '<option value="' . $s->id_supplier . '">' . $s->nama_sp . '</option>';
                            }
                            ?>
                        </select> <br><br>
                        <input type="submit" class="btn btn-success" name="submit" value="kirim">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
