<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3><?= $title ?></h3>
          <p class="text-subtitle text-muted">Silakan edit data mobil di bawah</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <section id="basic-horizontal-layouts">
      <div class="row match-height">
        <div class="col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <form action="<?= base_url('mobil/update/' . $mobil->id_mobil) ?>" method="post" enctype="multipart/form-data">
                  <div class="form-body">
                    <div class="row">

                      <!-- Kolom kiri -->
                      <div class="col-md-6">

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label><br>
                            <?php if ($mobil->foto_mobil): ?>
                                <img src="<?= base_url('uploads/mobil/'.$mobil->foto_mobil) ?>" width="120" class="mb-2">
                            <?php endif; ?>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            <input type="hidden" name="foto_lama" value="<?= $mobil->foto_mobil ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Mobil</label>
                            <input type="text" id="nama" class="form-control" name="nama" value="<?= old('nama', $mobil->nama_mobil) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="plat" class="form-label">Plat Mobil</label>
                            <input type="text" id="plat" class="form-control" name="plat" value="<?= old('plat', $mobil->plat_mobil) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Harga Beli</label>
                            <input type="text" class="form-control format-rupiah" name="harga_beli" value="Rp <?= number_format($mobil->harga_beli,0,',','.') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Harga Jual</label>
                            <input type="text" class="form-control format-rupiah" name="harga_jual" value="Rp <?= number_format($mobil->harga_jual,0,',','.') ?>" required>
                        </div>
                      </div>

                      <!-- Kolom kanan -->
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label>Total Perbaikan</label>
                            <input type="text" class="form-control format-rupiah" name="total_perbaikan" value="Rp <?= number_format($mobil->total_perbaikan,0,',','.') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan"><?= old('keterangan', $mobil->keterangan) ?></textarea>
                        </div>
                  
                        <div class="mb-3">
                            <label>Tanggal Masuk</label>
                            <input type="date" class="form-control" name="masuk" value="<?= old('masuk', $mobil->tanggal_masuk) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select class="form-select" name="status" required>
                                <option value="Tersedia" <?= ($mobil->status == 'Tersedia' ? 'selected':'') ?>>Tersedia</option>
                                <option value="Sold" <?= ($mobil->status == 'Sold' ? 'selected':'') ?>>Sold</option>
                            </select>
                        </div>
                      </div>

                      <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div> <!-- card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script>
  document.querySelectorAll(".format-rupiah").forEach(function(input) {
    input.addEventListener("input", function () {
      let value = this.value.replace(/[^,\d]/g, '').toString();
      let split = value.split(',');
      let sisa = split[0].length % 3;
      let rupiah = split[0].substr(0, sisa);
      let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
      this.value = 'Rp ' + rupiah;
    });
  });
</script>
