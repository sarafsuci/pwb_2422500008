<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><div class="row mb-2">
        <div class="col-sm-6"><h1>Ubah Supplier</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>">Home</a></li><li class="breadcrumb-item"><a href="<?= site_url('admin/supplier'); ?>">Supplier</a></li><li class="breadcrumb-item active">Ubah</li></ol></div>
    </div></div></section>
    <section class="content"><div class="container-fluid"><div class="card card-primary">
        <div class="card-header"><h3 class="card-title">Form Ubah Supplier</h3></div>
        <?= form_open('admin/supplier/update/' . $supplier['id_supplier']); ?>
            <div class="card-body">
                <?php if (validation_errors()): ?><div class="alert alert-danger"><?= validation_errors(); ?></div><?php endif; ?>
                <div class="form-group"><label for="nama_supplier">Nama Supplier</label><input type="text" name="nama_supplier" id="nama_supplier" class="form-control" maxlength="100" value="<?= set_value('nama_supplier', $supplier['nama_supplier']); ?>" required></div>
                <div class="form-group"><label for="telepon">Telepon</label><input type="text" name="telepon" id="telepon" class="form-control" maxlength="20" value="<?= set_value('telepon', $supplier['telepon']); ?>" required></div>
                <div class="form-group"><label for="email">Email</label><input type="email" name="email" id="email" class="form-control" maxlength="100" value="<?= set_value('email', $supplier['email'] ?? ''); ?>"></div>
                <div class="form-group"><label for="alamat">Alamat</label><textarea name="alamat" id="alamat" class="form-control" rows="4"><?= set_value('alamat', $supplier['alamat'] ?? ''); ?></textarea></div>
            </div>
            <div class="card-footer"><button type="submit" class="btn btn-primary">Simpan Perubahan</button><a href="<?= site_url('admin/supplier'); ?>" class="btn btn-secondary">Batal</a></div>
        <?= form_close(); ?>
    </div></div></section>
</div>
