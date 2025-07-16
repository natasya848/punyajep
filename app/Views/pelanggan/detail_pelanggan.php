<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4><?= $title?> </h4>
    </div>

        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nama pelanggan</th>
                        <th>No HP</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Deleted At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= esc($pelanggan->nama_pelanggan) ?></td>
                        <td><?= esc($pelanggan->no_hp) ?></td>
                        <td><?= esc($pelanggan->created_at) ?></td>
                        <td><?= esc($pelanggan->updated_at ?? '-') ?></td>
                        <td><?= esc($pelanggan->deleted_at ?? '-') ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary shadow">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>