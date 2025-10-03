<?php
// Akses data melalui array $data
$karyawan = isset($data['karyawan']) ? $data['karyawan'] : null;
$detail_absensi = isset($data['detail_absensi']) ? $data['detail_absensi'] : [];
$start_date = isset($data['start_date']) ? $data['start_date'] : date('Y-m-01');
$end_date = isset($data['end_date']) ? $data['end_date'] : date('Y-m-t');
$rekap = isset($data['rekap']) ? $data['rekap'] : [];
?>

<?php if ($karyawan): ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Gaji - <?= $karyawan->nm_karyawan ?></h5>
                    <a href="<?= site_url('penggajian?start_date=' . $start_date . '&end_date=' . $end_date) ?>"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <!-- Info Karyawan -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Nama Karyawan</th>
                                    <td><?= $karyawan->nm_karyawan ?></td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td><?= $karyawan->nama_jabatan ?></td>
                                </tr>
                                <tr>
                                    <th>Gaji per Hari</th>
                                    <td>Rp <?= number_format($karyawan->gaji_per_hari, 0, ',', '.') ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Periode</th>
                                    <td><?= $start_date ?> s/d <?= $end_date ?></td>
                                </tr>
                                <tr>
                                    <th>Total Hari Kerja</th>
                                    <td><?= $rekap['total_hari_kerja'] ?> hari</td>
                                </tr>
                                <tr>
                                    <th>Hari Penuh (≥10 jam)</th>
                                    <td><span class="badge badge-success"><?= $rekap['total_hari_penuh'] ?> hari</span></td>
                                </tr>
                                <tr>
                                    <th>Hari Kurang (<10 jam)</th>
                                    <td><span class="badge badge-warning"><?= $rekap['total_hari_kurang'] ?> hari</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Jam Lembur</th>
                                    <td><?= $rekap['total_jam_lembur'] ?> jam</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Rincian Gaji -->
                    <div class="row mb-4">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Rincian Gaji</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <td>Gaji Hari Penuh (<?= $rekap['total_hari_penuh'] ?> hari × Rp
                                                <?= number_format($karyawan->gaji_per_hari, 0, ',', '.') ?>)
                                            </td>
                                            <td class="text-right">Rp
                                                <?= number_format($rekap['gaji_hari_penuh'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gaji Hari Kurang (<?= $rekap['total_hari_kurang'] ?> hari × 50% × Rp
                                                <?= number_format($karyawan->gaji_per_hari, 0, ',', '.') ?>)
                                            </td>
                                            <td class="text-right">Rp
                                                <?= number_format($rekap['gaji_hari_kurang'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Gaji Pokok</strong></td>
                                            <td class="text-right"><strong>Rp
                                                    <?= number_format($rekap['gaji_pokok'], 0, ',', '.') ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Uang Lembur (<?= $rekap['total_jam_lembur'] ?> jam × Rp 5.000)</td>
                                            <td class="text-right">Rp
                                                <?= number_format($rekap['uang_lembur'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr class="table-success">
                                            <td><strong>Total Gaji</strong></td>
                                            <td class="text-right"><strong>Rp
                                                    <?= number_format($rekap['total_gaji'], 0, ',', '.') ?></strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Absensi -->
                    <h6>Detail Absensi</h6>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Total Jam Kerja</th>
                                    <th>Jam Lembur</th>
                                    <th>Status Jam Kerja</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($detail_absensi)): ?>
                                    <?php foreach ($detail_absensi as $absensi): ?>
                                        <tr>
                                            <td><?= $absensi->tgl_absensi ?></td>
                                            <td><?= $absensi->jam_masuk ?></td>
                                            <td><?= $absensi->jam_keluar ?></td>
                                            <td><?= round($absensi->total_jam_kerja, 2) ?> jam</td>
                                            <td><?= round($absensi->jam_lembur, 2) ?> jam</td>
                                            <td>
                                                <?php if ($absensi->status_jam_kerja == 'penuh'): ?>
                                                    <span class="badge badge-success">Penuh</span>
                                                <?php else: ?>
                                                    <span class="badge badge-warning">Kurang</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-success"><?= ucfirst($absensi->status) ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data absensi</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-3">
                        <a href="<?= site_url('penggajian/cetak_slip/' . $karyawan->id . '?start_date=' . $start_date . '&end_date=' . $end_date) ?>"
                            class="btn btn-success" target="_blank">
                            <i class="fas fa-print"></i> Cetak Slip Gaji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger">
        Data karyawan tidak ditemukan.
    </div>
<?php endif; ?>