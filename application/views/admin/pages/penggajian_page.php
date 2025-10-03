<?php
// Akses data melalui array $data
$start_date = isset($data['start_date']) ? $data['start_date'] : date('Y-m-01');
$end_date = isset($data['end_date']) ? $data['end_date'] : date('Y-m-t');
$id_karyawan = isset($data['id_karyawan']) ? $data['id_karyawan'] : '';
$search = isset($data['search']) ? $data['search'] : '';
$karyawan_list = isset($data['karyawan_list']) ? $data['karyawan_list'] : [];
$data_rekap = isset($data['data_rekap']) ? $data['data_rekap'] : [];
$total_keseluruhan = isset($data['total_keseluruhan']) ? $data['total_keseluruhan'] : [];
$pagination = isset($data['pagination']) ? $data['pagination'] : '';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Filter Rekap Penggajian</div>
            <div class="card-body">
                <form method="GET" action="<?= site_url('admin/penggajian') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_date">Tanggal Awal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                    value="<?= $start_date ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_date">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="<?= $end_date ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="karyawan">Karyawan (Opsional)</label>
                                <select class="form-control" id="karyawan" name="karyawan">
                                    <option value="">Semua Karyawan</option>
                                    <?php if(!empty($karyawan_list)): ?>
                                        <?php foreach ($karyawan_list as $karyawan) { ?>
                                            <option value="<?= $karyawan->id ?>" 
                                                <?= ($id_karyawan == $karyawan->id) ? 'selected' : '' ?>>
                                                <?= $karyawan->nm_karyawan ?>
                                            </option>
                                        <?php } ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search">Cari Nama Karyawan</label>
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="Cari nama karyawan..." value="<?= $search ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <small>
                                    <i class="fas fa-info-circle"></i> 
                                    <strong>Ketentuan Penggajian Baru:</strong><br>
                                    - Jam kerja ≥ 10 jam: Gaji harian 100%<br>
                                    - Jam kerja ≤ 5 jam: Gaji harian 50%<br>
                                    - Jam kerja > 5 jam dan < 10 jam: Gaji proporsional (gaji/10 × total jam)<br>
                                    - Jam kerja > 10 jam: Lembur Rp 5.000/jam
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-calculator"></i> Hitung Rekap Gaji
                            </button>
                            <?php if(!empty($data_rekap)): ?>
                                <a href="<?= site_url('admin/penggajian/cetak_rekap_all?start_date=' . $start_date . '&end_date=' . $end_date . '&karyawan=' . $id_karyawan . '&search=' . $search) ?>" 
                                   class="btn btn-success" target="_blank">
                                    <i class="fas fa-print"></i> Cetak Semua
                                </a>
                            <?php endif; ?>
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
                <h5 class="mb-0">
                    Rekap Penggajian 
                    <?= $start_date ?> s/d <?= $end_date ?>
                    <?php if(!empty($id_karyawan) && !empty($karyawan_list)): ?>
                        <?php 
                        $karyawan_terpilih = null;
                        foreach ($karyawan_list as $karyawan) {
                            if ($karyawan->id == $id_karyawan) {
                                $karyawan_terpilih = $karyawan;
                                break;
                            }
                        }
                        ?>
                        <?php if($karyawan_terpilih): ?>
                            - <?= $karyawan_terpilih->nm_karyawan ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </h5>
                <?php if(!empty($data_rekap) && !empty($total_keseluruhan)): ?>
                    <div class="badge badge-primary p-2">
                        Total: Rp <?= number_format($total_keseluruhan['total_keseluruhan'], 0, ',', '.') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if(!empty($data_rekap)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Gaji/Hari</th>
                                    <th>Total Hari</th>
                                    <th>Hari Penuh</th>
                                    <th>Hari ≤5 jam</th>
                                    <th>Jam ≤5 jam</th>
                                    <th>Hari 6-9 jam</th>
                                    <th>Jam 6-9 jam</th>
                                    <th>Jam Lembur</th>
                                    <th>Gaji Pokok</th>
                                    <th>Uang Lembur</th>
                                    <th>Total Gaji</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Hitung nomor urut dengan aman
                                $segment = $this->uri->segment(3);
                                $no = (!empty($segment) && is_numeric($segment)) ? $segment + 1 : 1;
                                foreach ($data_rekap as $rekap): 
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $rekap->nm_karyawan ?></td>
                                        <td><?= $rekap->nama_jabatan ?></td>
                                        <td>Rp <?= number_format($rekap->gaji_per_hari, 0, ',', '.') ?></td>
                                        <td><?= $rekap->total_hari_kerja ?> hari</td>
                                        <td>
                                            <span class="badge badge-success"><?= $rekap->total_hari_penuh ?> hari</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-danger"><?= $rekap->total_hari_kurang_50 ?> hari</span>
                                        </td>
                                         <td><span class="badge badge-info"><?= $rekap->total_jam_kurang_50 ?> jam</span></td>
                                        <td>
                                            <span class="badge badge-warning"><?= $rekap->total_hari_kurang_proporsional ?> hari</span>
                                        </td>
                                        <td><span class="badge badge-info"><?= $rekap->total_jam_kurang_proporsional ?> jam</span></td>
                                        <td><?= $rekap->total_jam_lembur ?> jam</td>
                                        <td>Rp <?= number_format($rekap->gaji_pokok, 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($rekap->uang_lembur, 0, ',', '.') ?></td>
                                        <td><strong>Rp <?= number_format($rekap->total_gaji, 0, ',', '.') ?></strong></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= site_url('admin/penggajian/detail_karyawan/' . $rekap->id_karyawan . '?start_date=' . $start_date . '&end_date=' . $end_date) ?>" 
                                                   class="btn btn-info" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= site_url('admin/penggajian/cetak_slip/' . $rekap->id_karyawan . '?start_date=' . $start_date . '&end_date=' . $end_date) ?>" 
                                                   class="btn btn-success" target="_blank" title="Cetak Slip">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-primary">
                                    <td colspan="9" class="text-right"><strong>Total Keseluruhan:</strong></td>
                                    <td><strong>Rp <?= number_format($total_keseluruhan['total_gaji_pokok'], 0, ',', '.') ?></strong></td>
                                    <td><strong>Rp <?= number_format($total_keseluruhan['total_uang_lembur'], 0, ',', '.') ?></strong></td>
                                    <td colspan="2"><strong>Rp <?= number_format($total_keseluruhan['total_keseluruhan'], 0, ',', '.') ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if(!empty($pagination)): ?>
                        <div class="d-flex justify-content-end mt-3">
                            <?= $pagination ?>
                        </div>
                    <?php endif; ?>
                    
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-exclamation-triangle fa-2x mb-3"></i><br>
                        <?php if(!empty($start_date) && !empty($end_date)): ?>
                            Tidak ada data absensi untuk periode <?= $start_date ?> s/d <?= $end_date ?>.
                        <?php else: ?>
                            Silakan pilih periode tanggal untuk melihat rekap gaji.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>