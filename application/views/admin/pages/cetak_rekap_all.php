<!DOCTYPE html>
<html>

<head>
    <title>Rekap Penggajian Semua Karyawan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
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
        }

        .header h3 {
            margin: 5px 0 0 0;
            color: #666;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 12px;
        }

        .table th,
        .table td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
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

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 11px;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
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
            <h2>REKAP PENGGAJIAN SEMUA KARYAWAN</h2>
            <h3>Periode: <?= date('d F Y', strtotime($start_date)) ?> - <?= date('d F Y', strtotime($end_date)) ?></h3>
        </div>

        <!-- Tabel Rekap -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Gaji/Hari</th>
                    <th>Total Hari</th>
                    <th>Hari Penuh</th>
                    <th>Hari ≤5 jam</th>
                    <th>Hari 6-9 jam</th>
                    <th>Jam Lembur</th>
                    <th>Gaji Pokok</th>
                    <th>Uang Lembur</th>
                    <th>Total Gaji</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data_rekap)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($data_rekap as $rekap): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $rekap->nm_karyawan ?></td>
                            <td><?= $rekap->nama_jabatan ?></td>
                            <td class="text-right">Rp <?= number_format($rekap->gaji_per_hari, 0, ',', '.') ?></td>
                            <td class="text-center"><?= $rekap->total_hari_kerja ?></td>
                            <td class="text-center"><?= $rekap->total_hari_penuh ?></td>
                            <td class="text-center"><?= $rekap->total_hari_kurang_50 ?></td>
                            <td class="text-center"><?= $rekap->total_hari_kurang_proporsional ?></td>
                            <td class="text-center"><?= $rekap->total_jam_lembur ?></td>
                            <td class="text-right">Rp <?= number_format($rekap->gaji_pokok, 0, ',', '.') ?></td>
                            <td class="text-right">Rp <?= number_format($rekap->uang_lembur, 0, ',', '.') ?></td>
                            <td class="text-right"><strong>Rp <?= number_format($rekap->total_gaji, 0, ',', '.') ?></strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="9" class="text-right"><strong>TOTAL KESELURUHAN:</strong></td>
                    <td class="text-right"><strong>Rp
                            <?= number_format($total_keseluruhan['total_gaji_pokok'], 0, ',', '.') ?></strong></td>
                    <td class="text-right"><strong>Rp
                            <?= number_format($total_keseluruhan['total_uang_lembur'], 0, ',', '.') ?></strong></td>
                    <td class="text-right"><strong>Rp
                            <?= number_format($total_keseluruhan['total_keseluruhan'], 0, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Dicetak pada:</strong> <?= date('d F Y H:i:s') ?></p>
            <p><strong>Total Karyawan:</strong> <?= count($data_rekap) ?> orang</p>
            <p><strong>Ketentuan:</strong> ≤5 jam (50%), 6-9 jam (proporsional), ≥10 jam (100%), lembur Rp 5.000/jam</p>
        </div>

        <!-- Tombol Print -->
        <div class="no-print" style="text-align: center; margin-top: 20px;">
            <button onclick="window.print()">Cetak Laporan</button>
            <button onclick="window.close()">Tutup</button>
        </div>
    </div>
</body>

</html>