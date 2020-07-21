<?= $this->extend('layout/template'); ?>
<?= $this->section('title'); ?>
Beranda
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
                <div class="table-responsive">
                    <div class="au-task js-list-load">
                        <div id="memo"></div>
                    </div>
                </div>
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
<script>
    $(function() {
        getData();
    });


    function getData() {
        $.ajax({
            url: "/super/getDataPermohonan/",
            type: "get",
            success: function(data) {
                document.getElementById("memo").innerHTML = data;
                $('#tabelMemo').dataTable();
            },
        });
    }
</script>

<?= $this->endSection(); ?>