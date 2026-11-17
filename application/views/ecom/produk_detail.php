<div class="container mb-3 mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="slider-for">
                <?php foreach ($list_gambar as $gambar) : ?>
                    <div>
                        <img src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>" class="d-block w-100" alt="<?= $produk['nama'] ?>">
                    </div>
                <?php endforeach ?>
            </div>
            <div class="slider-nav mt-3">
                <?php foreach ($list_gambar as $gambar) : ?>
                    <div class="px-2">
                        <img src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>" class="d-block w-100" alt="<?= $produk['nama'] ?>">
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="col-md-6">
            <h3><?= $produk['nama'] ?></h3>
            <p>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>
            <p>ID Produk: <?= $produk['id_produk'] ?></p>
            <p>STOK: <?= $produk['stok'] ?></p>
            <div class="mb-3">
                <label for="jumlah_beli" class="form-label">jumlah beli</label>
                <input type="number" class="form-control" name="jumlah_beli" id="jumlah_beli" value="1" min="1" max="<?= $produk['stok'] ?>">
            </div>
            <button type="button" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> tambah ke keranjang</button>
            <h5 class="mt-4">Deskripsi:</h5>
            <p><?= $produk['deskripsi'] ?></p>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            centerMode: true,
            focusOnSelect: true
        });
    });
</script>
