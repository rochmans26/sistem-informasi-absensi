<div class="row">
    <div class="col-8">
        <div class="my-3">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFormKaryawan"
                id="openModal">Tambah</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">No. Telp</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $this->uri->segment(3) + 1;
                    foreach ($data['data'] as $item) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $item->nm_karyawan; ?></td>
                            <td><?= $item->email; ?></td>
                            <td><?= $item->telp; ?></td>
                            <td>
                                <a href="#" class="btn btn-info btn-circle btn-edit" id="btn-edit"
                                    data-id="<?= $item->id; ?>" data-uuid="<?= $item->uuid; ?>"
                                    data-nm_karyawan="<?= htmlspecialchars($item->nm_karyawan, ENT_QUOTES); ?>"
                                    data-email="<?= htmlspecialchars($item->email, ENT_QUOTES); ?>"
                                    data-alamat_ktp="<?= htmlspecialchars($item->alamat_ktp, ENT_QUOTES); ?>"
                                    data-alamat_domisili="<?= htmlspecialchars($item->alamat_domisili, ENT_QUOTES); ?>"
                                    data-tempat_lahir="<?= htmlspecialchars($item->tempat_lahir, ENT_QUOTES); ?>"
                                    data-tanggal_lahir="<?= $item->tanggal_lahir; ?>"
                                    data-jenis_kelamin="<?= $item->jenis_kelamin; ?>"
                                    data-kewarganegaraan="<?= $item->kewarganegaraan; ?>" data-agama="<?= $item->agama; ?>"
                                    data-pendidikan_terakhir="<?= $item->pendidikan_terakhir; ?>"
                                    data-id_jabatan="<?= $item->id_jabatan; ?>" data-telp="<?= $item->telp; ?>">
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
    <div class="col-4">
        <div class="card text-white bg-info">
            <div class="card-header bg-info">Informasi</div>
            <div class="card-body">
                <h5 class="card-title">Dalam Pengembangan</h5>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere non dicta quia, et
                    totam deserunt deleniti dignissimos, quas impedit soluta beatae consequatur facilis dolore eaque
                    modi? Modi eius illo temporibus consequuntur, deserunt excepturi cum necessitatibus ut! Autem,
                    repellendus ab alias odit animi laboriosam porro omnis blanditiis ullam ut provident culpa.
                    Excepturi rerum pariatur incidunt vero atque necessitatibus saepe sapiente ducimus consequatur,
                    impedit laudantium voluptas porro voluptatem debitis a hic inventore autem quo, accusamus iure velit
                    temporibus veniam in. Ratione neque porro reiciendis nihil commodi rerum, repellat nemo dignissimos,
                    rem, recusandae ducimus dicta illum delectus! Repellendus dicta eius inventore eaque ut!</p>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="modalFormKaryawan" tabindex="-1" role="dialog" aria-labelledby="modalFormKaryawanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormKaryawanLabel">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formKaryawan" novalidate>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="uuid" id="uuid">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nm_karyawan" class="font-weight-bold">Nama <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nm_karyawan" name="nm_karyawan" required>
                            <div class="invalid-feedback" id="error-nm_karyawan">Nama wajib diisi</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="font-weight-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback" id="error-email">Email wajib diisi</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="alamat_ktp" class="font-weight-bold">Alamat KTP <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alamat_ktp" name="alamat_ktp" required>
                            <div class="invalid-feedback" id="error-alamat_ktp">Alamat KTP wajib diisi</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="alamat_domisili" class="font-weight-bold">Alamat Domisili <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="alamat_domisili" name="alamat_domisili"
                                required>
                            <div class="invalid-feedback" id="error-alamat_domisili">Alamat domisili wajib diisi</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tempat_lahir" class="font-weight-bold">Tempat Lahir <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                            <div class="invalid-feedback" id="error-tempat_lahir">Tempat lahir wajib diisi</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="tanggal_lahir" class="font-weight-bold">Tanggal Lahir <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            <div class="invalid-feedback" id="error-tanggal_lahir">Tanggal lahir wajib diisi</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="jenis_kelamin" class="font-weight-bold">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <div class="invalid-feedback" id="error-jenis_kelamin">Jenis kelamin wajib dipilih</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="kewarganegaraan" class="font-weight-bold">Kewarganegaraan <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
                                <option value="">Pilih Kewarganegaraan</option>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                            <div class="invalid-feedback" id="error-kewarganegaraan">Kewarganegaraan wajib dipilih</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="agama" class="font-weight-bold">Agama <span class="text-danger">*</span></label>
                            <select class="form-control" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            <div class="invalid-feedback" id="error-agama">Agama wajib dipilih</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="pendidikan_terakhir" class="font-weight-bold">Pendidikan Terakhir <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                            <div class="invalid-feedback" id="error-pendidikan_terakhir">Pendidikan terakhir wajib
                                dipilih</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_jabatan" class="font-weight-bold">Jabatan <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" id="id_jabatan" name="id_jabatan" required>
                                <option value="">Pilih Jabatan</option>
                                <?php foreach ($data['jabatan'] as $jabatan) { ?>
                                    <option value="<?= $jabatan->id ?>">
                                        <?= $jabatan->kode_jabatan ?> | <?= $jabatan->nama_jabatan ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback" id="error-id_jabatan">Jabatan wajib dipilih</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telp" class="font-weight-bold">No. Telp/WA <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telp" name="telp" required>
                            <div class="invalid-feedback" id="error-telp">No. Telp/WA wajib diisi</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
                <button type="button" class="btn btn-primary" id="btnSimpan">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>