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
                    <?php if (session()->get('role') == 'Admin') : ?>
                        <a href="<?= site_url(strtolower(session()->get('role')) . '/formRequestDetail/' . esc($id_request)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Detail</a> <hr>
                    <?php endif; ?>

                    <div mb-2>
                        <!-- Menampilkan flashh data (pesan saat data berhasil disimpan)-->
                        <?php if (session()->getFlashdata('message')) :
                            echo session()->getFlashdata('message');
                        endif; ?>
                    </div>

                    <table id="tableData" class="table table-bordered table-striped">
                        <thead>
                            <tr class="table-success">
                                <th>Date</th>
                                <th>CV</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_master as $row) : ?>
                                <tr>
                                    <td><?= esc($row['date']) ?></td>
                                    <td><?= esc($row['cv']) ?></td>
                                    <td><?= esc($row['status']) ?></td>
                                    <td>
                                        <?php if (session()->get('role') == 'Admin'): ?>
                                            <a href="javascript:void(0);" data-id="<?= $row['id_detail'] ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i></a>
                                        <?php elseif (session()->get('role') == 'Supervisor' && $row['status'] == ''): ?> 
                                            <a href="javascript:void(0);" data-id="<?= $row['id_detail'] ?>" class="btn btn-success btn-sm approve"><i class="fa fa-check"></i> </a>
                                            <a href="javascript:void(0);" data-id="<?= $row['id_detail'] ?>" class="btn btn-danger btn-sm reject"><i class="fa fa-times"></i> </a>
                                        <?php endif; ?>
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
                Are you sure to approve this data ?
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
                <h5>Are you sure to reject this data ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnno">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal dialog delete data-->
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
                Are you sure to delete this data ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btdelete">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Display data in the table using DataTables plugin
    $('#tableData').DataTable();

    // Approve request
    $('#tableData').on('click', '.approve', function() {
        var id = $(this).data('id');
        $('#modalApprove').modal('show');
        $('#btnyes').unbind().click(function() {
            $.ajax({
                type: 'get',
                url: '<?= base_url(strtolower(session()->get('role')) . "/approveRequest") ?>',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    $('#modalApprove').modal('hide');
                    location.reload();
                }
            });
        });
    });

    // Reject request
    $('#tableData').on('click', '.reject', function() {
        var id = $(this).data('id');
        // Ambil nilai dari input note
        $('#modalReject').modal('show');
        $('#btnno').unbind().click(function() {
            var note = $('input[name="note"]').val();
            $.ajax({
                type: 'get',
                url: '<?= base_url(strtolower(session()->get('role')) . "/rejectRequest") ?>',
                data: { id: id, note: note },
                dataType: 'json',
                success: function(response) {
                    $('#modalReject').modal('hide');
                    location.reload();
                }
            });
        });
    });

    // Show modal dialog when delete button is clicked
    $('#tableData').on('click', '.item-delete', function() {
        var id = $(this).data('id');
        $('#myModalDelete').modal('show');
        $('#btdelete').unbind().click(function() {
            $.ajax({
                type: 'get',
                url: '<?= base_url("admin/deleteRequestDetail") ?>',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    $('#myModalDelete').modal('hide');
                    location.reload();
                }
            });
        });
    });
</script>
