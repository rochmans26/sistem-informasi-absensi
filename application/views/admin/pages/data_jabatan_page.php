<div class="row">
    <div class="col-12">
        <div class="my-3">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFormJabatan"
                id="openModal">Tambah</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode Jabatan</th>
                        <th scope="col">Nama Jabatan</th>
                        <th scope="col">Gaji Pokok</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $this->uri->segment(3) + 1;
                    foreach ($data['data'] as $item) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $item->kode_jabatan; ?></td>
                            <td><?= $item->nama_jabatan; ?></td>
                            <td><?= $item->gaji_jabatan; ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-circle" id="btn-edit" data-id="<?= $item->id; ?>"
                                    data-kode_jabatan="<?= $item->kode_jabatan; ?>"
                                    data-nama_jabatan="<?= $item->nama_jabatan; ?>"
                                    data-gaji_jabatan="<?= $item->gaji_jabatan; ?>">
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
<div class="modal fade" id="modalFormJabatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formJabatan">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input class="form-control" type="text" name="nama_jabatan" id="nama_jabatan" required>
                        <div class="invalid-feedback" id="error-nama_jabatan"></div>
                    </div>
                    <div class="form-group">
                        <label>Gaji Pokok</label>
                        <input class="form-control" type="number" name="gaji_jabatan" id="gaji_jabatan" required>
                        <div class="invalid-feedback" id="error-gaji_jabatan"></div>
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