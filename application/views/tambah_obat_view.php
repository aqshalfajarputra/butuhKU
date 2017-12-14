<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Tambah Data Obat <strong>Apotik Khazanah</strong>
        </h1>
        <div class="col-lg-4 col-md-4">
            <form method="post" id="form-pendaftaran" enctype="multipart/form-data"
                  action="<?php echo base_url(); ?>index.php/admin/save_obat">
                <div class="row">
                    <div class="form-group">
                        <label>ID Obat</label>
                        <input class="form-control" name="id_obat" type="text">
                        <label>Nama Obat</label>
                        <input type="text" class="form-control" name="nama_obat">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="qty" placeholder="">
                        <label>Suplier</label>
                        <select class="form-control" name="suplier">
                            <?php
                            foreach ($stok as $s) {
                                echo '<option value="' . $s->id_supplier . '">' . $s->nama_sp . '</option>';
                            }
                            ?>
                        </select>
                        <label>Produsen</label>
                        <input type="text" class="form-control" name="produsen" placeholder="">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" placeholder="">
                        <label>Foto Obat</label>
                        <input type="file" id="foto" name="foto" class="form-control" required/>
                        <br><br>
                        <input type="submit" class="btn btn-success" name="submit" value="kirim">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- /.row -->
