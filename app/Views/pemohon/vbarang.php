<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Detail Barang
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="add" class="row">
    <div class="col-md-10 offset-md-1">
        <form method="post" action="" enctype="multipart/form-data" id="myform">
            <div class="form-group">
                <input type="text" name='nama' id="nama" class="form-control" placeholder="Enter nama barang" required="required">
            </div>
            <div class="form-group">
                <input id="x" type="text" class="form-control" placeholder="Enter Jumlah" required="required">
            </div>
            <div class="form-group">
                <input type="text" id="satuan" class="form-control" placeholder="Enter Satuan" required="required">
            </div>
            <div class="form-group">
                <input id="y" type="text" name='harga' class="form-control" placeholder="Enter harga">
            </div>
            <div class="form-group">
                <input id="z" type="text" class="form-control" placeholder="Total" required="required" disabled>
            </div>
            <div class="form-group">
                <textarea ID="editor1" name="keterangan" class="form-control" rows="3" required="required">keterangan</textarea>
                <!-- <textarea id="keterangan" class="form-control" rows="3" required="required">keterangan</textarea> -->
            </div>
            <input type="hidden" value="<?php echo $permohonan->id; ?>" name="id" id="idpermohonan" />
            <input type="hidden" name="id" id="id" />

            <button type="button" class="btn btn-danger" id="but_upload">Submit</button>
            <button type="button" class="btn btn-info" id="but_edit">Update</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </form>
        <button id="closeAdd" class="btn btn-warning">close</button>
    </div>
</div>
<div id="msg"></div>
<div class="row">
    <div class="col-md-4">
        <div class="card border border-secondary">
            <div class="card-header">
                <strong class="card-title">Detail</strong>
            </div>
            <div class="card-body">
                <?php
                $u = base_url();
                echo "Nomor :" . $permohonan->nomor . "<br>";
                echo "Perihal :" . $permohonan->hal . "<br>";
                echo "Deskripsi :" . $permohonan->deskripsi . "<br>";
                echo "tanggal :" . $permohonan->tanggal . "<br>";
                echo "Kepada :" . $permohonan->kepada . "<br>";
                echo "Direktur :" . $permohonan->direktur . "<br>";
                echo "Status :";
                if ($permohonan->status == 0) {
                    echo " <span class='badge badge-info'>Pending</span>";
                } else if ($permohonan->status == 1) {
                    echo " <span class='badge badge-warning'>Approve X</span>";
                } else if ($permohonan->status == 2) {
                    echo " <span class='badge badge-primary'>Approve XX</span>";
                } else if ($permohonan->status == 3) {
                    echo " <span class='badge badge-danger'>Rejected X</span>";
                } else {
                    echo " <span class='badge badge-danger'>Rejected XX</span>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border border-secondary">
            <div class="card-header">
                <strong class="card-title">Daftar Permohonan</strong>
            </div>
            <div class="card-body">
                <?php
                if ($permohonan->status == 0) {
                    echo "<button id='addButton' type='button' class='btn btn-md btn-warning'><span class='fa fa-plus'></span>Tambah Rincian</button>";
                } ?>
                <div class="table-responsive">
                    <div class="au-task js-list-load">
                        <div id="barang"></div>
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
        CKEDITOR.replace('editor1');
        getData(<?= $permohonan->id; ?>);
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
            insert();
        });
        $("#but_edit").click(function() {
            edit();
        });
        $("#x").change(function() {
            var x = $("#x").val();
            var y = $("#y").val();

            $("#z").val(x * y);
        });
        $("#y").change(function() {
            var x = $("#x").val();
            var y = $("#y").val();
            $("#z").val(x * y);
        });
    });

    function hapus(id) {
        swal({
                title: 'Konfirmasi?',
                text: "Apakah anda yakin ingin menghapus data ini!" + id,
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
                        url: "/home/barangDelete/" + id,
                        type: "post",
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data);
                            if (data.status) //if success close modal and reload ajax table
                            {
                                swal({
                                    title: "Data Berhasil dihapus",
                                    type: "success",
                                });
                                getData(<?= $permohonan->id; ?>);

                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error adding / update data');
                        }
                    });
                }
            });
    }

    function edit() {
        var fd = new FormData();
        var nama_barang = $('#nama').val();
        var unit = $('#x').val();
        var satuan = $('#satuan').val();
        var id = $('#id').val();
        var harga = $('#y').val();
        // var keterangan = $('#editor1').val();
        var keterangan = CKEDITOR.instances.editor1.getData();

        fd.append('nama_barang', nama_barang);
        fd.append('unit', unit);
        fd.append('satuan', satuan);
        fd.append('harga', harga);
        fd.append('keterangan', keterangan);
        $.ajax({
            url: '/Home/barangActionEdit/' + id,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                getData(<?= $permohonan->id; ?>);
                $("#add").hide(1000);
                $("#but_upload").show();
                console.log(response);
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 2000);
                document.getElementById("msg")
                    .innerHTML = `<div class ="alert alert-danger alert-dismissable"><button type='button' 
                        class='close' data-dismiss='alert' aria-hidden='true'></button>
                        <strong>Update Data Berhasil !</strong></div>`;
            },
        });
    }

    function insert() {
        var fd = new FormData();
        var nama_barang = $('#nama').val();
        var unit = $('#x').val();
        var satuan = $('#satuan').val();
        var id = $('#idpermohonan').val();
        var harga = $('#y').val();
        // var keterangan = $('#editor1').val();
        var keterangan = CKEDITOR.instances.editor1.getData();

        fd.append('nama_barang', nama_barang);
        fd.append('unit', unit);
        fd.append('satuan', satuan);
        fd.append('permohonan', id);
        fd.append('harga', harga);
        fd.append('keterangan', keterangan);
        $.ajax({
            url: '/home/barangInsert',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                getData(<?= $permohonan->id; ?>);
                $("#add").hide(1000);
                $("#but_edit").show();
                console.log(response);
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
    }

    function getData(id) {
        $.ajax({
            url: "/Home/getTabelBrgDetail/" + id,
            type: "get",
            success: function(data) {
                // console.log(data);
                document.getElementById("barang").innerHTML = data;
                $('#tabelMemo').dataTable();
            },
        });
    }

    function detail(id) {
        $.ajax({
            url: "/Home/barangEdit/" + id,
            type: "get",
            dataType: "JSON",
            success: function(data) {
                $("#add").show(1000);
                $("#but_upload").hide(10);
                $("#but_edit").show();
                $('#nama').val(data.nama_barang);
                $('#x').val(data.unit);
                CKEDITOR.instances.editor1.setData(data.keterangan);

                // $('#editor1').val(data.keterangan);
                $('#y').val(data.harga);
                $('#z').val(data.unit * data.harga);
                $('#satuan').val(data.satuan);
                $('#id').val(data.id);

            },
        });
    }
</script>

<?= $this->endSection(); ?>