<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Beranda
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="add" class="row">
    <div class="col-md-10 offset-md-1">
        <form method="post" action="" enctype="multipart/form-data" id="myform">
            <div class="form-group">
                <input type="text" name='nomor' class="form-control" id="nama" placeholder="Enter Nama">
            </div>
            <div class="form-group">
                <select name="level" id="level" class="form-control">
                    <option value=''>--Level --</option>
                    <option value='0'>-- superadmin --</option>
                    <option value='1'>--1 / Pemohon --</option>
                    <option value='2'>-- 2 / SPV/Kacab --</option>
                    <option value='3'>-- 3 / Direktur--</option>
                </select>
            </div>
            <button type="button" class="btn btn-danger" id="but_upload">Tambah Data</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>
        <button id="closeAdd" class="btn btn-warning">close</button>
    </div>
</div>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div id="msg"></div>
        <div class="card border border-secondary">
            <div class="card-header">
                <strong class="card-title">Daftar User</strong>
            </div>
            <div class="card-body">
                <button id="addButton" class="btn btn-primary btn-md"><i class="fa fa-plus-square"></i> Add</button>
                <div class="table-responsive">
                    <div class="au-task js-list-load">
                        <div id="memo"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $(function() {
        getData();
        $("#add").hide(1000);
        $("#addButton").click(function() {
            $("#but_upload").show();
            $("#but_edit").hide();
            $("#add").show(1000);
        });
        $("#closeAdd").click(function() {
            $("#but_edit").show();
            $("#add").hide(1000);
        });
        $("#but_upload").click(function() {
            var fd = new FormData();
            var nama = $('#nama').val();
            var level = $('#level').val();
            fd.append('nama', nama);
            fd.append('level', level);
            $.ajax({
                url: '/super/insert',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    getData();
                    $("#add").hide(1000);
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 2000);
                    document.getElementById("msg")
                        .innerHTML = `<div class ="alert alert-danger alert-dismissable"><button type='button' 
                        class='close' data-dismiss='alert' aria-hidden='true'></button>
                        <strong>Tambah Data Berhasil !</strong></div>`;
                },
            });
        });
    });

    function hapus(id) {
        swal({
                title: 'Konfirmasi?',
                text: "Apakah anda yakin ingin menghapus data ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                closeOnConfirm: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "/super/" + id,
                        type: "DELETE",
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status) //if success close modal and reload ajax table
                            {

                                swal({
                                    title: "Data Berhasil dihapus",
                                    type: "success",
                                });
                                getData();
                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error adding / update data');
                        }
                    });
                }
            });
    }

    function getData() {
        $.ajax({
            url: "/super/getDataUser/",
            type: "get",
            success: function(data) {
                document.getElementById("memo").innerHTML = data;
                $('#tabelMemo').dataTable();
            },
        });
    }
</script>

<?= $this->endSection(); ?>