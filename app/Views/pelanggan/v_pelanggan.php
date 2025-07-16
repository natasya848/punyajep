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
                    <div class="d-flex gap-2">
                        <a href="<?php echo base_url('pelanggan/tambah_pelanggan/')?>"><button class="btn btn-primary mt-2"><i class="fa-solid fa-plus"></i>
                            Tambah</button></a>

                        <a href="<?= base_url('pelanggan/dihapus_pelanggan') ?>">
                           <button class="btn btn-secondary mt-2">Data pelanggan yang Dihapus</button>
                        </a>
                    </div>
                </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-pelanggan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                            $no=1; foreach ($pelanggan as $b) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $b->nama_pelanggan?> </td>
                                <td><?php echo $b->no_hp ?> </td>
                                <td><?= $b->alamat ?? '-' ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item text-info" href="<?= base_url('pelanggan/detail_pelanggan/' . $b->id_pelanggan) ?>">
                                                    <i class="fa-solid fa-info me-1"></i> Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-warning" href="<?= base_url('pelanggan/edit_pelanggan/'. $b->id_pelanggan) ?>">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="<?= base_url('pelanggan/delete_pelanggan/'. $b->id_pelanggan) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

<script>
	$(document).ready(function() {
		$('#table-pelanggan').DataTable({
		});
	});
</script>