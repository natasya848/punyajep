<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Keuangan Bulan <?= $bulan ?>/<?= $tahun ?></h3>
                    <p class="text-subtitle text-muted">Semua transaksi pemasukan dan pengeluaran pada bulan <?= $bulan ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('laba') ?>">Laba Bulanan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail <?= $bulan ?>/<?= $tahun ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <strong>Rincian Transaksi Bulan <?= $bulan ?>/<?= $tahun ?></strong>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalInput">
                        <i class="fa fa-plus"></i> Input Transaksi
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-detail">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($kas as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= date('d-m-Y', strtotime($row->tanggal)) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $row->jenis == 'Pemasukan' ? 'success' : 'danger' ?>">
                                                <?= $row->jenis ?>
                                            </span>
                                        </td>
                                        <td>Rp <?= number_format($row->nominal, 0, ',', '.') ?></td>
                                        <td><?= esc($row->keterangan) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <!-- Modal Input Transaksi -->
<div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="modalInputLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('laba/simpan_keuangan') ?>" method="post">
      <input type="hidden" name="bulan" value="<?= $bulan ?>">
      <input type="hidden" name="tahun" value="<?= $tahun ?>">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalInputLabel">Input Transaksi Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>

          </div>

          <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Transaksi</label>
            <select name="jenis" id="jenis" class="form-select" required>
              <option value="">Pilih Jenis</option>
              <option value="Pemasukan">Pemasukan</option>
              <option value="Pengeluaran">Pengeluaran</option>
            </select>
          </div>

          <div class="mb-3">
              <label for="nominal" class="form-label">Nominal</label>
              <input type="text" id="nominal_view" class="form-control" required>
              <input type="hidden" name="nominal" id="nominal">
            </div>

          <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#table-detail').DataTable();
    });
</script>

<script>
  const nominalView = document.getElementById('nominal_view');
  const nominalReal = document.getElementById('nominal');

  nominalView.addEventListener('input', function (e) {
    // Ambil angka asli tanpa simbol/karakter lain
    let numberString = e.target.value.replace(/[^,\d]/g, '').toString();
    let split = numberString.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;

    e.target.value = 'Rp ' + rupiah;
    nominalReal.value = numberString.replace(/\./g, '');

  });
</script>