<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Kota</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kota</li>
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
              <h5 class="card-title">Kota</h5>
              <p class="card-text">
                <a href="<?= base_url('admin/kota/tambah') ?>" class="btn btn-labeled btn-primary">
                <span class="btn-label">
                    <i class="fa fa-plus"></i>
                    </span>
                    Kota
                </a>
                <div class="card-body">
                  <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success"><?= html_escape($this->session->flashdata('success')); ?></div>
                  <?php endif ?>
                  <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger"><?= html_escape($this->session->flashdata('error')); ?></div>
                  <?php endif ?>
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Kota</th>
                        <th>Jenis Kota</th>
                        <th>Provinsi</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($kota as $item) : ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?= $no ?></td>
                          <td><?= html_escape($item['nama_kota008']) ?></td>
                          <td><?= html_escape($item['jenis_kota008']) ?></td>
                          <td><?= html_escape($item['provinsi008']) ?></td>
                          <td><?= html_escape($item['status008']) ?></td>
                          <td>
                            <a href="<?= site_url('admin/kota/ubah/' . $item['id_kota008']); ?>"><span class="badge bg-success">Ubah</span></a>
                            <a href="<?= site_url('admin/kota/hapus/' . $item['id_kota008']); ?>" onclick="return confirm('Hapus kota ini?')"><span class="badge bg-danger">Hapus</span></a>
                          </td>
                        </tr>
                      <?php $no++; endforeach ?>
                      <?php if (empty($kota)) : ?>
                        <tr><td colspan="6" class="text-center">Belum ada data kota.</td></tr>
                      <?php endif ?>
                    </tbody>
                  </table>
                </div>
              </p>
            </div>
          </div>

        </div>
        <!-- /.col-md-6 -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</div>
