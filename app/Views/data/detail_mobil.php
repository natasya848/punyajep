<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4><?= $title?> </h4>
    </div>

        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nama Mobil</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Deleted At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= esc($mobil->nama_mobil) ?></td>
                        <td><?= esc($mobil->tanggal_masuk) ?></td>
                        <td><?= esc($mobil->status) ?></td>
                        <td><?= esc($mobil->created_at) ?></td>
                        <td><?= esc($mobil->updated_at ?? '-') ?></td>
                        <td><?= esc($mobil->deleted_at ?? '-') ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="<?= base_url('mobil') ?>" class="btn btn-secondary shadow">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>