<!DOCTYPE html>
<html>

<head>
    <?php
    function terbilang($number)
    {
        $words = [
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas"
        ];

        if ($number < 12) {
            return $words[$number];
        } elseif ($number < 20) {
            return terbilang($number - 10) . " belas";
        } elseif ($number < 100) {
            return terbilang($number / 10) . " puluh " . terbilang($number % 10);
        } elseif ($number < 200) {
            return "seratus " . terbilang($number - 100);
        } elseif ($number < 1000) {
            return terbilang($number / 100) . " ratus " . terbilang($number % 100);
        } elseif ($number < 2000) {
            return "seribu " . terbilang($number - 1000);
        } elseif ($number < 1000000) {
            return terbilang($number / 1000) . " ribu " . terbilang($number % 1000);
        } elseif ($number < 1000000000) {
            return terbilang($number / 1000000) . " juta " . terbilang($number % 1000000);
        }

        return "angka terlalu besar";
    }

    function tanggal_indo($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $tanggal = date('Y-m-d', strtotime($tanggal));
        [$tahun, $bulanIndex, $hari] = explode('-', $tanggal);

        return $hari . ' ' . $bulan[(int) $bulanIndex] . ' ' . $tahun;
    }
    ?>

    <meta charset="UTF-8">
    <title>Kwitansi Mobil</title>
    <style>
        body {
            margin: 0;
            font-family: Calibri, 'Trebuchet MS', sans-serif;
        }

        .print-area {
            position: relative;
            width: 933px;
            /* A5 landscape width at 96 DPI */
            height: 658px;
            /* A5 landscape height at 96 DPI */
            margin: auto;
            background-image: url("<?= base_url('assets/img/kwitansi_template.png') ?>");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .field {
            position: absolute;
            font-size: 17px;
            font-weight: 500;
        }

        /* 💡 Adjust positions according to your new layout */
        .pembeli {
            top: 93px;
            left: 260px;
        }

        .harga_jual {
            top: 137px;
            left: 260px;
        }

        .nama_mobil {
            top: 175px;
            left: 490px;
        }
        .harga_beli {
            top: 203px;
            left: 370px;
        }

        .plat_mobil {
            top: 268px;
            left: 340px;
        }

        .jumlah {
            top: 358px;
            left: 280px;
        }

        .metode {
            top: 405px;
            left: 255px;
        }

        .tanggal {
            top: 427px;
            right: 135px;
            font-weight: normal;
        }
        

        @media print {
            button {
                display: none;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .print-area {
    position: relative;
 
    margin: auto;
    background-image: url("<?= base_url('assets/img/kwitansi_template.png') ?>");
    background-size: contain; /* or 'cover' */
    background-repeat: no-repeat;
    background-position: top center;
}


            button {
                display: none;
            }

            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <div class="print-area">
        <div class="field pembeli"><?= esc($sold_mobil->pembeli) ?></div>
        <div class="field harga_jual">
            <?= ucfirst(terbilang($sold_mobil->harga_jual)) ?> rupiah
        </div>


        <div class="field harga_beli"><?= number_format($sold_mobil->harga_jual, 0, ',', '.') ?></div>
        <div class="field plat_mobil"><?= esc($sold_mobil->plat_mobil) ?></div>
        <div class="field metode"><?= esc($sold_mobil->metode_pembayaran) ?></div>
        <div class="field jumlah"><?= number_format($sold_mobil->harga_jual, 0, ',', '.') ?></div>
        <div class="field tanggal"><?= tanggal_indo($sold_mobil->tanggal_jual) ?></div>
        <div class="field nama_mobil"><?= esc($sold_mobil->nama_mobil) ?></div>

    </div>

    <div style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">🖨️ Print</button>
    </div>

</body>

</html>