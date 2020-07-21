<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Detail
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="add" class="row">
    <div class="col-md-10 offset-md-1">
        <form method="post" action="" enctype="multipart/form-data" id="myform">
            <div class="form-group">
                <textarea name="komentar" id="editor1" class="form-control" rows="3" required="required">Keterangan</textarea>
                <input type="hidden" id="id" value="<?php echo $permohonan->id; ?>" name="id" />
            </div>
            <div class="form-group">
                <select name="status" id="status" class="form-control" required="required">
                    <option>-- Reject/Approve --</option>
                    <option value='33'>Reject</option>
                    <option value='2'>Approve</option>
                </select>
            </div>
            <button type="button" class="btn btn-danger" id="but_upload">Submit</button>
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
                    echo " <span class='badge badge-info'>Pending</span><br>";
                    echo "<button id='addButton' type='button' class='btn btn-sm btn-warning'><span class='fa fa-plus'></span>Reject/Approve</button>";
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
        CKEDITOR.replace('editor1');
        getData(<?= $permohonan->id; ?>);
        $("#add").hide(1000);
        $("#addButton").click(function() {
            $("#but_upload").show();
            $("#add").show(1000);
        });
        $("#closeAdd").click(function() {
            $("#add").hide(1000);
        });
        $("#but_upload").click(function() {
            insert();
        });
    });

    function insert() {
        var fd = new FormData();
        // var komentar = $('#editor1').val();
        var komentar = CKEDITOR.instances.editor1.getData();
        var id = $('#id').val();
        var status = $('#status').val();

        fd.append('komentar', komentar);
        fd.append('id', id);
        fd.append('status', status);
        $.ajax({
            url: '/direksi/setStatusAction',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                getData(<?= $permohonan->id; ?>);
                $("#add").hide(1000);
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 2000);
                document.getElementById("msg")
                    .innerHTML = `<div class ="alert alert-danger alert-dismissable"><button type='button' 
                        class='close' data-dismiss='alert' aria-hidden='true'></button>
                        <strong>Data Diubah !</strong></div>`;
            },
        });
    }

    function getData(id) {
        $.ajax({
            url: "/direksi/getTabelDetail/" + id,
            type: "get",
            success: function(data) {
                // console.log(data);
                document.getElementById("memo").innerHTML = data;
                $('#tabelMemo').dataTable();
            },
        });
    }
</script>

<?= $this->endSection(); ?>