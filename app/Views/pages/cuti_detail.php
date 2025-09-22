<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Cuti</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Add Cuti</li>
            </ol>
        </nav>

        <?= form_open_multipart(session()->get('role') . '/addCuti'); ?>

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
                        <h4>Bersama ini mengajukan / memberitahukan :</h4><hr>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Tipe Cuti</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="type" name="type" value="<?= esc($data_cuti['type']) ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Tanggal / Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date_from" name="date_from" value="<?= esc($data_cuti['date_from']) ?>" readonly>
                            </div>

                            <label for="password" class="col-sm-1 col-form-label">to</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date_until" name="date_until" value="<?= esc($data_cuti['date_until']) ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Alasan / Penjelasan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= esc($data_cuti['keterangan']) ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Sisa Cuti</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="sisa_cuti" name="sisa_cuti" value="<?= esc($cuti) ?>" disabled>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?= form_close(); ?>
    </div>
</div>
