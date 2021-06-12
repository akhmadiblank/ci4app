<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-4">Daftar Koleksi Komik</h3>
            <a href="/komik/create" class="btn btn-primary mb-3">Tambah Data Komik</a>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-primary" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($komik as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $k['sampul'] ?>" class="sampul img-thumbnail" alt=""></td>
                            <td><?= $k['judul'] ?></td>
                            <td><a href="/komik/<?= $k['slug'] ?>" class="btn btn-success">Details</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>