<?php
function bulanIndo($bulan) {
    $namaBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 
        4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    return $namaBulan[intval($bulan)];
}
?>

<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <h3><?= $title ?></h3>
                    <p class="text-subtitle text-muted">Laporan laba per bulan dalam tampilan elegan</p>
                </div>
                <div class="col-12 col-md-6 text-md-end">
                    <nav aria-label="breadcrumb" class="breadcrumb-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Filter Tahun -->
        <div class="row mb-4">
            <div class="col-md-4">
                <select id="filter-tahun" class="form-select shadow-sm">
                    <?php foreach ($tahun_list as $t): ?>
                        <option value="<?= $t ?>" <?= ($t == date('Y')) ? 'selected' : '' ?>><?= $t ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Section Cards -->
        <div class="row gy-4" id="section-laba">
            <?php foreach ($rekap as $r): ?>
                <div class="col-12 col-md-6 item-laba" data-tahun="<?= $r->tahun ?>">
    <div class="card shadow-sm border-0" style="border-radius: 1rem; transition: transform 0.3s;">
        <div class="card-body p-4" style="background: linear-gradient(135deg, #f6f8fc, #f9fbfd); border-radius: 1rem;">
            <h4 class="card-title mb-3"><?= bulanIndo($r->bulan) ?> <?= $r->tahun ?></h4>
            <div class="fs-6 mb-3">
                <div class="mb-2"><strong>Penjualan:</strong> Rp <?= number_format($r->total_penjualan, 0, ',', '.') ?></div>
                <div class="mb-2"><strong>Modal:</strong> Rp <?= number_format($r->total_modal, 0, ',', '.') ?></div>
                <div class="mb-2"><strong>Profit Mobil:</strong> Rp <?= number_format($r->total_laba, 0, ',', '.') ?></div>
                <div class="mb-2"><strong>Rugi:</strong> Rp <?= number_format(abs($r->total_rugi), 0, ',', '.') ?></div>
                <div class="mb-2"><strong>Pemasukan Lain:</strong> Rp <?= number_format($r->pemasukan, 0, ',', '.') ?></div>
                <div class="mb-2"><strong>Pengeluaran Lain:</strong> Rp <?= number_format($r->pengeluaran, 0, ',', '.') ?></div>
                <?php
                  $laba_bersih_total = $r->total_laba + $r->pemasukan - $r->total_rugi - $r->pengeluaran;
                ?>
                <div >
                  <strong>Laba Untung Bersih Total:</strong> Rp <?= number_format($laba_bersih_total, 0, ',', '.') ?>
                </div>
            </div>

            <a href="<?= base_url('laba/detail/' . $r->bulan . '/' . $r->tahun) ?>" class="btn btn-sm btn-outline-primary">
                <i class="fa fa-search"></i> Lihat Detail
            </a>
        </div>
    </div>
</div>

            <?php endforeach; ?>
        </div>

    </div>
</div>

<script>
    $('#filter-tahun').on('change', function() {
        let tahun = $(this).val();
        $('.item-laba').hide().filter(function() {
            return $(this).data('tahun') == tahun;
        }).fadeIn();
    });

    // optional hover effect manual
    $(document).on('mouseenter', '.card', function(){
        $(this).css('transform','scale(1.02)');
    }).on('mouseleave', '.card', function(){
        $(this).css('transform','scale(1)');
    });
</script>
