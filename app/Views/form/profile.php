<div class="content-wrapper">
    <div class="container-fluid">
        <h3>Profile</h3>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Profile User</h4>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['name']) ?>" name="name">
                            </div>

                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['username']) ?>" name="username">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['email']) ?>" name="email">
                            </div>

                            <label class="col-sm-2 col-form-label">Nomer HP</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['no_hp']) ?>" name="no_hp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['jabatan']) ?>" name="jabatan">
                            </div>

                            <label class="col-sm-2 col-form-label">RW</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" value="<?= esc($user['rw']) ?>" name="rw">
                            </div>

                            <label class="col-sm-1 col-form-label">RT</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" value="<?= esc($user['rt']) ?>" name="rt">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['nik']) ?>" name="nik">
                            </div>

                            <label class="col-sm-2 col-form-label">Penetapan SK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['penetapan_sk']) ?>" name="penetapan_sk">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal SK</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" value="<?= esc($user['tgl_sk']) ?>" name="tgl_sk">
                            </div>

                            <label class="col-sm-2 col-form-label">Jumlah Insentif</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['jmlh_insentif']) ?>" name="jmlh_insentif">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nomer Rekening</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= esc($user['no_rek']) ?>" name="no_rek">
                            </div>

                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control-file" id="picture" name="picture" accept="image/*" onchange="previewImage(event)">
                                <br>
                                <img id="preview" 
                                    src="<?= $user['picture'] ? base_url('uploads/' . $user['picture']) : '#' ?>" 
                                    alt="Preview Foto" 
                                    style="max-width: 150px; margin-top: 10px; border:1px solid #ccc; padding:5px; border-radius:8px; <?= $user['picture'] ? '' : 'display:none;' ?>">

                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12 text-right">
                                <a href="<?= base_url('/dashboard') ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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