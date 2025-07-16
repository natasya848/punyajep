<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?=$title?></h3>
                    <p class="text-subtitle text-muted">Anda dapat melihat <?=$title?> di bawah</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
					<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>

        <section class="section">
            <div class="card p-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php if (!empty($deleted_mobil)): ?>    
                            <table class="table table-striped" id="table-hpsmobil">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Plat</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Total Perbaikan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            <tbody>
                            <?php $no = 1; foreach ($deleted_mobil as $value): ?>
                                
                                <tr>
                                <td><?= $no++ ?></td>
                                <td><img src="<?= base_url('uploads/mobil/' . $value->foto_mobil) ?>" width="100"></td>
                                <td><?php echo $value->nama_mobil?> </td>
                                <td><?= $value->plat_mobil ?></td>
                                <td>Rp <?= number_format($value->harga_beli, 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($value->harga_jual, 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($value->total_perbaikan, 0, ',', '.') ?></td>
                                <td>
                                    <?php if($value->status == 'Tersedia'): ?>
                                        <span class="badge bg-success">Tersedia</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Sold</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalKeterangan<?= $value->id_mobil ?>">
                                        Lihat
                                    </button>

                                    <div class="modal fade" id="modalKeterangan<?= $value->id_mobil ?>" tabindex="-1" aria-labelledby="labelKeterangan<?= $value->id_mobil ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="labelKeterangan<?= $value->id_mobil ?>">Keterangan Mobil</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= esc($value->keterangan) ?: '<span class="text-muted">Tidak ada keterangan.</span>' ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= base_url('mobil/restore_mobil/' . $value->id_mobil) ?>" class="btn btn-success my-1"><i class="fa fa-undo"></i></a>

                                    <a href="<?= base_url('mobil/hapus_mobil/' . $value->id_mobil) ?>" class="btn btn-danger my-1" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">Tidak ada <?=$title?>.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="position-fixed bottom-3 end-3">
        <a href="<?= base_url('mobil') ?>" class="btn btn-secondary shadow">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<script>
	$(document).ready(function() {
		$('#table-hpsmobil').DataTable({
		});
	});
</script>