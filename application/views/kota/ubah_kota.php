<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Kota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/kota'); ?>">Kota</a></li>
                        <li class="breadcrumb-item active">Ubah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ubah Kota</h5>

                            <p class="card-text">
                                <?= form_open('admin/kota/update/' . $kota['id_kota008']); ?>
                                    <div class="mb-3">
                                        <label for="nama_kota008" class="form-label">Nama Kota</label>
                                        <input type="text" class="form-control" name="nama_kota008" id="nama_kota008" maxlength="50" value="<?= set_value('nama_kota008', $kota['nama_kota008']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kota008" class="form-label">Jenis Kota</label>
                                        <select class="form-control" name="jenis_kota008" id="jenis_kota008" required>
                                            <option value="Kota" <?= set_select('jenis_kota008', 'Kota', $kota['jenis_kota008'] === 'Kota'); ?>>Kota</option>
                                            <option value="Kabupaten" <?= set_select('jenis_kota008', 'Kabupaten', $kota['jenis_kota008'] === 'Kabupaten'); ?>>Kabupaten</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="provinsi008" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" name="provinsi008" id="provinsi008" maxlength="10" value="<?= set_value('provinsi008', $kota['provinsi008']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status008" class="form-label">Status</label>
                                        <select class="form-control" name="status008" id="status008" required>
                                            <option value="Aktif" <?= set_select('status008', 'Aktif', $kota['status008'] === 'Aktif'); ?>>Aktif</option>
                                            <option value="Tidak Aktif" <?= set_select('status008', 'Tidak Aktif', $kota['status008'] === 'Tidak Aktif'); ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                    <a href="<?= base_url('admin/kota') ?>" class="btn btn-danger">Kembali</a>
                                <?= form_close(); ?>
                            </p>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-6 -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
