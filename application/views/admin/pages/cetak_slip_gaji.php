<!DOCTYPE html>
<html>

<head>
    <title>Slip Gaji - <?= $karyawan->nm_karyawan ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #333;
            padding: 30px;
            background: white;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }

        .header h3 {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 16px;
            font-weight: normal;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            padding: 12px 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-section .table {
            margin: 10px 0;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total {
            font-weight: bold;
            background-color: #e9ecef !important;
        }

        .section-title {
            background-color: #343a40;
            color: white;
            padding: 10px;
            margin: 20px 0 10px 0;
            font-weight: bold;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .signature {
            float: right;
            text-align: center;
            width: 200px;
        }

        .company-info {
            float: left;
            width: 300px;
        }

        .clear {
            clear: both;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }

            .container {
                border: none;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>SLIP GAJI KARYAWAN</h2>
            <h3>Periode: <?= date('d F Y', strtotime($start_date)) ?> - <?= date('d F Y', strtotime($end_date)) ?></h3>
        </div>

        <!-- Informasi Karyawan -->
        <div class="info-section">
            <table class="table">
                <tr>
                    <th width="25%">Nama Karyawan</th>
                    <td width="25%"><?= $karyawan->nm_karyawan ?></td>
                    <th width="25%">Jabatan</th>
                    <td width="25%"><?= $karyawan->nama_jabatan ?></td>
                </tr>
                <tr>
                    <th>Periode</th>
                    <td><?= date('d/m/Y', strtotime($start_date)) ?> - <?= date('d/m/Y', strtotime($end_date)) ?></td>
                    <th>Gaji per Hari</th>
                    <td>Rp <?= number_format($karyawan->gaji_per_hari, 0, ',', '.') ?></td>
                </tr>
            </table>
        </div>

        <!-- Ringkasan Kehadiran -->
        <div class="section-title">RINGKASAN KEHADIRAN</div>
        <table class="table">
            <tr>
                <th width="25%">Total Hari Kerja</th>
                <td width="25%"><?= $rekap['total_hari_kerja'] ?> hari</td>
                <th width="25%">Hari Penuh (≥10 jam)</th>
                <td width="25%"><span class="badge badge-success"><?= $rekap['total_hari_penuh'] ?> hari</span></td>
            </tr>
            <tr>
                <th>Hari ≤5 jam</th>
                <td><span class="badge badge-danger"><?= $rekap['total_hari_kurang_50'] ?> hari</span></td>
                <th>Hari 6-9 jam</th>
                <td><span class="badge badge-warning"><?= $rekap['total_hari_kurang_proporsional'] ?> hari</span></td>
            </tr>
            <tr>
                <th>Total Jam Lembur</th>
                <td colspan="3"><?= $rekap['total_jam_lembur'] ?> jam</td>
            </tr>
        </table>

        <!-- Rincian Gaji -->
        <div class="section-title">RINCIAN GAJI</div>
        <table class="table">
            <tr>
                <th width="70%">Komponen</th>
                <th width="30%" class="text-right">Jumlah</th>
            </tr>
            <tr>
                <td>Gaji Hari Penuh (<?= $rekap['total_hari_penuh'] ?> hari × Rp
                    <?= number_format($karyawan->gaji_per_hari, 0, ',', '.') ?>)
                </td>
                <td class="text-right">Rp <?= number_format($rekap['gaji_hari_penuh'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Gaji Hari ≤5 jam (<?= $rekap['total_jam_kurang_50'] ?> jam × Rp
                    <?= number_format($karyawan->gaji_per_hari / 10, 0, ',', '.') ?>/jam)
                </td>
                <td class="text-right">Rp <?= number_format($rekap['gaji_jam_kurang_50'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Gaji Hari 6-9 jam (<?= $rekap['total_jam_kurang_proporsional'] ?> jam × Rp
                    <?= number_format($karyawan->gaji_per_hari / 10, 0, ',', '.') ?>/jam)
                </td>
                <td class="text-right">Rp <?= number_format($rekap['gaji_jam_kurang_proporsional'], 0, ',', '.') ?></td>
            </tr>
            <tr class="total">
                <td>Total Gaji Pokok</td>
                <td class="text-right">Rp <?= number_format($rekap['gaji_pokok'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Uang Lembur (<?= $rekap['total_jam_lembur'] ?> jam × Rp 5.000)</td>
                <td class="text-right">Rp <?= number_format($rekap['uang_lembur'], 0, ',', '.') ?></td>
            </tr>
            <tr class="total" style="background-color: #d4edda;">
                <td><strong>TOTAL GAJI DITERIMA</strong></td>
                <td class="text-right"><strong>Rp <?= number_format($rekap['total_gaji'], 0, ',', '.') ?></strong></td>
            </tr>
        </table>

        <!-- Detail Absensi -->
        <div class="section-title">DETAIL ABSENSI</div>
        <table class="table">
            <thead>
                <tr>
                    <th width="20%">Tanggal</th>
                    <th width="15%">Jam Masuk</th>
                    <th width="15%">Jam Keluar</th>
                    <th width="15%">Total Jam</th>
                    <th width="15%">Jam Lembur</th>
                    <th width="20%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($detail_absensi)): ?>
                    <?php foreach ($detail_absensi as $absensi): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($absensi->tgl_absensi)) ?></td>
                            <td><?= $absensi->jam_masuk ?></td>
                            <td><?= $absensi->jam_keluar ?></td>
                            <td><?= round($absensi->total_jam_kerja, 2) ?> jam</td>
                            <td><?= round($absensi->jam_lembur, 2) ?> jam</td>
                            <td>
                                <?php if ($absensi->status_jam_kerja == 'penuh'): ?>
                                    <span class="badge badge-success">Penuh</span>
                                <?php elseif ($absensi->status_jam_kerja == 'kurang_50'): ?>
                                    <span class="badge badge-danger">≤5 jam</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">6-9 jam</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data absensi</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Footer dan Tanda Tangan -->
        <div class="footer">
            <div class="company-info">
                <strong>Ketentuan Penggajian:</strong><br>
                - Jam kerja ≥ 10 jam: Gaji harian 100%<br>
                - Jam kerja ≤ 5 jam: Gaji harian 50%<br>
                - Jam kerja 6-9 jam: Gaji proporsional per jam<br>
                - Jam kerja > 10 jam: Lembur Rp 5.000/jam
            </div>

            <div class="signature">
                <p>Disetujui oleh,</p>
                <br><br><br>
                <p>_________________________</p>
                <p><strong>Manager</strong></p>
            </div>

            <div class="clear"></div>
        </div>

        <!-- Tombol Print -->
        <div class="no-print" style="text-align: center; margin-top: 20px;">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Slip
            </button>
            <button onclick="window.close()" class="btn btn-secondary">
                <i class="fas fa-times"></i> Tutup
            </button>
        </div>
    </div>
</body>

</html>