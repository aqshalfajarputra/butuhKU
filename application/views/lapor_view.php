<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Laporan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div id="notif"></div>
<br>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default panel-form">
            <form role="form">
                <div class="form-group">
                    <label>Judul Laporan</label>
                    <input class="form-control" id="judul_laporan" name="judul_laporan"
                           placeholder="Masukan Judul Laporan Anda">
                </div>
                <div class="form-group">
                    <label>Foto Laporan</label>
                    <span>File Extention  hanya JPEG/PNG</span>
                    <input type="file" class="form-control" onchange="encodeImagetoBase64(this)" id="foto_laporan"
                           name="foto_laporan">
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="deskripsi" class="form-control" name="deskripsi" rows="3"></textarea>
                </div>
                <input id="waktu_laporan" type="hidden" value="<?php echo date('d-m-Y H:i') ?>">

                <div class="form-group">
                    <button type="button" id="submit" class="btn btn-default btn-btn btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

    function encodeImagetoBase64(element) {

        var file = element.files[0];

        var reader = new FileReader();

        reader.onloadend = function () {

            var FR = reader.result;
            var socket = io.connect('http://' + window.location.hostname + ':3000');
            var inp = $("#inp").val();

            $("#submit").click(function () {

                var id_user = "<?php echo $this->session->userdata('id_user'); ?>";
                var judul_laporan = $('#judul_laporan').val();
                var foto_laporan = FR;
                var waktu_laporan = $('#waktu_laporan').val();
                var deskripsi = $('#deskripsi').val();

                if (judul_laporan == "" || foto_laporan == "" || deskripsi == "") {
                    swal("Error!", "Lengkapi Formulir!", "error");
                } else {
                    var dataString = {
                        id_user: id_user,
                        judul_laporan: judul_laporan,
                        foto_laporan: foto_laporan,
                        waktu_laporan: waktu_laporan,
                        status_laporan: "pending",
                        deskripsi: deskripsi
                    };

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('user/add_laporan');?>",
                        data: dataString,
                        dataType: "json",
                        cache: false,
                        success: function (data) {

                            if (data.success == true) {

                                socket.emit('new_laporan', {
                                    id_user: data.id_user,
                                    judul_laporan: data.judul_laporan,
                                    foto_laporan: data.foto_laporan,
                                    waktu_laporan: data.waktu_laporan,
                                    status_laporan: data.status_laporan,
                                    deskripsi: data.deskripsi
                                });

                                socket.emit('count_notif', {
                                    count_notif: data.count_notif
                                });

                                swal("Sukses!", "Laporan Telah Terkirim!", "success");

                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);


                            } else if (data.success == false) {

                                swal("Gagal!", "Laporan Gagal Dikirim!", "error");
                                setTimeout(function () {
                                    window.location.reload();
                                }, 3000);
                            }

                        }, error: function (xhr, status, error) {
                            alert(error);
                        },

                    });
                }


            });


        };

        reader.readAsDataURL(file);

    }

    $(document).ready(function () {


    });
</script>

