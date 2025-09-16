<div class="row">
    <div class="col-12">
        <div class="my-3">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalFormData"
                id="openModalData">Tambah</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Umur</th>
                        <th scope="col">Tinggi Badan</th>
                        <th scope="col">Keluarga dengan Kelebihan Berat</th>
                        <th scope="col">Konsumsi Makanan Cepat Saji</th>
                        <th scope="col">Frekuensi Konsumsi Sayuran</th>
                        <th scope="col">Jumlah Makan Utama Harian</th>
                        <th scope="col">Asupan Makanan di Antara Waktu Makan</th>
                        <th scope="col">Merokok</th>
                        <th scope="col">Asupan Cairan Harian</th>
                        <th scope="col">Perhitungan Asupan Kalori</th>
                        <th scope="col">Olahraga Fisik</th>
                        <th scope="col">Waktu yang Didedikasikan untuk Teknologi</th>
                        <th scope="col">Jenis Transportasi yang Digunakan</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $no = $this->uri->segment(3) + 1;
                    foreach ($data as $index => $item) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1 + $this->uri->segment(3); ?></th>
                            <td><?= describe_symptom('Sex', $item['Sex']); ?></td>
                            <td><?= describe_symptom('Age', $item['Age']); ?></td>
                            <td><?= describe_symptom('Height', $item['Height']); ?></td>
                            <td><?= describe_symptom('Overweight_Obese_Family', $item['Overweight_Obese_Family']); ?></td>
                            <td><?= describe_symptom('Consumption_of_Fast_Food', $item['Consumption_of_Fast_Food']); ?></td>
                            <td><?= describe_symptom('Frequency_of_Consuming_Vegetables', $item['Frequency_of_Consuming_Vegetables']); ?>
                            </td>
                            <td><?= describe_symptom('Number_of_Main_Meals_Daily', $item['Number_of_Main_Meals_Daily']); ?>
                            </td>
                            <td><?= describe_symptom('Food_Intake_Between_Meals', $item['Food_Intake_Between_Meals']); ?>
                            </td>
                            <td><?= describe_symptom('Smoking', $item['Smoking']); ?></td>
                            <td><?= describe_symptom('Liquid_Intake_Daily', $item['Liquid_Intake_Daily']); ?></td>
                            <td><?= describe_symptom('Calculation_of_Calorie_Intake', $item['Calculation_of_Calorie_Intake']); ?>
                            </td>
                            <td><?= describe_symptom('Physical_Excercise', $item['Physical_Exercise']); ?></td>
                            <td><?= describe_symptom('Schedule_Dedicated_to_Technology', $item['Schedule_Dedicated_to_Technology']); ?>
                            </td>
                            <td><?= describe_symptom('Type_of_Transportation_Used', $item['Type_of_Transportation_Used']); ?>
                            </td>
                            <td><?= describe_symptom('Class', $item['Class']); ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info mb-1" id="btn-edit"data-id="<?= $index + $this->uri->segment(3); ?>"
                                    data-sex="<?= $item['Sex'] ?>" data-age="<?= $item['Age'] ?>"
                                    data-height="<?= $item['Height'] ?>"
                                    data-overweight_obese_family="<?= $item['Overweight_Obese_Family'] ?>"
                                    data-consumption_of_fast_food="<?= $item['Consumption_of_Fast_Food'] ?>"
                                    data-frequency_of_consuming_vegetables="<?= $item['Frequency_of_Consuming_Vegetables'] ?>"
                                    data-number_of_main_meals_daily="<?= $item['Number_of_Main_Meals_Daily'] ?>"
                                    data-food_intake_between_meals="<?= $item['Food_Intake_Between_Meals'] ?>"
                                    data-smoking="<?= $item['Smoking'] ?>"
                                    data-liquid_intake_daily="<?= $item['Liquid_Intake_Daily'] ?>"
                                    data-calculation_of_calorie_intake="<?= $item['Calculation_of_Calorie_Intake'] ?>"
                                    data-physical_exercise="<?= $item['Physical_Exercise'] ?>"
                                    data-schedule_dedicated_to_technology="<?= $item['Schedule_Dedicated_to_Technology'] ?>"
                                    data-type_of_transportation_used="<?= $item['Type_of_Transportation_Used'] ?>"
                                    data-class="<?= $item['Class'] ?>">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" id="btn-hapus" data-id="<?= $index + $this->uri->segment(3);; ?>">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <?= $pagination; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalFormData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Form Tambah Dataset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDataset">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                        <select class="form-control" name="sex" id="sex" required>
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                        <div class="invalid-feedback" id="error-sex"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Usia</label>
                        <input type="number" class="form-control" name="age" id="age" placeholder="Masukkan Usia" />
                        <div class="invalid-feedback" id="error-age"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tinggi Badan</label>
                        <input type="number" class="form-control" name="height" id="height"
                            placeholder="Masukkan Tinggi (cm)" />
                        <div class="invalid-feedback" id="error-height"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Keluarga Kegemukan/Obesitas</label>
                        <select class="form-control" name="overweight_obese_family" id="overweight_obese_family">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback" id="error-overweight_obese_family"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Konsumsi Makanan Cepat Saji</label>
                        <select class="form-control" name="consumption_of_fast_food" id="consumption_of_fast_food">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback" id="error-consumption_of_fast_food"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Frekuensi Konsumsi Sayur</label>
                        <select class="form-control" name="frequency_of_consuming_vegetables"
                            id="frequency_of_consuming_vegetables">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Jarang</option>
                            <option value="2">Kadang-kadang</option>
                            <option value="3">Selalu</option>
                        </select>
                        <div class="invalid-feedback" id="error-frequency_of_consuming_vegetables"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jumlah Makan Utama per Hari</label>
                        <select class="form-control" name="number_of_main_meals_daily" id="number_of_main_meals_daily">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">1-2 Kali</option>
                            <option value="2">3 Kali</option>
                            <option value="3">Lebih dari 3 Kali</option>
                        </select>
                        <div class="invalid-feedback" id="error-number_of_main_meals_daily"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Camilan di Antara Waktu Makan</label>
                        <select class="form-control" name="food_intake_between_meals" id="food_intake_between_meals">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Jarang</option>
                            <option value="2">Kadang-kadang</option>
                            <option value="3">Sering</option>
                            <option value="4">Selalu</option>
                        </select>
                        <div class="invalid-feedback" id="error-food_intake_between_meals"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Merokok</label>
                        <select class="form-control" name="smoking" id="smoking">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback" id="error-smoking"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Asupan Cairan Harian</label>
                        <select class="form-control" name="liquid_intake_daily" id="liquid_intake_daily">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Kurang dari 1 liter</option>
                            <option value="2">Antara 1 - 2 liter</option>
                            <option value="3">Lebih dari 2 liter</option>
                        </select>
                        <div class="invalid-feedback" id="error-liquid_intake_daily"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Perhitungan Asupan Kalori</label>
                        <select class="form-control" name="calculation_of_calorie_intake"
                            id="calculation_of_calorie_intake">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                        </select>
                        <div class="invalid-feedback" id="error-calculation_of_calorie_intake"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Olahraga Fisik</label>
                        <select class="form-control" name="physical_exercise" id="physical_exercise">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Tidak Pernah</option>
                            <option value="2">1-2 Hari/Minggu</option>
                            <option value="3">3-4 Hari/Minggu</option>
                            <option value="4">5-6 Hari/Minggu</option>
                            <option value="5">Lebih dari 6 Hari</option>
                        </select>
                        <div class="invalid-feedback" id="error-physical_exercise"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Waktu untuk Teknologi (Gadget/Komputer)</label>
                        <select class="form-control" name="schedule_dedicated_to_technology"
                            id="schedule_dedicated_to_technology">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">0 - 2 Jam</option>
                            <option value="2">3 - 5 Jam</option>
                            <option value="3">Lebih dari 5 Jam</option>
                        </select>
                        <div class="invalid-feedback" id="error-schedule_dedicated_to_technology"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jenis Transportasi yang Digunakan</label>
                        <select class="form-control" name="type_of_transportation_used"
                            id="type_of_transportation_used">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Mobil</option>
                            <option value="2">Motor</option>
                            <option value="3">Sepeda</option>
                            <option value="4">Transportasi Umum</option>
                            <option value="5">Jalan Kaki</option>
                        </select>
                        <div class="invalid-feedback" id="error-type_of_transportation_used"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kelas Berat Badan</label>
                        <select class="form-control" name="class" id="class">
                            <option value="">-- Pilih Salah Satu --</option>
                            <option value="1">Kurus</option>
                            <option value="2">Normal</option>
                            <option value="3">Kelebihan Berat Badan</option>
                            <option value="4">Obesitas</option>
                        </select>
                        <div class="invalid-feedback" id="error-class"></div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= site_url('admin/manage_dataset/upload_csv') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="csv_file" accept=".csv"
                                required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <!-- <label>Pilih file CSV</label>
                        <input type="file" name="csv_file" class="form-control" accept=".csv" required> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- SweetAlert Notification -->
<?php if ($this->session->flashdata('msg')): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: '<?= $this->session->flashdata("msg_type") ?>',
            title: '<?= $this->session->flashdata("msg") ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
<?php endif; ?>