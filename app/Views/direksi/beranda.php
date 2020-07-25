<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Beranda Direksi
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div id="msg"></div>
        <div class="card border border-secondary">
            <div class="card-header">
                <strong class="card-title">Daftar Permohonan</strong>
            </div>
            <div class="card-body">
                <div class="rs-select2--dark rs-select2--md m-r-10">
                    <select class="js-select2" id="jns">
                        <option value="0">Memo</option>
                        <option value="1">Barang</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div><br><br>
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
        $("#jns").change(function() {
            getData();
        });
    });

    function getData() {
        $.ajax({
            url: "/direksi/getDataPermohonan/" + $('#jns').val(),
            type: "get",
            success: function(data) {
                document.getElementById("memo").innerHTML = data;
                $('#tabelMemo').dataTable();
            },
        });
    }

    function setStatus(id) {
        $.ajax({
            url: "/direksi/setStatus/" + id + "/0",
            type: "get",
            success: function(data) {
                getData();
            },
        });
    }
</script>

<?= $this->endSection(); ?>