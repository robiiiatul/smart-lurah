<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Add User</li>
            </ol>
        </nav>

        <?= form_open_multipart('admin/addUser'); ?>

        <!-- group 1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Profile</h4><hr>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">UserName</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>

                            <label for="no_hp" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <label for="no_hp" class="col-sm-2 col-form-label">Nomer HP</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="no_hp" name="no_hp">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>

                            <label for="role" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="jabatan">
                                    <option value=""></option>
                                    <option value="Admin">Admin</option>
                                    <option value="Lurah">Lurah</option>
                                    <option value="RT">RT</option>
                                    <option value="RW">RW</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nik" name="nik">
                            </div>

                            <label for="penetapan_sk" class="col-sm-2 col-form-label">Penetapan SK</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="penetapan_sk" name="penetapan_sk">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_sk" class="col-sm-2 col-form-label">Tanggal SK</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tgl_sk" name="tgl_sk">
                            </div>

                            <label for="jmlh_insentif" class="col-sm-2 col-form-label">Jumlah Insentif</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="jmlh_insentif" name="jmlh_insentif">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_rek" class="col-sm-2 col-form-label">Nomer Rekening</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="no_rek" name="no_rek">
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
