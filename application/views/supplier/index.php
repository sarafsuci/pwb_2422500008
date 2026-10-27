<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"><div class="row mb-2">
            <div class="col-sm-6"><h1>Data Supplier</h1></div>
            <div class="col-sm-6"><ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url('admin'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Supplier</li>
            </ol></div>
        </div></div>
    </section>
    <section class="content"><div class="container-fluid">
        <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success"><?= html_escape($this->session->flashdata('success')); ?></div><?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger"><?= html_escape($this->session->flashdata('error')); ?></div><?php endif; ?>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Daftar Supplier</h3>
                <div class="card-tools"><a href="<?= site_url('admin/supplier/tambah'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Supplier</a></div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead><tr><th>No</th><th>Nama Supplier</th><th>Telepon</th><th>Email</th><th>Alamat</th><th>Aksi</th></tr></thead>
                    <tbody>
                    <?php if (!empty($supplier)): ?>
                        <?php $no = 1; foreach ($supplier as $item): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= html_escape($item['nama_supplier']); ?></td>
                            <td><?= html_escape($item['telepon']); ?></td>
                            <td><?= html_escape($item['email'] ?? ''); ?></td>
                            <td><?= nl2br(html_escape($item['alamat'] ?? '')); ?></td>
                            <td class="text-nowrap">
                                <a href="<?= site_url('admin/supplier/ubah/' . $item['id_supplier']); ?>" class="btn btn-success btn-sm">Ubah</a>
                                <a href="<?= site_url('admin/supplier/hapus/' . $item['id_supplier']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus supplier ini?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">Belum ada data supplier.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div></section>
</div>
