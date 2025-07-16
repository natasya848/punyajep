<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Input Keuangan</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Input Keuangan</li>
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
                <form class="form-horizontal" method="post" action="<?= base_url('laba/simpan_keuangan') ?>">
                  <div class="row">
                    <div class="col-md-6">

                      <div class="mb-3">
                        <label for="jenis">Jenis Transaksi</label>
                        <select name="jenis" id="jenis" class="form-select" required>
                          <option value="">-- Pilih Jenis --</option>
                          <option value="Pemasukan">Pemasukan</option>
                          <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                      </div>

                      <!-- Nominal -->
                      <div class="mb-3">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal" required>
                      </div>

                      <!-- Keterangan -->
                      <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Contoh: DP, biaya cat, dll" required></textarea>
                      </div>

                    </div>
                  </div>

                  <div class="col-sm-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
