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
                    <option>-- Jenis Memo --</option>
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
                <input type="hidden" id="idpermohonan" />
            </div>
            <button type="button" class="btn btn-danger" id="but_upload">Submit</button>
            <button type="button" class="btn btn-info" id="but_edit">Update</button>
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
                <strong class="card-title">Daftar Permohonan</strong>
            </div>
            <div class="card-body">
                <button id="addButton" class="btn btn-primary btn-md"><i class="fa fa-plus-square"></i> Add</button>
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
<script src="assets/ajax/beranda.js"></script>

<?= $this->endSection(); ?>