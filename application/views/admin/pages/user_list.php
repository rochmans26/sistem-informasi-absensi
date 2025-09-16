<div class="row">
    <div class="col-12">
        <div class="my-3">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFormUser"
                id="openModal">Tambah</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Umur</th>
                        <th scope="col">Telp</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $this->uri->segment(3) + 1;
                    foreach ($data as $item) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $item->nama; ?></td>
                            <td><?= $item->email; ?></td>
                            <td><?= $item->sex; ?></td>
                            <td><?= $item->age; ?></td>
                            <td><?= $item->telp; ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-circle" id="btn-edit" data-id="<?= $item->id_user; ?>"
                                    data-nama="<?= $item->nama; ?>" data-email="<?= $item->email; ?>"
                                    data-sex="<?= $item->sex; ?>" data-age="<?= $item->age; ?>"
                                    data-telp="<?= $item->telp; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle" id="btn-hapus"
                                    data-id="<?= $item->id_user ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <?= $pagination; ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="modalFormUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUser">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="nama" id="nama" required>
                        <div class="invalid-feedback" id="error-nama"></div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" id="email" required>
                        <div class="invalid-feedback" id="error-email"></div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="sex" id="sex" required>
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                        <div class="invalid-feedback" id="error-sex"></div>
                    </div>
                    <div class="form-group">
                        <label>Usia</label>
                        <input class="form-control" type="number" name="age" id="age" required>
                        <div class="invalid-feedback" id="error-age"></div>
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input class="form-control" type="text" name="telp" id="telp" required>
                        <div class="invalid-feedback" id="error-telp"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>