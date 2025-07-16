<!-- Lightbox2 CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3><?= $title ?></h3>
                    <p class="text-subtitle text-muted">Anda dapat melihat <?= $title ?> di bawah</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible show fade">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <!-- <div class="d-flex gap-2">
                        <a href="<?php echo base_url('mobil/tambah_mobil/') ?>"><button class="btn btn-primary mt-2"><i class="fa-solid fa-plus"></i>
                            Tambah</button></a>

                        <a href="<?= base_url('mobil/dihapus_mobil') ?>">
                           <button class="btn btn-secondary mt-2">Data Mobil yang Dihapus</button>
                        </a>
                    </div> -->
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-sold">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Plat</th>
                                    <th>Nama Pembeli</th>
                                    <th>Dokumen Pembeli</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Total Perbaikan</th>
                                    <th>Profit</th>
                                    <th>Tanggal Jual</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php $no = 1;
                            foreach ($sold as $s) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img src="<?= base_url('uploads/mobil/' . $s->foto_mobil) ?>" width="100"></td>
                                    <td><?= $s->plat_mobil ?></td>
                                    <td><?= $s->pembeli ?></td>
                                    <td>
                                        <?php if ($s->dokumen_pembeli): ?>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalDokumen<?= $s->id_sold ?>">
                                                <i class="fa fa-image"></i> Lihat Dokumen
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalDokumen<?= $s->id_sold ?>" tabindex="-1"
                                                aria-labelledby="labelDokumen<?= $s->id_sold ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="labelDokumen<?= $s->id_sold ?>">Dokumen
                                                                Pembeli (<?= esc($s->pembeli) ?>)</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex flex-wrap gap-2">
                                                                <?php
                                                                $dokumens = json_decode($s->dokumen_pembeli);
                                                                if ($dokumens):
                                                                    foreach ($dokumens as $dok):
                                                                        ?>
                                                                        <a href="<?= base_url('uploads/dokumen_pembeli/' . $dok) ?>"
                                                                            data-lightbox="dokumen-<?= $s->id_sold ?>"
                                                                            data-title="Dokumen <?= esc($s->pembeli) ?>">
                                                                            <img src="<?= base_url('uploads/dokumen_pembeli/' . $dok) ?>"
                                                                                width="100" height="100"
                                                                                style="object-fit:cover; border-radius:6px; border:1px solid #ddd;">
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

                                    <td>Rp <?= number_format($s->harga_beli, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($s->harga_jual, 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($s->total_perbaikan, 0, ',', '.') ?></td>
                                    <td>
                                        <?php
                                        // $profit = ($s->harga_jual - ($s->harga_beli + $s->total_perbaikan));
                                        $profit = ($s->harga_jual - ($s->harga_beli + $s->total_perbaikan)) + ($s->profit_credit ?? 0);

                                        ?>
                                        Rp <?= number_format($profit, 0, ',', '.') ?>
                                    </td>
                                    <td><?= $s->tanggal_jual ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-success"
                                            href="<?= base_url('sold/printImage/' . $s->id_sold) ?>" target="_blank">
                                            <i class="fa fa-print"></i>
                                        </a>

                                        <a class="btn btn-sm btn-danger"
                                            href="<?= base_url('sold/hapus_sold/' . $s->id_sold) ?>"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
                $(document).ready(function () {
                    $('#table-sold').DataTable({
                    });
                });
            </script>