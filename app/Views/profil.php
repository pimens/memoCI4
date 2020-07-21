<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Detail Barang
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="add" class="row">
    <div class="col-md-10 offset-md-1">
        <div id="msg"></div>
        <form method="post" action="" enctype="multipart/form-data" id="myform">
            <div class="form-group">
                <input id="nama" type="text" name='nama' class="form-control" placeholder="Enter Nama">
            </div>
            <div class="form-group">
                <input id="email" type="text" name='email' class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <input id="lokasi" type="text" name='lokasi' class="form-control" placeholder="Enter Lokasi">
            </div>
            <div class="form-group">
                <input id="jabatan" type="text" name='jabatan' class="form-control" placeholder="Enter Jabatan">
            </div>
            <div class="form-group">
                <input id="password" value="Password Baru" type="text" name='password' class="form-control" placeholder="Enter New Password">
            </div>
            <div class="form-group">
                <input id="lama" type="hidden" name='lama' class="form-control" placeholder="Enter New Password">
            </div>
            <button type="button" class="btn btn-danger" id="but_upload">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $(function() {
        getData();
        $("#but_upload").click(function() {
            insert();
        });
    });

    function insert() {
        var fd = new FormData();
        var nama = $('#nama').val();
        var lokasi = $('#lokasi').val();
        var email = $('#email').val();
        var jabatan = $('#jabatan').val();
        var password = $('#password').val();
        var lama = $('#lama').val();

        fd.append('nama', nama);
        fd.append('lokasi', lokasi);
        fd.append('email', email);
        fd.append('password', password);
        fd.append('lama', lama);
        fd.append('jabatan', jabatan);
        $.ajax({
            url: '/User/update',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                document.getElementById("msg")
                    .innerHTML = `<div class ="alert alert-danger alert-dismissable"><button type='button' 
                        class='close' data-dismiss='alert' aria-hidden='true'></button>
                        <strong>Data Diubah !</strong></div>`;
                window.location = "/user";

            },
        });
    }

    function getData() {
        $.ajax({
            url: "/User/getUser",
            type: "get",
            dataType: "JSON",
            success: function(data) {
                $('#nama').val(data.nama);
                $('#email').val(data.email);
                $('#lokasi').val(data.lokasi);
                $('#jabatan').val(data.jabatan);
                $('#lama').val(data.password);
            },
        });
    }
</script>

<?= $this->endSection(); ?>