<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-3">Detail Komik</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card mt-1" style="width: 18rem;">
                <img src="/img/<?= $komik['sampul'] ?>" class="card-img-top" alt="...">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <h5 class="card-title"><b>Judul: </b><?= $komik['judul']; ?></h5>
                <p class="card-text"><b>penulis: </b><?= $komik['penulis'] ?></p>
                <p class="card-text"><b>penerbit: </b><?= $komik['penerbit'] ?></p>
                <a href="" class="btn btn-danger">hapus</a>
                <a href="" class="btn btn-success">edit</a>
                <br>
                <a href="/komik">kembali kehalaman utama</a>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>