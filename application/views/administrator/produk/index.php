<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
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
              <p class="card-text">
                <i class="fas fa-table mr-1"></i>
                Semua Produk
                <a href="<?= base_url('admin/produk/tambah') ?>" class="btn btn-primary btn-sm">
                  <i class="fa fa-plus"></i>
                  Produk
                </a>
              </p>
              <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message') ?>
              <?php endif ?>
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Kategori</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Stok</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($list_produk as $produk) : ?>
                      <tr>
                        <th scope="row"><?= $no ?></th>
                        <td><?= html_escape($produk['pd_nama']) ?></td>
                        <td><?= html_escape($produk['kt_nama']) ?></td>
                        <td>Rp. <?= number_format($produk['harga']) ?></td>
                        <td><?= (int) $produk['stok'] ?></td>
                        <td><?= html_escape($produk['deskripsi']) ?></td>
                        <td>
                          <a href="<?= base_url('admin/produk/ubah/') ?><?= $produk['id_produk'] ?>"><span class="badge badge-success">Ubah</span></a>
                          <a href="<?= base_url('admin/produk/hapus/') ?><?= $produk['id_produk'] ?>" onclick="return confirm('Yakin ingin menghapus produk ini beserta semua gambarnya?')"><span class="badge badge-danger">Hapus</span></a>
                        </td>
                      </tr>
                    <?php $no++;
                    endforeach ?>
                    <?php if (empty($list_produk)) : ?>
                      <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data produk.</td>
                      </tr>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
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