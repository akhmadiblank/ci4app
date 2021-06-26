<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-1">Tambah Data Komik</h2>
            <form class="mt-4" action="/komik/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="Judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" id="Judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : '' ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('penulis'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  <?= ($validation->hasError('penerbit')) ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sampul" class="col-sm-2 col-form-label gambarSampul">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/sampul.png" class="img-thumbnail img-Preview" id="img-Preview" style="min-width: 5rem;min-height: 9rem;">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : '' ?>" id="sampul" name="sampul" onchange="previewImg();">
                            <label class="custom-file-label" for="sampul" id="labelSampul">Pilih Gambar...</label>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 float-left">SAVE</button>

            </form>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>