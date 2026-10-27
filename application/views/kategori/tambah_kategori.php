<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1>Tambah Kategori</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Home</a></li><li class="breadcrumb-item"><a href="<?= site_url('admin/kategori'); ?>">Kategori</a></li><li class="breadcrumb-item active">Tambah</li></ol></div></div></div></section>
    <section class="content"><div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Form Tambah Kategori</h3></div>
            <?= form_open('admin/kategori/simpan'); ?>
                <div class="card-body">
                    <?php if (validation_errors()): ?><div class="alert alert-danger"><?= validation_errors(); ?></div><?php endif; ?>
                    <div class="form-group">
                        <label for="nama">Nama Kategori</label>
                        <input type="text" name="nama" id="nama" class="form-control" maxlength="100" value="<?= set_value('nama'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" maxlength="100"><?= set_value('deskripsi'); ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= site_url('admin/kategori'); ?>" class="btn btn-secondary">Batal</a>
                </div>
            <?= form_close(); ?>
        </div>
    </div></section>
</div>