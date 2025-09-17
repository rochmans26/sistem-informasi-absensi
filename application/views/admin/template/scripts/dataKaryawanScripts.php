<!-- JavaScript Code -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Tombol Simpan
        $('#simpan').on('click', function () {
            let id = $('#id').val();
            let uuid = $('#uuid').val();
            let nm_karyawan = $('#nm_karyawan').val();

            // Reset error
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            let hasError = false;

            if (!uuid) {
                $('#uuid').addClass('is-invalid');
                $('#error-uuid').text('UUID wajib diisi.');
                hasError = true;
            }

            if (!nm_karyawan) {
                $('#nm_karyawan').addClass('is-invalid');
                $('#error-nm_karyawan').text('Nama Karyawan wajib diisi.');
                hasError = true;
            }

            if (hasError) {
                Swal.fire('Oops!', 'Harap lengkapi semua field dengan benar.', 'warning');
                return;
            }

            // Tentukan URL tambah/edit
            let url = id ? '<?= site_url('admin/edit_karyawan') ?>' : '<?= site_url('admin/tambah_karyawan') ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id,
                    uuid: uuid,
                    nm_karyawan: nm_karyawan
                },
                dataType: 'json',
                success: function (res) {
                    if (res.status === 'success') {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: id ? 'Data karyawan berhasil diupdate.' : 'Data karyawan berhasil disimpan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#modalFormKaryawan').modal('hide');
                            $('#formKaryawan')[0].reset();
                            location.reload();
                        });
                    } else if (res.status === 'error' && res.errors) {
                        $.each(res.errors, function (field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#error-' + field).text(message);
                        });
                    } else {
                        // Jika server mengembalikan respons yang tidak dikenali
                        console.log('Respons server:', res);
                        Swal.fire('Gagal!', res.message || 'Terjadi kesalahan.', 'error');
                    }
                },
                error: function (xhr, status, error) {
                    // Tambahkan logging untuk debugging
                    console.log('XHR:', xhr);
                    console.log('Status:', status);
                    console.log('Error:', error);

                    Swal.fire('Error!', 'Gagal menyimpan data ke server: ' + error, 'error');
                }
            });
        });

        // Reset form saat modal dibuka
        $(document).on('click', '#openModal', function () {
            $('#formKaryawan')[0].reset();
            $('#id').val('');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Tambah Karyawan');
            $('#simpan').text('Simpan');
        });

        // Isi form saat klik edit
        $(document).on('click', '#btn-edit', function () {
            $('#id').val($(this).data('id'));
            $('#uuid').val($(this).data('uuid')); // Pastikan data attribute ini ada
            $('#nm_karyawan').val($(this).data('nm_karyawan')); // Perbaiki dari data('nama') ke data('nm_karyawan')

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Edit Karyawan');
            $('#simpan').text('Update');
            $('#modalFormKaryawan').modal('show');
        });

        // Hapus data
        $(document).on('click', '#btn-hapus', function (e) {
            e.preventDefault();

            const id = $(this).data('id');
            console.log(id);

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
                        url: '<?= site_url('admin/hapus_karyawan'); ?>',
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