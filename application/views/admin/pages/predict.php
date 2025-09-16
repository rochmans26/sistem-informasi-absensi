<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <!-- Approach -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Obesity Risk Prediction</h6>

                <!-- Tombol reset -->
                <a href="<?php echo site_url('admin/reset_predict'); ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-undo"></i> Reset
                </a>
            </div>

            <div class="card-body">
                <!-- Error Message -->
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger mb-4">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo site_url('admin/predict'); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="Sex">Jenis Kelamin</label>
                            <select class="form-control" id="Sex" name="Sex" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="1" <?= set_select('Sex', '1') ?>>Laki-laki</option>
                                <option value="2" <?= set_select('Sex', '2') ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Age">Umur</label>
                            <input type="number" class="form-control" id="Age" name="Age" min="14" max="100"
                                value="<?= set_value('Age') ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="Height">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" id="Height" name="Height" min="100" max="250"
                                value="<?= set_value('Height') ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Overweight_Obese_Family">Keluarga dengan Kelebihan Berat/Obesitas</label>
                            <select class="form-control" id="Overweight_Obese_Family" name="Overweight_Obese_Family"
                                required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Overweight_Obese_Family', '1') ?>>Ya</option>
                                <option value="2" <?= set_select('Overweight_Obese_Family', '2') ?>>Tidak</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Consumption_of_Fast_Food">Konsumsi Makanan Cepat Saji</label>
                            <select class="form-control" id="Consumption_of_Fast_Food" name="Consumption_of_Fast_Food"
                                required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Consumption_of_Fast_Food', '1') ?>>Ya</option>
                                <option value="2" <?= set_select('Consumption_of_Fast_Food', '2') ?>>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Frequency_of_Consuming_Vegetables">Frekuensi Konsumsi Sayuran</label>
                            <select class="form-control" id="Frequency_of_Consuming_Vegetables"
                                name="Frequency_of_Consuming_Vegetables" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Frequency_of_Consuming_Vegetables', '1') ?>>Jarang
                                </option>
                                <option value="2" <?= set_select('Frequency_of_Consuming_Vegetables', '2') ?>>
                                    Kadang-kadang
                                </option>
                                <option value="3" <?= set_select('Frequency_of_Consuming_Vegetables', '3') ?>>Selalu
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Number_of_Main_Meals_Daily">Jumlah Makan Utama Harian</label>
                            <select class="form-control" id="Number_of_Main_Meals_Daily"
                                name="Number_of_Main_Meals_Daily" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Number_of_Main_Meals_Daily', '1') ?>>1-2 kali makan
                                </option>
                                <option value="2" <?= set_select('Number_of_Main_Meals_Daily', '2') ?>>3 kali makan
                                </option>
                                <option value="3" <?= set_select('Number_of_Main_Meals_Daily', '3') ?>>Lebih dari 3 kali
                                    makan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Food_Intake_Between_Meals">Asupan Makanan di Antara Waktu Makan</label>
                            <select class="form-control" id="Food_Intake_Between_Meals" name="Food_Intake_Between_Meals"
                                required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Food_Intake_Between_Meals', '1') ?>>Jarang</option>
                                <option value="2" <?= set_select('Food_Intake_Between_Meals', '2') ?>>Kadang</option>
                                <option value="3" <?= set_select('Food_Intake_Between_Meals', '3') ?>>Biasanya</option>
                                <option value="4" <?= set_select('Food_Intake_Between_Meals', '4') ?>>Selalu</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Smoking">Merokok</label>
                            <select class="form-control" id="Smoking" name="Smoking" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Smoking', '1') ?>>Ya</option>
                                <option value="2" <?= set_select('Smoking', '2') ?>>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Liquid_Intake_Daily">Asupan Cairan Harian</label>
                            <select class="form-control" id="Liquid_Intake_Daily" name="Liquid_Intake_Daily" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Liquid_Intake_Daily', '1') ?>>Kurang dari 1L
                                </option>
                                <option value="2" <?= set_select('Liquid_Intake_Daily', '2') ?>>1-2L</option>
                                <option value="3" <?= set_select('Liquid_Intake_Daily', '3') ?>>Lebih dari 2L
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Calculation_of_Calorie_Intake">Perhitungan Asupan Kalori</label>
                            <select class="form-control" id="Calculation_of_Calorie_Intake"
                                name="Calculation_of_Calorie_Intake" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Calculation_of_Calorie_Intake', '1') ?>>Ya</option>
                                <option value="2" <?= set_select('Calculation_of_Calorie_Intake', '2') ?>>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Physical_Exercise">Olahraga Fisik</label>
                            <select class="form-control" id="Physical_Exercise" name="Physical_Exercise" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Physical_Exercise', '1') ?>>Tidak ada aktivitas
                                </option>
                                <option value="2" <?= set_select('Physical_Exercise', '2') ?>>1-2 hari</option>
                                <option value="3" <?= set_select('Physical_Exercise', '3') ?>>3-4 hari</option>
                                <option value="4" <?= set_select('Physical_Exercise', '4') ?>>5-6 hari</option>
                                <option value="5" <?= set_select('Physical_Exercise', '5') ?>>Lebih dari 6 hari</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Schedule_Dedicated_to_Technology">Waktu yang Didedikasikan untuk
                                Teknologi</label>
                            <select class="form-control" id="Schedule_Dedicated_to_Technology"
                                name="Schedule_Dedicated_to_Technology" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Schedule_Dedicated_to_Technology', '1') ?>>0-2 jam
                                </option>
                                <option value="2" <?= set_select('Schedule_Dedicated_to_Technology', '2') ?>>3-5 jam
                                </option>
                                <option value="3" <?= set_select('Schedule_Dedicated_to_Technology', '3') ?>>Lebih dari
                                    5 jam
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Type_of_Transportation_Used">Jenis Transportasi yang Digunakan</label>
                            <select class="form-control" id="Type_of_Transportation_Used"
                                name="Type_of_Transportation_Used" required>
                                <option value="" disabled selected>Pilih Salah Satu</option>
                                <option value="1" <?= set_select('Type_of_Transportation_Used', '1') ?>>Mobil
                                </option>
                                <option value="2" <?= set_select('Type_of_Transportation_Used', '2') ?>>Sepeda motor
                                </option>
                                <option value="3" <?= set_select('Type_of_Transportation_Used', '3') ?>>Sepeda
                                </option>
                                <option value="4" <?= set_select('Type_of_Transportation_Used', '4') ?>>Transportasi umum
                                </option>
                                <option value="5" <?= set_select('Type_of_Transportation_Used', '5') ?>>Berjalan kaki
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <!-- Tombol reset -->
                        <!-- <button type="button" class="btn btn-secondary px-4" id="resetFormBtn">
                            <i class="fas fa-undo"></i> Reset
                        </button> -->
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-calculator"></i> Prediksi
                        </button>
                    </div>
                </form>

                <?php if (isset($data['prediction'])): ?>
                    <div class="mt-5 result-page">
                        <div class="alert alert-info">
                            <h4><i class="fas fa-chart-pie"></i> Hasil Prediksi</h4>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Haisl Algoritma</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Algoritma</th>
                                                        <th>Hasil</th>
                                                        <th>Interpretasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $interpretations = [
                                                        1 => 'Kurus',
                                                        2 => 'Normal',
                                                        3 => 'Kelebihan berat badan',
                                                        4 => 'Obesitas'
                                                    ];
                                                    ?>
                                                    <tr>
                                                        <td><strong>K-Nearest Neighbors</strong></td>
                                                        <td><?= $data['prediction']['KNN_prediction'] ?></td>
                                                        <td><?= $interpretations[$data['prediction']['KNN_prediction']] ?? 'Tidak Diketahui' ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Random Forest</strong></td>
                                                        <td><?= $data['prediction']['RandomForest_prediction'] ?></td>
                                                        <td><?= $interpretations[$data['prediction']['RandomForest_prediction']] ?? 'Tidak Diketahui' ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0">Ringkasan Data Input</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <tbody>
                                                    <?php foreach ($data['input_data'] as $key => $value): ?>
                                                        <tr>
                                                            <th><?= ucwords(str_replace('_', ' ', $key)) ?></th>
                                                            <td>
                                                                <?php
                                                                if ($key === 'Sex') {
                                                                    echo ($value == 1) ? 'Laki-laki' : 'Perempuan';
                                                                } elseif ($key === 'Overweight_Obese_Family' || $key === 'Smoking' || $key === 'Calculation_of_Calorie_Intake') {
                                                                    echo ($value == 1) ? 'Ya' : 'Tidak';
                                                                } else {
                                                                    echo htmlspecialchars($value);
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning mt-4">
                            <h5><i class="fas fa-info-circle"></i> Rekomendasi</h5>
                            <?php
                            $max_prediction = max($data['prediction']['KNN_prediction'], $data['prediction']['RandomForest_prediction']);
                            if ($max_prediction >= 3): ?>
                                <p>Berdasarkan prediksi, Anda mungkin berisiko mengalami kelebihan berat badan atau obesitas.
                                    Pertimbangkan untuk:</p>
                                <ul>
                                    <li>Meningkatkan aktivitas fisik (setidaknya 30 menit setiap hari)</li>
                                    <li>Mengurangi konsumsi makanan cepat saji dan minuman manis</li>
                                    <li>Lebih banyak mengonsumsi sayuran dan buah-buahan</li>
                                    <li>Berkonsultasi dengan ahli gizi atau tenaga kesehatan</li>
                                </ul>
                            <?php else: ?>
                                <p>Berat badan Anda tampaknya berada dalam kisaran sehat. Pertahankan kebiasaan baik Anda:</p>
                                <ul>
                                    <li>Lanjutkan aktivitas fisik secara teratur</li>
                                    <li>Pertahankan pola makan seimbang</li>
                                    <li>Periksa kesehatan Anda secara rutin</li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>