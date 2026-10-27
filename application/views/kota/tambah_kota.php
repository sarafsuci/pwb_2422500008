<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Tambah Kota</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/kota'); ?>">Kota</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Form Tambah Kota</h3></div>
                <?= form_open('admin/kota/simpan'); ?>
                    <div class="card-body">
                        <?php if (validation_errors()): ?><div class="alert alert-danger"><?= validation_errors(); ?></div><?php endif; ?>
                        <div class="form-group">
                            <label for="nama_kota008">Nama Kota</label>
                            <input type="text" name="nama_kota008" id="nama_kota008" class="form-control" maxlength="50" value="<?= set_value('nama_kota008'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kota008">Jenis Kota</label>
                            <select name="jenis_kota008" id="jenis_kota008" class="form-control" required>
                                <option value="">-- Pilih Jenis Kota --</option>
                                <option value="Kota" <?= set_select('jenis_kota008', 'Kota'); ?>>Kota</option>
                                <option value="Kabupaten" <?= set_select('jenis_kota008', 'Kabupaten'); ?>>Kabupaten</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="provinsi008">Provinsi</label>
                            <input type="text" name="provinsi008" id="provinsi008" class="form-control" maxlength="10" value="<?= set_value('provinsi008'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="status008">Status</label>
                            <select name="status008" id="status008" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif" <?= set_select('status008', 'Aktif'); ?>>Aktif</option>
                                <option value="Tidak Aktif" <?= set_select('status008', 'Tidak Aktif'); ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('admin/kota'); ?>" class="btn btn-secondary">Batal</a>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </section>
</div>
