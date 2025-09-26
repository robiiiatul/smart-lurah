<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>Program</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Add Program</li>
            </ol>
        </nav>

        <?= form_open_multipart(strtolower(session()->get('jabatan')) . '/addProgram'); ?>

        <!-- group 1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Program</h4><hr>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="judul" name="judul">
                            </div>

                            <label for="no_hp" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan..."><?= isset($data['keterangan']) ? esc($data['keterangan']) : '' ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="picture" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" id="picture" name="picture" accept="image/*" onchange="previewImage(event)">
                                <br>
                                <img id="preview" src="#" alt="Preview Foto" style="max-width: 150px; display: none; margin-top: 10px; border:1px solid #ccc; padding:5px; border-radius:8px;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
            </div>
        </div>

        <?= form_close(); ?>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.style.display = 'block';
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        preview.src = "#";
    }
}
</script>
