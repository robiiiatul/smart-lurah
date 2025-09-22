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
                    <?php if (session()->get('role') == 'Supervisor') : ?>
                        <a href="<?= site_url(strtolower(session()->get('role')) . '/formRequest') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Request</a> <hr>
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
                                <th>Department</th>
                                <th>Date</th>
                                <th>Total Request</th>
                                <th>Total Accepted</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_master as $row) : ?>
                                <tr>
                                    <td><?= esc($row['name']) ?></td>
                                    <td><?= esc($row['date']) ?></td>
                                    <td><?= esc($row['total']) ?></td>
                                    <td><?= esc($row['accepted']) ?></td>
                                    <td><?= esc($row['note']) ?></td>
                                    <td>
                                        <a href="<?= site_url(strtolower(session()->get('role')) . '/requestDetail/' . $row['id_request']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> </a>
                                        <?php if (session()->get('role') == 'Supervisor'): ?>
                                            <a href="javascript:void(0);" data-id="<?= $row['id_request'] ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i></a>
                                        <?php else: ?> - 
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

    // Show modal dialog when delete button is clicked
    $('#tableData').on('click', '.item-delete', function() {
        var id = $(this).data('id');
        $('#myModalDelete').modal('show');
        $('#btdelete').unbind().click(function() {
            $.ajax({
                type: 'get',
                url: '<?= base_url("supervisor/deleteRequest") ?>',
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
