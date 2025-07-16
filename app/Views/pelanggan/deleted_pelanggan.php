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
                        <?php if (!empty($deleted_pelanggan)): ?>    
                            <table class="table table-striped" id="table-hpspelanggan">
                                <thead>
                                <tr>
                                    <th>No</th>
                                     <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; foreach ($deleted_pelanggan as $value): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?php echo $value->nama_pelanggan?> </td>
                                    <td><?php echo $value->no_hp ?> </td>
                                    <td><?= $value->alamat ?? '-' ?></td>
                                    <td>
                                        <a href="<?= base_url('pelanggan/restore_pelanggan/' . $value->id_pelanggan) ?>" class="btn btn-success my-1"><i class="fa fa-undo"></i></a>

                                        <a href="<?= base_url('pelanggan/hapus_pelanggan/' . $value->id_pelanggan) ?>" class="btn btn-danger my-1" 
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
        <a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary shadow">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<script>
	$(document).ready(function() {
		$('#table-hpspelanggan').DataTable({
		});
	});
</script>