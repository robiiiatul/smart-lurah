<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
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
                    <?php if (session()->get('jabatan') == 'Admin') : ?>
                        <a href="<?= base_url(route_to('admin.formUser')) ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add User</a>
                        <hr>
                    <?php endif; ?>
                    
                    <div mb-2>
                        <!-- Display flash data (message when data is successfully saved) -->
                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="table-responsive">
                        <table id="tablePengguna" class="table table-bordered table-striped">
                            <thead>
                                <tr class="table-success">
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Nomer HP</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>RW</th>
                                    <th>RT</th>
                                    <th>NIK</th>
                                    <th>Penetapan SK</th>
                                    <th>Tanggal SK</th>
                                    <th>Jumlah Insentif</th>
                                    <th>Nomer Rekening</th>    
                                    <th>Foto</th>    
                                    <?php if (session()->get('jabatan') == 'Admin') : ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_user as $row) : ?>
                                    <tr>
                                        <td><?= esc($row['name']) ?></td>
                                        <td><?= esc($row['username']) ?></td>
                                        <td><?= esc($row['no_hp']) ?></td>
                                        <td><?= esc($row['email']) ?></td>
                                        <td><?= esc($row['jabatan']) ?></td>
                                        <td><?= esc($row['rw']) ?></td>
                                        <td><?= esc($row['rt']) ?></td>
                                        <td><?= esc($row['nik']) ?></td>
                                        <td><?= esc($row['penetapan_sk']) ?></td>
                                        <td><?= esc($row['tgl_sk']) ?></td>
                                        <td><?= esc($row['jmlh_insentif']) ?></td>
                                        <td><?= esc($row['no_rek']) ?></td>
                                        <td><img src="<?= base_url('uploads/' . $row['picture']) ?>" alt="Foto" width="100"></td>
                                        <?php if (session()->get('jabatan') == 'Admin') :?> 
                                        <td>
                                            <!-- <a href="<?= base_url(route_to('admin.openUser', $row['id_user'])) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a> -->
                                            <a href="<?= base_url(route_to('admin.formEditUser', $row['id_user'])) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0);" data-id="<?= $row['id_user'] ?>" class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
