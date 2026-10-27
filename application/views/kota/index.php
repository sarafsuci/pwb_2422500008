<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><div class="row mb-2">
        <div class="col-sm-6"><h1>Data Kota</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>">Home</a></li><li class="breadcrumb-item active">Kota</li></ol></div>
    </div></div></section>
    <section class="content"><div class="container-fluid">
        <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success"><?= html_escape($this->session->flashdata('success')); ?></div><?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger"><?= html_escape($this->session->flashdata('error')); ?></div><?php endif; ?>
        <div class="card"><div class="card-header"><h3 class="card-title">Daftar Kota</h3><div class="card-tools"><a href="<?= site_url('admin/kota/tambah'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Kota</a></div></div>
            <div class="card-body"><table class="table table-bordered table-hover"><thead><tr><th style="width: 60px">No</th><th>Nama Kota</th><th>Jenis Kota</th><th>Provinsi</th><th>Status</th><th style="width: 160px">Aksi</th></tr></thead><tbody>
                <?php if (!empty($kota)): ?>
                    <?php $no = 1; foreach ($kota as $item): ?><tr><td><?= $no++; ?></td><td><?= html_escape($item['nama_kota008']); ?></td><td><?= html_escape($item['jenis_kota008']); ?></td><td><?= html_escape($item['provinsi008']); ?></td><td><?= html_escape($item['status008']); ?></td><td><a href="<?= site_url('admin/kota/ubah/' . $item['id_kota008']); ?>" class="btn btn-success btn-sm">Ubah</a> <a href="<?= site_url('admin/kota/hapus/' . $item['id_kota008']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus kota ini?');">Hapus</a></td></tr><?php endforeach; ?>
                <?php else: ?><tr><td colspan="6" class="text-center">Belum ada data kota.</td></tr><?php endif; ?>
            </tbody></table></div>
        </div>
    </div></section>
</div>
