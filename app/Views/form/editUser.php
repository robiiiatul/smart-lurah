<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= $title ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Edit User</li>
            </ol>
        </nav>

        <?php 
            if (session()->get('jabatan') == 'Admin') echo form_open('admin/editUser/' . $data_user['id_user'], ['enctype' => 'multipart/form-data']); 
        ?>

        <!-- group 1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Edit User</h4><hr>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="name" name="name" value="<?= esc($data_user['name']) ?>">
                            </div>

                            <label for="no_hp" class="col-sm-2 col-form-label">Nomer HP</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= esc($data_user['no_hp']) ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email" value="<?= esc($data_user['email']) ?>">
                            </div>

                            <label for="role" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="role">
                                    <option value="" <?= $data_user['jabatan'] == '' ? 'selected' : '' ?>></option>
                                    <option value="Admin" <?= $data_user['jabatan'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="Lurah" <?= $data_user['jabatan'] == 'Lurah' ? 'selected' : '' ?>>Lurah</option>
                                    <option value="RT" <?= $data_user['jabatan'] == 'RT' ? 'selected' : '' ?>>RT</option>
                                    <option value="RW" <?= $data_user['jabatan'] == 'RW' ? 'selected' : '' ?>>RW</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nik" name="nik" value="<?= esc($data_user['nik']) ?>">
                            </div>

                            <label for="penetapan_sk" class="col-sm-2 col-form-label">Penetapan SK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="penetapan_sk" name="penetapan_sk" value="<?= esc($data_user['penetapan_sk']) ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_sk" class="col-sm-2 col-form-label">Tanggal SK</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tgl_sk" name="tgl_sk" value="<?= esc($data_user['tgl_sk']) ?>">
                            </div>

                            <label for="jmlh_insentif" class="col-sm-2 col-form-label">Jumlah Insentif</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="jmlh_insentif" name="jmlh_insentif" value="<?= esc($data_user['jmlh_insentif']) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_rek" class="col-sm-2 col-form-label">Nomer Rekening</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="no_rek" name="no_rek" value="<?= esc($data_user['no_rek']) ?>">
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>

        </form>


    </div>
</div>
