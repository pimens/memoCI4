<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Detail
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="add" class="row">
    <div class="col-md-10 offset-md-1">
        <form method="post" action="" enctype="multipart/form-data" id="myform">
            <div class="form-group">
                <input type="text" id="desa" name='desa' class="form-control" placeholder="Enter Desa" required="required">
            </div>
            <div class="form-group">
                <input type="text" id="setoran" name='setoran' class="form-control" placeholder="Enter Setoran">
            </div>
            <div class="form-group">
                <input type="text" id="fee" name='fee' class="form-control" placeholder="Enter Fee" required="required">
            </div>
            <div class="form-group">
                <input type="text" id="norekening" name='norek' class="form-control" placeholder="Enter Nomor Rekening">
            </div>
            <div class="form-group">
                <input type="text" id="bendahara" name='bendahara' class="form-control" placeholder="Enter Nama Bendahara">
                <input type="hidden" id="idpermohonan" value="<?php echo $permohonan->id; ?>" name="id" />
                <input type="hidden" id="idmemo" />

            </div>
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
                <?php if ($permohonan->status == 0) {
                    echo "<button id='addButton' type='button' class='btn btn-md btn-warning'><span class='fa fa-plus'></span>Tambah Rincian</button>";
                } ?>
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
        // CKEDITOR.replace('editor1');
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
                        url: "/home/memoDelete/" + id,
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
        var desa = $('#desa').val();
        var setoran = $('#setoran').val();
        var fee = $('#fee').val();
        var id = $('#idmemo').val();
        var bendahara = $('#bendahara').val();
        var norekening = $('#norekening').val();
        fd.append('desa', desa);
        fd.append('setoran', setoran);
        fd.append('fee', fee);
        fd.append('id', id);
        fd.append('bendahara', bendahara);
        fd.append('norekening', norekening);
        $.ajax({
            url: '/Home/memoActionEdit/' + id,
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
        var desa = $('#desa').val();
        var setoran = $('#setoran').val();
        var fee = $('#fee').val();
        var id = $('#idpermohonan').val();
        var bendahara = $('#bendahara').val();
        var norekening = $('#norekening').val();

        fd.append('desa', desa);
        fd.append('setoran', setoran);
        fd.append('fee', fee);
        fd.append('id', id);
        fd.append('bendahara', bendahara);
        fd.append('norekening', norekening);
        $.ajax({
            url: '/home/memoInsert',
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
            url: "/Home/getTabelDetail/" + id,
            type: "get",
            success: function(data) {
                // console.log(data);
                document.getElementById("memo").innerHTML = data;
                $('#tabelMemo').dataTable();
            },
        });
    }

    function detail(id) {
        $.ajax({
            url: "/Home/memoEdit/" + id,
            type: "get",
            dataType: "JSON",
            success: function(data) {
                $("#add").show(1000);
                $("#but_upload").hide(10);
                $("#but_edit").show();
                $('#desa').val(data.desa);
                $('#setoran').val(data.setoran);
                $('#fee').val(data.fee);
                $('#norekening').val(data.norekening);
                $('#bendahara').val(data.bendahara);
                $('#idmemo').val(data.id);
            },
        });
    }
</script>

<?= $this->endSection(); ?>