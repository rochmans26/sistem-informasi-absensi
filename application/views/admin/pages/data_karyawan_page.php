<div class="row">
    <div class="col-12">
        <div class="my-3">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFormKaryawan"
                id="openModal">Tambah</a>
        </div>
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $this->uri->segment(3) + 1;
                    foreach ($data['data'] as $item) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $item->uuid; ?></td>
                            <td><?= $item->nm_karyawan; ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-circle" id="btn-edit" data-id="<?= $item->id; ?>"
                                    data-uuid="<?= $item->uuid; ?>" data-nm_karyawan="<?= $item->nm_karyawan; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle" id="btn-hapus" data-id="<?= $item->id ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <?= $data['pagination']; ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="modalFormKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formKaryawan">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group mb-3">
                        <label class="form-label">UUID</label>
                        <input class="form-control" type="text" name="uuid" id="uuid" required>
                        <div class="invalid-feedback" id="error-uuid"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Nama</label>
                        <input class="form-control" type="text" name="nm_karyawan" id="nm_karyawan" required>
                        <div class="invalid-feedback" id="error-nm_karyawan"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" id="simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>