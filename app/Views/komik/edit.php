<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="my-2">Ubah Data Komik</h2>
            <form class="mt-4" action="/komik/update/<?= $komik['id'] ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?= $validation->listErrors() ?>
                <input type="hidden" name="slug" value="<?= $komik['slug'] ?>">
                <input type="hidden" name="sampulLama" value="<?= $komik['sampul'] ?>">
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
                    <div class="col-sm-2">
                        <img src="/img/<?= $komik['sampul'] ?>" class="img-thumbnail img-Preview" id="img-Preview" style="min-width: 5rem;min-height: 9rem;">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : '' ?>" id="sampul" name="sampul" onchange="previewImg();">
                            <label class="custom-file-label" for="sampul" id="labelSampul"><?= $komik['sampul'] ?></label>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 float-right">UBAH</button>

            </form>

        </div>
    </div>
</div>
<?= $this->endsection(); ?>