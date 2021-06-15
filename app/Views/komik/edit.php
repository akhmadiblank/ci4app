<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="my-2">Ubah Data Komik</h2>
            <form class="mt-4" action="/komik/update/<?= $komik['id'] ?>" method="post">
                <?= csrf_field(); ?>
                <?= $validation->listErrors() ?>
                <input type="hidden" name="slug" value="<?= $komik['slug'] ?>">
                <div class="form-group row">
                    <label for="Judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" id="Judul" name="judul" autofocus value="<?= old('judul') ? old('judul') : $komik['judul'] ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $komik['penulis'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $komik['penerbit'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sampul" name="sampul" value="<?= $komik['sampul'] ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 float-right">UBAH</button>

            </form>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>