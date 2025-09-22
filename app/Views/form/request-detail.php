<div class="content-wrapper">
    <div class="container-fluid">
        <h3><?= esc($title) ?></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Request</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Add Detail Request</li>
            </ol>
        </nav>

        <?= form_open_multipart(strtolower(session()->get('role')) . '/addRequestDetail/' . esc($id_request)) ?>

        <!-- group 1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4>Request Employee</h4><hr> -->

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="date" value="<?= esc(date('Y-m-d')) ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">cv</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cv">
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
