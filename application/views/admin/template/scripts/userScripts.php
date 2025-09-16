<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    $(document).ready(function () {
        // Tombol Simpan
        $('#simpan').on('click', function () {
            let id = $('#id').val();
            let nama = $('#nama').val();
            let email = $('#email').val();
            let sex = $('#sex').val();
            let age = $('#age').val();
            let telp = $('#telp').val();

            // Reset error
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            let hasError = false;

            if (!nama) {
                $('#nama').addClass('is-invalid');
                $('#error-nama').text('Nama wajib diisi.');
                hasError = true;
            }
            if (!email) {
                $('#email').addClass('is-invalid');
                $('#error-email').text('Email wajib diisi.');
                hasError = true;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                $('#email').addClass('is-invalid');
                $('#error-email').text('Format email tidak valid.');
                Swal.fire('Oops!', 'Format email tidak valid!', 'error');
                return;
            }
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
            if (!telp) {
                $('#telp').addClass('is-invalid');
                $('#error-telp').text('Nomor telepon wajib diisi.');
                hasError = true;
            } else if (!/^[0-9]+$/.test(telp)) {
                $('#telp').addClass('is-invalid');
                $('#error-telp').text('Nomor telepon hanya boleh angka.');
                Swal.fire('Oops!', 'Nomor telepon hanya boleh angka.', 'error');
                return;
            }

            if (hasError) {
                Swal.fire('Oops!', 'Harap lengkapi semua field dengan benar.', 'warning');
                return;
            }

            // Tentukan URL tambah/edit
            let url = id ? '<?= site_url('userscontroller/edit_user'); ?>' : '<?= site_url('userscontroller/tambah_user'); ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: { id, nama, email, sex, age, telp },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: id ? 'Data user berhasil diupdate.' : 'Data user berhasil disimpan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#modalFormUser').modal('hide');
                            $('#formUser')[0].reset();
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

        // Reset form saat modal dibuka
        $(document).on('click', '#openModal', function () {
            $('#formUser')[0].reset();
            $('#id').val('');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Tambah User');
            $('#simpan').text('Simpan');
        });

        // Isi form saat klik edit
        $(document).on('click', '#btn-edit', function () {
            $('#id').val($(this).data('id'));
            $('#nama').val($(this).data('nama'));
            $('#email').val($(this).data('email'));
            $('#sex').val($(this).data('sex'));
            $('#age').val($(this).data('age'));
            $('#telp').val($(this).data('telp'));

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Edit User');
            $('#simpan').text('Update');
            $('#modalFormUser').modal('show');
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
                        url: '<?= site_url('userscontroller/hapus_user'); ?>',
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

</script>