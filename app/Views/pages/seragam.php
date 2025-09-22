<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= esc($title) ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <?php if (in_array(session()->get('role'), ['Karyawan', 'Supervisor'])): ?>
                        <a class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambah">Ajukan Seragam Kerja</a>
                    <?php endif; ?>
                    <div mb-2>
                        <!-- Menampilkan flash data (pesan saat data berhasil disimpan) -->
                        <?php if (session()->getFlashdata('message')): ?>
                            <?= session()->getFlashdata('message') ?>
                        <?php endif; ?>
                    </div>
                    <table id="tableData" class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-success">
                                <th>Karyawan</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_master as $row): ?>
                                <tr>
                                    <td><?= esc($row['user_name']) ?></td>
                                    <td><?= esc($row['keterangan']) ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'Karyawan'): ?>
                                            <span class="badge badge-warning">Pengajuan</span>
                                        <?php elseif ($row['status'] == 'Supervisor'): ?>
                                            <span class="badge badge-warning">Approved by Supervisor</span>
                                        <?php elseif ($row['status'] == 'HRD'): ?>
                                            <span class="badge badge-success">Approved by HRD</span>
                                        <?php elseif ($row['status'] == 'RejectSpv'): ?>
                                            <span class="badge badge-danger">Rejected by Supervisor</span>
                                        <?php elseif ($row['status'] == 'RejectHRD'): ?>
                                            <span class="badge badge-danger">Rejected by HRD</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (session()->get('role') == 'Karyawan' && $row['status'] == 'Karyawan'): ?>
                                            <a href="javascript:void(0);" data-id="<?= esc($row['id_seragam']) ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i> </a>
                                        <?php elseif (session()->get('role') == 'Supervisor' && $row['status'] == 'Karyawan'): ?>
                                            <a href="javascript:void(0);" data-id="<?= esc($row['id_seragam']) ?>" class="btn btn-success btn-sm approve"><i class="fa fa-check"></i> </a>
                                            <a href="javascript:void(0);" data-id="<?= esc($row['id_seragam']) ?>" class="btn btn-danger btn-sm reject"><i class="fa fa-times"></i> </a>
                                        <?php elseif (session()->get('role') == 'Admin' && $row['status'] == 'Supervisor'): ?>
                                            <a href="javascript:void(0);" data-id="<?= esc($row['id_seragam']) ?>" class="btn btn-success btn-sm approve"><i class="fa fa-check"></i> </a>
                                            <a href="javascript:void(0);" data-id="<?= esc($row['id_seragam']) ?>" class="btn btn-danger btn-sm reject"><i class="fa fa-times"></i> </a>
                                        <?php else: ?> - <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal tambah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tambah" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="LabelModal">Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart(strtolower(session()->get('role')) . '/addSeragam') ?>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                        <?php if (isset($validation)): ?>
                            <small class="text-danger"><?= $validation->getError('keterangan') ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal dialog approve-->
<div class="modal fade" id="modalApprove" tabindex="-1" aria-labelledby="modalApproveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalApproveLabel">Alert!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to approve this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnyes">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal dialog reject-->
<div class="modal fade" id="modalReject" tabindex="-1" aria-labelledby="modalRejectLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRejectLabel">Alert!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to reject this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnno">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal dialog hapus data-->
<div class="modal fade" id="myModalDelete" tabindex="-1" aria-labelledby="myModalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalDeleteLabel">Alert!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btdelete">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize DataTable
    $('#tableData').DataTable();

    // Delete item
    $('#tableData').on('click', '.item-delete', function() {
        var id = $(this).data('id');
        $('#myModalDelete').modal('show');
        $('#btdelete').unbind().click(function() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('karyawan/deleteSeragam') ?>',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    $('#myModalDelete').modal('hide');
                    location.reload();
                }
            });
        });
    });

    // Approve item
    $('#tableData').on('click', '.approve', function() {
        var id_seragam = $(this).data('id');
        $('#modalApprove').modal('show');
        $('#btnyes').unbind().click(function() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url(strtolower(session()->get('role')) . '/approveSeragam') ?>',
                data: { id: id_seragam },
                dataType: 'json',
                success: function(response) {
                    $('#modalApprove').modal('hide');
                    location.reload();
                }
            });
        });
    });

    // Reject item
    $('#tableData').on('click', '.reject', function() {
        var id_seragam = $(this).data('id');
        $('#modalReject').modal('show');
        $('#btnno').unbind().click(function() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url(strtolower(session()->get('role')) . '/rejectSeragam') ?>',
                data: { id: id_seragam },
                dataType: 'json',
                success: function(response) {
                    $('#modalReject').modal('hide');
                    location.reload();
                }
            });
        });
    });
</script>
