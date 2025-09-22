<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Cuti</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Add Cuti</li>
            </ol>
        </nav>

        <?= form_open_multipart(strtolower(session()->get('role')) . '/addCuti') ?>

        <!-- group 1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <h4>Profile</h4><hr>

                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?= esc($user['name']) ?>" readonly>
                                </div>

                                <label for="username" class="col-sm-2 col-form-label">Dept</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?= esc($user['department']) ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Emp. No.</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?= esc($user['employee_number']) ?>" readonly>
                                </div>

                                <label for="join_date" class="col-sm-2 col-form-label">D O J</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?= esc($user['join_date']) ?>" readonly>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- group 2 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Bersama ini mengajukan / memberitahukan :</h4><hr>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="Cuti Tahunan">
                                    <label class="form-check-label mr-5">Cuti Tahunan</label>
                                    <input class="form-check-input" type="radio" name="type" value="Ijin Dengan Gaji (IDG)">
                                    <label class="form-check-label mr-5">Ijin Dengan Gaji (IDG)</label>
                                    <input class="form-check-input" type="radio" name="type" value="Ijin Tanpa Gaji (ITG)">
                                    <label class="form-check-label mr-5">Ijin Tanpa Gaji (ITG)</label>
                                    <input class="form-check-input" type="radio" name="type" value="Cuti Hamil / Melahirkan">
                                    <label class="form-check-label">Cuti Hamil / Melahirkan</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="Ijin Datang Terlambat (IDT)">
                                    <label class="form-check-label mr-5">Ijin Datang Terlambat (IDT)</label>
                                    <input class="form-check-input" type="radio" name="type" value="Ijin Pulang Cepat (IPC)">
                                    <label class="form-check-label mr-5">Ijin Pulang Cepat (IPC)</label>
                                    <input class="form-check-input" type="radio" name="type" value="Ijin Berobat ke Dokter (IBD)">
                                    <label class="form-check-label mr-5">Ijin Berobat ke Dokter (IBD)</label>
                                    <input class="form-check-input" type="radio" name="type" value="Dinas Luar / Training">
                                    <label class="form-check-label mr-5">Dinas Luar / Training</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_from" class="col-sm-3 col-form-label">Tanggal / Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date_from" name="date_from" required>
                            </div>

                            <label for="date_until" class="col-sm-1 col-form-label">to</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date_until" name="date_until" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Alasan / Penjelasan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Sisa Cuti</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="sisa_cuti" name="sisa_cuti" value="<?= esc($cuti) ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>
