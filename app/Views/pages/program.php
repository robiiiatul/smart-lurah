<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Program</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (session()->get('jabatan') != 'Admin') : ?>
                <div class="mb-3">
                    <a href="<?= site_url(strtolower(session()->get('jabatan')) . '/formProgram') ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Add Program
                    </a>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php foreach ($data as $row) : ?>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= base_url('uploads/' . $row['picture']) ?>" class="card-img-top" style="height:200px; object-fit:cover;" alt="Foto">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($row['judul']) ?></h5>
                            <p class="card-subtitle text-muted mb-2"><?= date('d M Y', strtotime($row['tanggal'])) ?></p>
                            <p class="card-text"><?= esc($row['keterangan']) ?></p>
                            <?php if (session()->get('id_user') == $row['id_user']): ?>
                                <a href="<?= base_url(route_to('admin.formEditUser', $row['id_user'])) ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" data-id="<?= $row['id_user'] ?>" class="btn btn-sm btn-danger item-delete"><i class="fa fa-trash"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
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
                Are you sure you want to delete this data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btdelete">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize DataTable plugin
    $('#tablePengguna').DataTable({
        "scrollX": true
    });

    // Show delete confirmation modal
    $('#tablePengguna').on('click', '.item-delete', function() {
        var id = $(this).data('id');
 
        $('#myModalDelete').modal('show');
        
        // On confirming delete, perform AJAX request
        $('#btdelete').unbind().click(function() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url(route_to("admin.deleteUser")) ?>',
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
