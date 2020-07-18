<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Beranda
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="add" class="row">
    <div class="col-md-10 offset-md-1">
        <form method="post" action="" enctype="multipart/form-data" id="myform">
            <div class="form-group">
                <input type="text" name='nomor' class="form-control" id="nomor" placeholder="Enter Nomor">
            </div>
            <div class="form-group">
                <select name="kepada" id="kepada" class="form-control">
                    <option value='1'>-- Pilih Kacab/SPV --</option>
                    <?php
                    foreach ($user as $c) {
                        echo "<option value='$c->id'>-- $c->nama/$c->jabatan --</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <select name="dir" id="dir" class="form-control">
                    <option value='1'>-- Pilih Direktur --</option>
                    <?php
                    foreach ($user as $c) {
                        echo "<option value='$c->id'>-- $c->nama/$c->jabatan --</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <select name="jenis" id="jenis" class="form-control">
                    <option value='0'>-- Jenis Memo --</option>
                    <option value='0'>Memo</option>
                    <option value='1'>Barang</option>

                </select>
            </div>
            <div class="form-group">
                <input type="text" name='tanggal' class="form-control" id="tanggal" placeholder="Enter Tanggal">
            </div>
            <div class="form-group">
                <textarea name="hal" class="form-control" rows="3" id="hal" required="required">Hal</textarea>
            </div>

            <div class="form-group">
                <textarea name="deskripsi" id="editor1" class="form-control" rows="3" required="required">Keterangan</textarea>
            </div>
            <div class="form-group">
                <input type="file" id="file" name="file" />
            </div>
            <button type="button" class="btn btn-danger" id="but_upload">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>
        <button id="closeAdd" class="btn btn-default">close</button>

    </div>
</div>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div id="msg"></div>
        <button id="addButton" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Add</button>
        <br><br />
        <div class="table-responsive table--no-card m-b-40">
            <div class="au-task js-list-load">
                <div id="memo"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="table-responsive table--no-card m-b-40">
            <div class="au-task js-list-load">
                <div id="brg"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script type="text/javascript">
    $(function() {
        // CKEDITOR.replace('editor1');
        getData();
        $("#add").hide(1000);
        $("#addButton").click(function() {
            $("#add").show(1000);
        });
        $("#closeAdd").click(function() {
            $("#add").hide(1000);
        });
        $("#but_upload").click(function() {
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            var nomor = $('#nomor').val();
            var tanggal = $('#tanggal').val();
            var direktur = $('#dir').val();
            var kepada = $('#kepada').val();
            var jenis = $('#jenis').val();
            var hal = $('#hal').val();
            var deskripsi = $('#editor1').val();

            fd.append('file', files);
            fd.append('nomor', nomor);
            fd.append('kepada', kepada);
            fd.append('direktur', direktur);
            fd.append('tanggal', tanggal);
            fd.append('deskripsi', deskripsi);
            fd.append('hal', hal);
            fd.append('jenis', jenis);
            $.ajax({
                url: 'home',
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
                        url: "home/" + id,
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
            url: "<?php echo site_url('Home/getDataPermohonan/0') ?>/",
            type: "get",
            success: function(data) {
                document.getElementById("memo").innerHTML = data;
                $('#example3').dataTable();
            },
        });
        $.ajax({
            url: "<?php echo site_url('Home/getDataPermohonan/1') ?>/",
            type: "get",
            success: function(data) {
                document.getElementById("brg").innerHTML = data;
                $('#example3').dataTable();
            },
        });
    }
</script>
<?= $this->endSection(); ?>