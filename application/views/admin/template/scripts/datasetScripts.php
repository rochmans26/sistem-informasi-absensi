<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.btn-test-edit').on('click', function () {
        let index = $(this).data('id');
        console.log("Index data: ", index);

        // Kalau mau kirim index ke backend via AJAX:
        // $.post('get_data.php', { index: index }, function(res) {
        //     console.log(res);
        // });
    });
</script>
<!-- <script>
    $(document).ready(function () {

        // === Tambah / Update Data ===
        $('#simpan').on('click', function () {
            let id = $('#id').val();
            let formData = {
                id: id,
                sex: $('#sex').val(),
                age: $('#age').val(),
                height: $('#height').val(),
                overweight_obese_family: $('#overweight_obese_family').val(),
                consumption_of_fast_food: $('#consumption_of_fast_food').val(),
                frequency_of_consuming_vegetables: $('#frequency_of_consuming_vegetables').val(),
                number_of_main_meals_daily: $('#number_of_main_meals_daily').val(),
                food_intake_between_meals: $('#food_intake_between_meals').val(),
                smoking: $('#smoking').val(),
                liquid_intake_daily: $('#liquid_intake_daily').val(),
                calculation_of_calorie_intake: $('#calculation_of_calorie_intake').val(),
                physical_exercise: $('#physical_exercise').val(),
                schedule_dedicated_to_technology: $('#schedule_dedicated_to_technology').val(),
                type_of_transportation_used: $('#type_of_transportation_used').val(),
                class: $('#class').val()
            };

            // Reset error
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            // Validasi sederhana (contoh)
            if (!formData.sex || !formData.age || !formData.height) {
                Swal.fire('Oops!', 'Harap lengkapi semua field.', 'warning');
                return;
            }

            let url = id ? '<?= site_url('datasetcontroller/edit_data'); ?>'
                : '<?= site_url('datasetcontroller/tambah_data'); ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: id ? 'Data berhasil diupdate.' : 'Data berhasil disimpan.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else if (res.status === 'error' && res.errors) {
                        $.each(res.errors, function (field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#error-' + field).text(message);
                        });
                    } else {
                        Swal.fire('Gagal!', res.message || 'Terjadi kesalahan.', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                }
            });
        });

        // === Open Modal Tambah Data ===
        $(document).on('click', '#openModalData', function () {
            $('#formDataset')[0].reset();
            $('#id').val('');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Form Tambah Dataset');
            $('#simpan').text('Simpan');
        });

        // === Open Modal Edit Data ===
        $(document).on('click', '.btn-edit', function () {
            $('#id').val($(this).data('id'));
            $('#sex').val($(this).data('sex'));
            $('#age').val($(this).data('age'));
            $('#height').val($(this).data('height'));
            $('#overweight_obese_family').val($(this).data('overweight_obese_family'));
            $('#consumption_of_fast_food').val($(this).data('consumption_of_fast_food'));
            $('#frequency_of_consuming_vegetables').val($(this).data('frequency_of_consuming_vegetables'));
            $('#number_of_main_meals_daily').val($(this).data('number_of_main_meals_daily'));
            $('#food_intake_between_meals').val($(this).data('food_intake_between_meals'));
            $('#smoking').val($(this).data('smoking'));
            $('#liquid_intake_daily').val($(this).data('liquid_intake_daily'));
            $('#calculation_of_calorie_intake').val($(this).data('calculation_of_calorie_intake'));
            $('#physical_exercise').val($(this).data('physical_exercise'));
            $('#schedule_dedicated_to_technology').val($(this).data('schedule_dedicated_to_technology'));
            $('#type_of_transportation_used').val($(this).data('type_of_transportation_used'));
            $('#class').val($(this).data('class'));

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Edit Data');
            $('#simpan').text('Update');
            $('#modalFormData').modal('show');
        });

        // === Hapus Data ===
        $(document).on('click', '.btn-hapus', function (e) {
            e.preventDefault();
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('datasetcontroller/hapus_data'); ?>',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: res.message,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            } else {
                                Swal.fire('Gagal!', res.message || 'Gagal menghapus data.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                        }
                    });
                }
            });
        });
    });

</script> -->
<!-- <script>
    $(document).ready(function () {
        $('#simpan').on('click', function () {
            let id = $('#id').val();
            let sex = $('#sex').val();
            let age = $('#age').val();
            let height = $('#height').val();
            let overweight_obese_family = $('#overweight_obese_family').val();
            let consumption_of_fast_food = $('#consumption_of_fast_food').val();
            let frequency_of_consuming_vegetables = $('#frequency_of_consuming_vegetables').val();
            let number_of_main_meals_daily = $('#number_of_main_meals_daily').val();
            let food_intake_between_meals = $('#food_intake_between_meals').val();
            let smoking = $('#smoking').val();
            let liquid_intake_daily = $('#liquid_intake_daily').val();
            let calculation_of_calorie_intake = $('#calculation_of_calorie_intake').val();
            let physical_exercise = $('#physical_exercise').val();
            let schedule_dedicated_to_technology = $('#schedule_dedicated_to_technology').val();
            let type_of_transportation_used = $('#type_of_transportation_used').val();
            let classV = $('#class').val();

            // Reset error
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            let hasError = false;

            if (!sex) {
                $('#sex').addClass('is-invalid');
                $('#error-sex').text('Jenis kelamin wajib dipilih.');
                hasError = true;
            }
            if (!age) {
                $('#age').addClass('is-invalid');
                $('#error-age').text('Usia wajib diisi.');
                hasError = true;
            } else if (parseInt(age) <= 0) {
                $('#age').addClass('is-invalid');
                $('#error-age').text('Usia harus lebih dari 0.');
                Swal.fire('Oops!', 'Usia harus lebih dari 0!', 'error');
                return;
            }
            if (!height) {
                $('#height').addClass('is-invalid');
                $('#error-height').text('Tinggi Badan wajib diisi.');
                hasError = true;
            } else if (parseInt(height) <= 100) {
                $('#height').addClass('is-invalid');
                $('#error-height').text('Tinggi Badan harus lebih dari 100.');
                Swal.fire('Oops!', 'Tinggi Badan harus lebih dari 100!', 'error');
                return;
            }

            // Validasi lainnya...

            if (hasError) {
                Swal.fire('Oops!', 'Harap lengkapi semua field dengan benar.', 'warning');
                return;
            }

            let url = id ? '<?= site_url('datasetcontroller/edit_data'); ?>' : '<?= site_url('datasetcontroller/tambah_data'); ?>';

            // FIXED: Tidak ada key duplikat
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id,
                    sex,
                    age,
                    height,
                    overweight_obese_family,
                    consumption_of_fast_food,
                    frequency_of_consuming_vegetables,
                    number_of_main_meals_daily,
                    food_intake_between_meals,
                    smoking,
                    liquid_intake_daily,
                    calculation_of_calorie_intake,
                    physical_exercise,
                    schedule_dedicated_to_technology,
                    type_of_transportation_used,
                    class: classV
                },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: id ? 'Data berhasil diupdate.' : 'Data berhasil disimpan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#modalFormData').modal('hide');
                            $('#formDataset')[0].reset();
                            location.reload();
                        });
                    } else if (res.status === 'error' && res.errors) {
                        $.each(res.errors, function (field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#error-' + field).text(message);
                        });
                    } else {
                        Swal.fire('Gagal!', res.message || 'Terjadi kesalahan.', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error!', 'Gagal menyimpan data ke server.', 'error');
                }
            });
        });

        $(document).on('click', '#openModalData', function () {
            $('#formDataset')[0].reset();
            $('#id').val('');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Form Tambah Dataset');
            $('#simpan').text('Simpan');
        });

        // Isi form saat klik edit
        $(document).on('click', '#btn-edit', function () {
            $('#id').val($(this).data('id'));
            $('#sex').val($(this).data('sex'));
            $('#age').val($(this).data('age'));
            $('#height').val($(this).data('height'));
            $('#overweight_obese_family').val($(this).data('overweight_obese_family'));
            $('#consumption_of_fast_food').val($(this).data('consumption_of_fast_food'));
            $('#frequency_of_consuming_vegetables').val($(this).data('frequency_of_consuming_vegetables'));
            $('#number_of_main_meals_daily').val($(this).data('number_of_main_meals_daily'));
            $('#food_intake_between_meals').val($(this).data('food_intake_between_meals'));
            $('#smoking').val($(this).data('smoking'));
            $('#liquid_intake_daily').val($(this).data('liquid_intake_daily'));
            $('#calculation_of_calorie_intake').val($(this).data('calculation_of_calorie_intake'));
            $('#physical_exercise').val($(this).data('physical_exercise'));
            $('#schedule_dedicated_to_technology').val($(this).data('schedule_dedicated_to_technology'));
            $('#type_of_transportation_used').val($(this).data('type_of_transportation_used'));
            $('#class').val($(this).data('class'));


            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Edit Data');
            $('#simpan').text('Update');
            // $('#wrapper').attr('aria-hidden', 'false');
            $('#modalFormData').modal('show');
            let index = document.getElementById('id').value;
            console.log(index);
        });

        $(document).on('click', '#btn-hapus', function (e) {
            e.preventDefault();

            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('datasetcontroller/hapus_data'); ?>',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: res.message,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // atau panggil fetchData()
                                });
                            } else {
                                Swal.fire('Gagal!', res.message || 'Gagal menghapus data.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                        }
                    });
                }
            });
        });
        $(document).on('click', '#delete-all', function (e) {
            e.preventDefault();

            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('datasetcontroller/hapus_data'); ?>',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: res.message,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // atau panggil fetchData()
                                });
                            } else {
                                Swal.fire('Gagal!', res.message || 'Gagal menghapus data.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                        }
                    });
                }
            });
        });
    });

</script> -->

<script>
    $(document).ready(function () {

        function resetForm() {
            $('#formDataset')[0].reset();
            $('#id').val('');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }

        // Pastikan fokus keluar modal sebelum aria-hidden
        $('#modalFormData').on('hide.bs.modal', function () {
            $('#openModalData').focus();
        });

        // Simpan / Update
        $('#simpan').on('click', function () {
            let dataForm = {
                id: $('#id').val(),
                sex: $('#sex').val(),
                age: $('#age').val(),
                height: $('#height').val(),
                overweight_obese_family: $('#overweight_obese_family').val(),
                consumption_of_fast_food: $('#consumption_of_fast_food').val(),
                frequency_of_consuming_vegetables: $('#frequency_of_consuming_vegetables').val(),
                number_of_main_meals_daily: $('#number_of_main_meals_daily').val(),
                food_intake_between_meals: $('#food_intake_between_meals').val(),
                smoking: $('#smoking').val(),
                liquid_intake_daily: $('#liquid_intake_daily').val(),
                calculation_of_calorie_intake: $('#calculation_of_calorie_intake').val(),
                physical_exercise: $('#physical_exercise').val(),
                schedule_dedicated_to_technology: $('#schedule_dedicated_to_technology').val(),
                type_of_transportation_used: $('#type_of_transportation_used').val(),
                class: $('#class').val()
            };

            // Reset error
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            let hasError = false;

            // Validasi minimal
            if (!dataForm.sex) {
                $('#sex').addClass('is-invalid');
                $('#error-sex').text('Jenis kelamin wajib dipilih.');
                hasError = true;
            }
            if (!dataForm.age) {
                $('#age').addClass('is-invalid');
                $('#error-age').text('Usia wajib diisi.');
                hasError = true;
            } else if (parseInt(dataForm.age) <= 0) {
                $('#age').addClass('is-invalid');
                $('#error-age').text('Usia harus lebih dari 0.');
                Swal.fire('Oops!', 'Usia harus lebih dari 0!', 'error');
                return;
            }
            if (!dataForm.height) {
                $('#height').addClass('is-invalid');
                $('#error-height').text('Tinggi Badan wajib diisi.');
                hasError = true;
            } else if (parseInt(dataForm.height) <= 100) {
                $('#height').addClass('is-invalid');
                $('#error-height').text('Tinggi Badan harus lebih dari 100.');
                Swal.fire('Oops!', 'Tinggi Badan harus lebih dari 100!', 'error');
                return;
            }

            if (hasError) {
                Swal.fire('Oops!', 'Harap lengkapi semua field dengan benar.', 'warning');
                return;
            }

            let url = dataForm.id
                ? '<?= site_url('datasetcontroller/edit_data'); ?>'
                : '<?= site_url('datasetcontroller/tambah_data'); ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: dataForm,
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: dataForm.id ? 'Data berhasil diupdate.' : 'Data berhasil disimpan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Pindahkan fokus ke elemen luar modal dulu
                            $('#openModalData').focus();

                            // Delay sedikit biar fokus benar-benar pindah sebelum aria-hidden
                            setTimeout(() => {
                                $('#modalFormData').modal('hide');
                                resetForm();
                                location.reload();
                            }, 50);
                        });
                    } else if (res.status === 'error' && res.errors) {
                        $.each(res.errors, function (field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#error-' + field).text(message);
                        });
                    } else {
                        Swal.fire('Gagal!', res.message || 'Terjadi kesalahan.', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error!', 'Gagal menyimpan data ke server.', 'error');
                }
            });
        });

        // Buka modal untuk tambah data
        $(document).on('click', '#openModalData', function () {
            resetForm();
            $('#title').text('Form Tambah Dataset');
            $('#simpan').text('Simpan');
        });

        // Edit data
        $(document).on('click', '#btn-edit', function () {
            $('#id').val($(this).data('id'));
            $('#sex').val($(this).data('sex'));
            $('#age').val($(this).data('age'));
            $('#height').val($(this).data('height'));
            $('#overweight_obese_family').val($(this).data('overweight_obese_family'));
            $('#consumption_of_fast_food').val($(this).data('consumption_of_fast_food'));
            $('#frequency_of_consuming_vegetables').val($(this).data('frequency_of_consuming_vegetables'));
            $('#number_of_main_meals_daily').val($(this).data('number_of_main_meals_daily'));
            $('#food_intake_between_meals').val($(this).data('food_intake_between_meals'));
            $('#smoking').val($(this).data('smoking'));
            $('#liquid_intake_daily').val($(this).data('liquid_intake_daily'));
            $('#calculation_of_calorie_intake').val($(this).data('calculation_of_calorie_intake'));
            $('#physical_exercise').val($(this).data('physical_exercise'));
            $('#schedule_dedicated_to_technology').val($(this).data('schedule_dedicated_to_technology'));
            $('#type_of_transportation_used').val($(this).data('type_of_transportation_used'));
            $('#class').val($(this).data('class'));

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Edit Data');
            $('#simpan').text('Update');
            $('#modalFormData').modal('show');
        });

        // Hapus data
        $(document).on('click', '#btn-hapus', function (e) {
            e.preventDefault();
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('datasetcontroller/hapus_data'); ?>',
                        type: 'POST',
                        data: { id: id },
                        dataType: 'json',
                        success: function (res) {
                            if (res.status === 'success') {
                                Swal.fire({
                                    title: 'Dihapus!',
                                    text: res.message,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Gagal!', res.message || 'Gagal menghapus data.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                        }
                    });
                }
            });
        });

    });
</script>