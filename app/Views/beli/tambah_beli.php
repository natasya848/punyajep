<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Input <?=$title?></h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav
          aria-label="breadcrumb"
          class="breadcrumb-header float-start float-lg-end"
          >
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?=base_url('admin')?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Input <?=$title?>
            </li>
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
              <form class="form-horizontal form-label-left" novalidate action="<?= base_url('mobil/simpan_jual')?>" method="post" enctype="multipart/form-data">
                <form class="form form-horizontal">
                  <div class="form-body">

                    <div class="row">
                        <!-- Kolom kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Pilih Mobil</label>
                                <select name="id_mobil" id="id_mobil" class="form-select" required>
                                    <option value="">- Pilih Mobil -</option>
                                    <?php foreach ($mobil as $m): ?>
                                        <option 
                                            value="<?= $m->id_mobil ?>"
                                            data-harga-beli="<?= $m->harga_beli ?>"
                                            data-harga-jual="<?= $m->harga_jual ?>"
                                        >
                                            <?= $m->plat_mobil ?> - <?= $m->nama_mobil ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="pembeli">Nama Pembeli</label>
                                <input type="text" name="pembeli" id="pembeli" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="dokumen_pembeli">Dokumen Pembeli </label>
                                <input type="file" id="dokumen_pembeli" class="form-control" accept="image/*" multiple>
                                <input type="hidden" name="dokumen_pembeli_data" id="dokumen_pembeli_data">
                            </div>
                            <div id="preview" class="mt-2 d-flex flex-wrap"></div>

                           <div class="mb-3">
                              <label for="metode_pembayaran">Metode Pembayaran</label>
                              <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="Cash">Cash</option>
                                <option value="Kredit">Kredit</option>
                              </select>
                            </div>

                        </div>

                        <!-- Kolom kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_jual">Tanggal Jual</label>
                                <input type="date" name="tanggal_jual" id="tanggal_jual" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="text" id="harga_beli" class="form-control" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="text" name="harga_jual" id="harga_jual" class="form-control" required>
                            </div>
                        </div>
                    </div>


                      <div class="col-sm-12 d-flex justify-content-end">
                        <button
                        type="submit"
                        class="btn btn-primary me-1 mb-1"
                        >
                        Submit
                      </button>
                      <button
                      type="reset"
                      class="btn btn-light-secondary me-1 mb-1"
                      >
                      Reset
                    </button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<script>
    let filesArray = [];

    const input = document.getElementById('dokumen_pembeli');
    const preview = document.getElementById('preview');
    const hiddenInput = document.getElementById('dokumen_pembeli_data');

    input.addEventListener('change', function(event){
        Array.from(event.target.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                filesArray.push({
                    name: file.name,
                    dataUrl: e.target.result
                });

                renderPreview();
            };
            reader.readAsDataURL(file);
        });

        // reset input supaya bisa pilih file yang sama lagi nanti
        input.value = "";
    });

    function renderPreview() {
        preview.innerHTML = '';
        filesArray.forEach((file, index) => {
            const container = document.createElement('div');
            container.style.position = 'relative';
            container.style.margin = '5px';

            const img = document.createElement('img');
            img.src = file.dataUrl;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.objectFit = 'cover';
            img.style.border = '1px solid #ddd';
            img.style.borderRadius = '8px';

            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '&times;';
            closeBtn.style.position = 'absolute';
            closeBtn.style.top = '0';
            closeBtn.style.right = '0';
            closeBtn.style.background = 'rgba(255,0,0,0.7)';
            closeBtn.style.border = 'none';
            closeBtn.style.color = 'white';
            closeBtn.style.borderRadius = '50%';
            closeBtn.style.width = '20px';
            closeBtn.style.height = '20px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.onclick = () => {
                filesArray.splice(index, 1);
                renderPreview();
            };

            container.appendChild(img);
            container.appendChild(closeBtn);
            preview.appendChild(container);
        });

        // simpan ke hidden input dalam bentuk JSON
        hiddenInput.value = JSON.stringify(filesArray);
    }
</script>

<script>
    const hargaJualInput = document.getElementById("harga_jual");

    hargaJualInput.addEventListener("input", function () {
        let value = this.value.replace(/[^,\d]/g, "").toString();
        let split = value.split(",");
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
        this.value = rupiah ? "Rp " + rupiah : "";
    });

    document.getElementById('id_mobil').addEventListener('change', function() {
        let selected = this.options[this.selectedIndex];
        let hargaBeli = selected.getAttribute('data-harga-beli') || 0;
        let hargaJual = selected.getAttribute('data-harga-jual') || 0;

        document.getElementById('harga_beli').value = 'Rp ' + Number(hargaBeli).toLocaleString('id-ID');
        document.getElementById('harga_jual').value = 'Rp ' + Number(hargaJual).toLocaleString('id-ID');
    });

</script>



