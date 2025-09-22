<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item"><a href="#">Timeslip</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Timeslip</li>
            </ol>
        </nav>

        <?= form_open_multipart(session()->get('role') . '/addCuti') ?>

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
                                <label for="password" class="col-sm-3 col-form-label">Tipe Timeslip</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="type" name="type" value="<?= esc($data_timeslip['type']) ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Tanggal / Date</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="date_from" name="date_from" value="<?= esc($data_timeslip['date_from']) ?>" readonly>
                                </div>

                                <label for="password" class="col-sm-1 col-form-label">sampai</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="date_until" name="date_until" value="<?= esc($data_timeslip['date_until']) ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Jam</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="jam_mulai" name="jam_mulai" value="<?= esc($data_timeslip['jam_mulai']) ?>" readonly>
                                </div>

                                <label for="password" class="col-sm-1 col-form-label">sampai</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="jam_selesai" name="jam_selesai" value="<?= esc($data_timeslip['jam_selesai']) ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Tujuan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($data_timeslip['keterangan']) ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Bukti</label>
                                <div class="col-sm-9">
                                    <img class="img" style="width:400px;"
                                        src="<?= esc($bukti) ?>"
                                        alt="User profile picture">
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>

        <?= form_close() ?>
    </div>
</div>
