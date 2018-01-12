<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Peminjaman</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-default panel-form">
            <form>
                <p id="msg"></p>
                <input type="file" id="file" name="file"/>
                <br>
                <input type="text" id="keterangan"/>
                <button type="submit" id="btnsumbit">Upload</button>
            </form>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        var socket = io.connect('http://' + window.location.hostname + ':3000');
        $('#btnsubmit').on("click", function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url('admin/upload_file');?>",
                type: "POST",
                data: $('#form').serialize(), //extract value in form
                dataType: "JSON",
                success: function (data) {
                    if (data.status) //if success close modal and reload ajax table
                    {
                        alert('success');
                    } else {
                        alert('failed');
                    }
                    $('#btnsubmit').text('save'); //change button text
                    $('#btnsubmit').attr('disabled', false); //set button enable
                }
            });


        });
    });
</script>

