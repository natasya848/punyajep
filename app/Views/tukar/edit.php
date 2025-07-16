<div id="main-content">
  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Edit <?=$title?></h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit <?=$title?></li>
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
                <form action="<?= base_url('tukar/update/' . $data->id) ?>" method="post" enctype="multipart/form-data">
                  <div class="form-body">
                    <div class="row">
                      <!-- Kolom kiri -->
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Pilih Mobil Showroom</label>
                          <select name="id_mobil" class="form-select" disabled>
                            <option value="<?= $data->id_mobil ?>"><?= $data->plat_mobil ?> - <?= $data->nama_mobil ?></option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label>Harga Jual Mobil Showroom</label>
                          <input type="text" name="harga_jual" id="harga_jual" class="form-control format-rupiah"
                            value="Rp <?= number_format($data->harga_jual,0,',','.') ?>">
                        </div>

                        <div class="mb-3">
                          <label>Mobil Tukar (Nama)</label>
                          <input type="text" name="nama_mobil_tukar" class="form-control" value="<?= $data->tukar_mobil ?>">
                        </div>

                        <div class="mb-3">
                          <label>Foto Mobil Tukar</label><br>
                          <?php if ($data->foto): ?>
                            <img src="<?= base_url('uploads/mobil_tukar/'.$data->foto) ?>" width="120" class="mb-2 rounded">
                          <?php endif; ?>
                          <input type="file" name="foto_mobil_tukar" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                          <label>Harga Mobil Tukar</label>
                          <input type="text" name="harga_tukar" id="harga_tukar" class="form-control format-rupiah"
                            value="Rp <?= number_format($data->harga_tukar,0,',','.') ?>">
                        </div>
                      </div>

                      <!-- Kolom kanan -->
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label>Nama Pembeli</label>
                          <input type="text" name="pembeli" class="form-control" value="<?= $data->pembeli ?>">
                        </div>

                        <div class="mb-3">
                            <label>Dokumen Pembeli</label>
                            <input type="file" id="dokumen_pembeli" class="form-control" accept="image/*" multiple>
                            <input type="hidden" name="dokumen_pembeli_data" id="dokumen_pembeli_data">
                            <input type="hidden" name="deleted_files" id="deleted_files">
                            
                            <div id="existing_preview" class="mt-2 d-flex flex-wrap">
                                <?php foreach(json_decode($data->dokumen_pembeli ?? '[]') as $file): ?>
                                    <div class="position-relative me-2 mb-2">
                                        <img src="<?= base_url('uploads/dokumen_pembeli/'.$file) ?>" width="80" class="rounded border">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 btn-remove-existing" data-file="<?= $file ?>" style="padding:2px 6px;">×</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div id="new_preview" class="mt-2 d-flex flex-wrap"></div>
                        </div>

                        <div class="mb-3">
                          <label>Metode Pembayaran</label>
                          <select name="metode_pembayaran" class="form-control">
                            <option value="">Pilih</option>
                            <option value="Cash" <?= $data->metode_pembayaran == 'Cash' ? 'selected' : '' ?>>Cash</option>
                            <option value="Kredit" <?= $data->metode_pembayaran == 'Kredit' ? 'selected' : '' ?>>Kredit</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label>Tanggal Jual</label>
                          <input type="date" name="tanggal_jual" class="form-control" value="<?= $data->tanggal_jual ?>">
                        </div>

                        <div class="mb-3">
                          <label>Tambahan Harga (Otomatis)</label>
                          <input type="text" id="tambahan_harga" class="form-control" readonly
                            value="Rp <?= number_format($data->tambahan_harga,0,',','.') ?>">
                        </div>
                      </div>

                      <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div> <!-- card-body -->
            </div> <!-- card-content -->
          </div> <!-- card -->
        </div> <!-- col-12 -->
      </div> <!-- row -->
    </section>
  </div>
</div>

<script>
let filesArray = [];
let deletedFiles = [];

const input = document.getElementById('dokumen_pembeli');
const newPreview = document.getElementById('new_preview');
const hiddenInput = document.getElementById('dokumen_pembeli_data');
const deletedInput = document.getElementById('deleted_files');

input.addEventListener('change', function(event){
    Array.from(event.target.files).forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            filesArray.push({
                name: file.name,
                dataUrl: e.target.result
            });
            renderNewPreview();
        };
        reader.readAsDataURL(file);
    });
    input.value = "";
});

function renderNewPreview() {
    newPreview.innerHTML = '';
    filesArray.forEach((file, index) => {
        let container = document.createElement('div');
        container.style.position = 'relative';
        container.style.margin = '5px';
        
        let img = document.createElement('img');
        img.src = file.dataUrl;
        img.style.width = '80px';
        img.style.height = '80px';
        img.style.objectFit = 'cover';
        img.style.border = '1px solid #ddd';
        img.style.borderRadius = '8px';
        
        let closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';
        closeBtn.style.position = 'absolute';
        closeBtn.style.top = '0';
        closeBtn.style.right = '0';
        closeBtn.style.background = 'rgba(255,0,0,0.7)';
        closeBtn.style.border = 'none';
        closeBtn.style.color = 'white';
        closeBtn.style.borderRadius = '50%';
        closeBtn.style.width = '18px';
        closeBtn.style.height = '18px';
        closeBtn.style.cursor = 'pointer';
        closeBtn.onclick = () => {
            filesArray.splice(index, 1);
            renderNewPreview();
        };
        
        container.appendChild(img);
        container.appendChild(closeBtn);
        newPreview.appendChild(container);
    });
    hiddenInput.value = JSON.stringify(filesArray);
}

// handle hapus existing
document.querySelectorAll('.btn-remove-existing').forEach(btn => {
    btn.addEventListener('click', function() {
        let file = this.getAttribute('data-file');
        deletedFiles.push(file);
        this.parentElement.remove();
        deletedInput.value = JSON.stringify(deletedFiles);
    });
});
</script>

<script>
    document.querySelectorAll(".format-rupiah").forEach(function(input) {
        input.addEventListener("input", function () {
            let value = this.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            this.value = 'Rp ' + rupiah;

            hitung();
        });
    });

    // hitung tambahan harga
    function hitung() {
        let jual = parseInt(document.getElementById('harga_jual').value.replace(/[^0-9]/g, '')) || 0;
        let tukar = parseInt(document.getElementById('harga_tukar').value.replace(/[^0-9]/g, '')) || 0;
        let tambahan = jual - tukar;
        document.getElementById('tambahan_harga').value = 'Rp ' + tambahan.toLocaleString('id-ID');
    }

    // pertama kali jalankan hitung untuk prefill
    hitung();
</script>
