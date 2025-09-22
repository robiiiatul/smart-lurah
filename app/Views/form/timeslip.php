<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a>Timeslip</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Add Timeslip</li>
            </ol>
        </nav>

        <?= form_open_multipart(strtolower(session()->get('role')) . '/addTimeslip'); ?>

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

                                <label class="col-sm-2 col-form-label">D O J</label>
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
                        <h4>Izin untuk :</h4><hr>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" value="Datang terlambat">
                                    <label class="form-check-label mr-5">Datang terlambat</label>
                                    <input class="form-check-input" type="radio" name="type" value="Meninggalkan pabrik">
                                    <label class="form-check-label mr-5">Meninggalkan pabrik</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Tanggal / Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date_from" name="date_from">
                            </div>

                            <!-- <label for="password" class="col-sm-1 col-form-label">sampai</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date_until" name="date_until">
                            </div> -->
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Jam</label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
                            </div>

                            <label for="password" class="col-sm-1 col-form-label">sampai</label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Tujuan</label>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="keterangan" value="Tugas Perusahaan">
                                    <label class="form-check-label mr-5">Tugas Perusahaan</label>
                                    <input class="form-check-input" type="radio" name="keterangan" value="Pribadi">
                                    <label class="form-check-label mr-5">Pribadi</label>
                                    <input class="form-check-input" type="radio" name="keterangan" value="Pengobatan">
                                    <label class="form-check-label mr-5">Pengobatan</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Profile Picture</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required>
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

        <?= form_close(); ?>
    </div>
</div>
