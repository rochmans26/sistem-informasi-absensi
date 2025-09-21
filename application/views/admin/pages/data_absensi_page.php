<div class="row">
    <div class="col-12">
        <div class="my-3">
        </div>
        <div class="table-responsive">
            <table class="table">
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
                    <?php
                    $no = $this->uri->segment(3) + 1;
                    foreach ($data['data'] as $item) { ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $item->tgl_absensi ?></td>
                            <td><?= $item->nm_karyawan; ?></td>
                            <td><?= $item->jam_masuk; ?></td>
                            <td><?= $item->jam_keluar; ?></td>
                            <td><img src="<?= base_url('uploads/' . $item->foto_masuk); ?>" alt="" width="100px"> </td>
                            <td><img src="<?= base_url('uploads/' . $item->foto_keluar); ?>" alt="" width="100px"> </td>
                            <td><?= $item->status; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- pagination -->
            <!-- <div class="d-flex justify-content-end">
               
            </div> -->
        </div>
    </div>
</div>