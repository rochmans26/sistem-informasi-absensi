<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Filter</div>
            <div class="card-body">
                <form id="filterForm" method="GET" action="<?= site_url('admin/data-absensi') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_date">Tanggal Awal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                    value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_date">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="karyawan">Nama Karyawan</label>
                                <select class="form-control" id="karyawan" name="karyawan">
                                    <option value="">Semua Karyawan</option>
                                    <?php foreach ($data['karyawan_list'] as $karyawan) { ?>
                                        <option value="<?= $karyawan->id ?>" 
                                            <?= (isset($_GET['karyawan']) && $_GET['karyawan'] == $karyawan->id) ? 'selected' : '' ?>>
                                            <?= $karyawan->nm_karyawan ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Status Absensi</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="hadir" <?= (isset($_GET['status']) && $_GET['status'] == 'hadir') ? 'selected' : '' ?>>Hadir</option>
                                    <option value="alpha" <?= (isset($_GET['status']) && $_GET['status'] == 'alpha') ? 'selected' : '' ?>>Alpha</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="searchInput" name="search"
                                    placeholder="Cari data absensi... (nama karyawan, tanggal, status)"
                                    value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="<?= site_url('admin/data-absensi') ?>" class="btn btn-secondary btn-block">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Data Absensi</h5>
                <?php if(isset($_GET['start_date']) || isset($_GET['end_date']) || isset($_GET['karyawan']) || isset($_GET['status']) || isset($_GET['search'])): ?>
                    <div class="alert alert-info py-1 mb-0">
                        Menampilkan hasil filter
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Jam Masuk</th>
                                <th scope="col">Jam Keluar</th>
                                <th scope="col">Foto Masuk</th>
                                <th scope="col">Foto Keluar</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data['data'])): ?>
                                <?php
                                $no = $this->uri->segment(3) + 1;
                                foreach ($data['data'] as $item) { ?>
                                    <tr>
                                        <th scope="row"><?= $no++; ?></th>
                                        <td><?= $item->tgl_absensi ?></td>
                                        <td><?= $item->nm_karyawan; ?></td>
                                        <td><?= $item->jam_masuk; ?></td>
                                        <td><?= $item->jam_keluar; ?></td>
                                        <td>
                                            <?php if(!empty($item->foto_masuk)): ?>
                                                <img src="<?= base_url('uploads/' . $item->foto_masuk); ?>" alt="Foto Masuk" width="100px" class="img-thumbnail">
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($item->foto_keluar)): ?>
                                                <img src="<?= base_url('uploads/' . $item->foto_keluar); ?>" alt="Foto Keluar" width="100px" class="img-thumbnail">
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-<?= $item->status == 'hadir' ? 'success' : 'danger' ?>">
                                                <?= ucfirst($item->status); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data absensi</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <?php if(isset($data['pagination'])): ?>
                    <div class="d-flex justify-content-end mt-3">
                        <?= $data['pagination'] ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>