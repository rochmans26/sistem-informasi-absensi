<!-- JavaScript Code -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Tombol Simpan
        $('#simpan').on('click', function () {
            let id = $('#id').val();
            let nama_jabatan = $('#nama_jabatan').val();
            let gaji_jabatan = $('#gaji_jabatan').val();

            // Reset error
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            let hasError = false;

            if (!nama_jabatan) {
                $('#nama_jabatan').addClass('is-invalid');
                $('#error-nama_jabatan').text('Nama Jabatan wajib diisi.');
                hasError = true;
            }

            if (!gaji_jabatan) {
                $('#gaji_jabatan').addClass('is-invalid');
                $('#error-gaji_jabatan').text('Gaji Jabatan wajib diisi.');
                hasError = true;
            }

            if (hasError) {
                Swal.fire('Oops!', 'Harap lengkapi semua field dengan benar.', 'warning');
                return;
            }

            // Tentukan URL tambah/edit
            let url = id ? '<?= site_url('admin/edit_jabatan') ?>' : '<?= site_url('admin/tambah_jabatan') ?>';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id,
                    nama_jabatan: nama_jabatan,
                    gaji_jabatan: gaji_jabatan
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
                            $('#modalFormJabatan').modal('hide');
                            $('#formJabatan')[0].reset();
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
            $('#formJabatan')[0].reset();
            $('#id').val('');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Tambah Jabatan');
            $('#simpan').text('Simpan');
        });

        // Isi form saat klik edit
        $(document).on('click', '#btn-edit', function () {
            $('#id').val($(this).data('id'));
            $('#nama_jabatan').val($(this).data('nama_jabatan')); // Pastikan data attribute ini ada
            $('#gaji_jabatan').val($(this).data('gaji_jabatan'));

            console.log($('#gaji_jabatan').val());// gaji jabatan
            console.log($('#nama_jabatan').val());// nama jabatan

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#title').text('Edit Jabatan');
            $('#simpan').text('Update');
            $('#modalFormJabatan').modal('show');
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
                        url: '<?= site_url('admin/hapus_jabatan'); ?>',
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