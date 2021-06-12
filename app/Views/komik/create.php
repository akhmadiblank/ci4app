<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-1">Tambah Data Komik</h2>
            <form class="mt-4" action="/komik/save" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="Judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Judul" name="judul">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penulis" name="penulis">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sampul" name="sampul">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 float-right">SAVE</button>

            </form>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>