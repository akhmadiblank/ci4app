<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>selamat datang</h1>
            <p>Ini adalah halaman utama</p>
            <?php foreach ($alamat as $a) : ?>
                <ul>
                    <li><?= $a['type']; ?></li>
                    <li><?= $a['alamat']; ?></li>
                    <li><?= $a['kota']; ?></li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>