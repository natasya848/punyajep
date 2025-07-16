<!-- Lightbox2 CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

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
                        <a href="<?php echo base_url('tukar/tambah/')?>"><button class="btn btn-primary mt-2"><i class="fa-solid fa-plus"></i>
                            Tambah</button></a>
                    </div>
                </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="table-tukar">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>Mobil</th>
                                <th>Tukar ke Mobil</th>
                                <th>Harga Beli</th>
                                <th>Tambahan Harga Bayar</th>
                                <th>Dokumen Pembeli</th>
                                <th>Metode Pembayaran</th>
                                <th>Profit</th>
                                <th>Tanggal Jual</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $no=1; foreach ($tukar as $s) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $s->nama_pembeli ?></td>
                                <td><?= $s->nama_mobil ?> - <?= $s->plat_mobil ?></td>
                                <td><?= $s->tukar_mobil ?><img src="<?= base_url('uploads/mobil_tukar/' . $s->foto) ?>" width="100"></td>
                                <td>Rp <?= number_format($s->harga_tukar, 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($s->tambahan_harga, 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($s->dokumen_pembeli): ?>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDokumen<?= $s->id_sold ?>">
                                            <i class="fa fa-image"></i> Lihat Dokumen
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalDokumen<?= $s->id_sold ?>" tabindex="-1" aria-labelledby="labelDokumen<?= $s->id_sold ?>" aria-hidden="true">
                                          <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="labelDokumen<?= $s->id_sold ?>">Dokumen Pembeli (<?= esc($s->pembeli) ?>)</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="d-flex flex-wrap gap-2">
                                                    <?php 
                                                    $dokumens = json_decode($s->dokumen_pembeli); 
                                                    if ($dokumens):
                                                        foreach ($dokumens as $dok):
                                                    ?>
                                                        <a href="<?= base_url('uploads/dokumen_pembeli/' . $dok) ?>" data-lightbox="dokumen-<?= $s->id_sold ?>" data-title="Dokumen <?= esc($s->pembeli) ?>">
                                                            <img src="<?= base_url('uploads/dokumen_pembeli/' . $dok) ?>" width="100" height="100" style="object-fit:cover; border-radius:6px; border:1px solid #ddd;">
                                                        </a>
                                                    <?php 
                                                        endforeach;
                                                    else:
                                                        echo '<span class="text-muted">Tidak ada dokumen</span>';
                                                    endif;
                                                    ?>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada dokumen</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= !empty($s->metode_pembayaran) ? $s->metode_pembayaran : '-' ?></td>
                                <td>Rp <?= number_format($s->profit, 0, ',', '.') ?></td>
                                <td><?= $s->tanggal_jual ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <?php if ($s->metode_pembayaran == 'Kredit' && $s->profit_credit == null): ?>
                                            <div>
                                                <button class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalProfit<?= $s->id_sold ?>">
                                                    Input Profit Kredit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modalProfit<?= $s->id_sold ?>" tabindex="-1" aria-labelledby="modalLabel<?= $s->id_sold ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="<?= base_url('mobil/simpan_profit_credit/' . $s->id_sold) ?>" method="post">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalLabel<?= $s->id_sold ?>">Input Profit Kredit</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="profit_credit_<?= $s->id_sold ?>" class="form-label">Nominal Profit Kredit</label>
                                                                        <input type="text" class="form-control rupiah" id="profit_credit_<?= $s->id_sold ?>" name="profit_credit" required>
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
                                        <?php endif; ?>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item text-warning" href="<?= base_url('tukar/edit_tukar/' . $s->id) ?>">
                                                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="<?= base_url('tukar/hapus_tukar/' . $s->id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fa-solid fa-trash me-1"></i> Hapus
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
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
        $('#table-tukar').DataTable({
        });
    });
</script>