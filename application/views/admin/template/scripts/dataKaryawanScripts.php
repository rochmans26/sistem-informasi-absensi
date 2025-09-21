<!-- JavaScript Code -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {

        $(document).on('click', '.btn-edit', function () {
            const data = $(this).data();

            console.log('Edit Data:', data); // Debug: lihat data yang diterima

            // Populate form fields
            $('#id').val(data.id || '');
            $('#uuid').val(data.uuid || '');
            $('#nm_karyawan').val(data.nm_karyawan || '');
            $('#email').val(data.email || '');
            $('#alamat_ktp').val(data.alamat_ktp || '');
            $('#alamat_domisili').val(data.alamat_domisili || '');
            $('#tempat_lahir').val(data.tempat_lahir || '');
            $('#tanggal_lahir').val(data.tanggal_lahir || '');
            $('#jenis_kelamin').val(data.jenis_kelamin || '');
            $('#kewarganegaraan').val(data.kewarganegaraan || '');
            $('#agama').val(data.agama || '');
            $('#pendidikan_terakhir').val(data.pendidikan_terakhir || '');
            $('#id_jabatan').val(data.id_jabatan || '');
            $('#telp').val(data.telp || '');

            // Update modal title
            $('#modalFormKaryawanLabel').text('Edit Karyawan');

            // Update button text
            $('#btnSimpan').html('<i class="fas fa-sync-alt"></i> Update');

            // Reset validation errors
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').hide();

            // Show modal
            $('#modalFormKaryawan').modal('show');
        });

        // Fungsi validasi form
        function validateForm() {
            let isValid = true;
            const requiredFields = [
                'nm_karyawan', 'email', 'alamat_ktp', 'alamat_domisili',
                'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
                'kewarganegaraan', 'agama', 'pendidikan_terakhir', 'id_jabatan', 'telp'
            ];

            // Reset validation
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').hide();

            // Validate required fields
            requiredFields.forEach(field => {
                const value = $('#' + field).val().trim();
                if (!value) {
                    $('#' + field).addClass('is-invalid');
                    $('#error-' + field).show();
                    isValid = false;
                }
            });

            // Validate email format
            const email = $('#email').val().trim();
            if (email && !isValidEmail(email)) {
                $('#email').addClass('is-invalid');
                $('#error-email').text('Format email tidak valid').show();
                isValid = false;
            }

            return isValid;
        }

        // Email validation function
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Handle simpan button click
        $('#btnSimpan').on('click', function () {
            if (!validateForm()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Harap lengkapi semua field yang wajib diisi',
                    confirmButtonColor: '#3085d6'
                });
                return;
            }

            // Collect form data
            const formData = {
                id: $('#id').val(),
                uuid: $('#uuid').val(),
                nm_karyawan: $('#nm_karyawan').val().trim(),
                email: $('#email').val().trim(),
                alamat_ktp: $('#alamat_ktp').val().trim(),
                alamat_domisili: $('#alamat_domisili').val().trim(),
                tempat_lahir: $('#tempat_lahir').val().trim(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                kewarganegaraan: $('#kewarganegaraan').val(),
                agama: $('#agama').val(),
                pendidikan_terakhir: $('#pendidikan_terakhir').val(),
                id_jabatan: $('#id_jabatan').val(),
                telp: $('#telp').val()
            };

            // Determine URL
            const url = formData.id ? '<?= site_url('admin/edit_karyawan') ?>' : '<?= site_url('admin/tambah_karyawan') ?>';

            // Show loading
            const saveButton = $(this);
            const originalText = saveButton.html();
            saveButton.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            saveButton.prop('disabled', true);

            // AJAX request
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    console.log('Server Response:', response);

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: formData.id ? 'Data berhasil diperbarui' : 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#modalFormKaryawan').modal('hide');
                            location.reload();
                        });
                    } else if (response.status === 'error' && response.errors) {
                        // Show validation errors from server
                        $.each(response.errors, function (field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#error-' + field).text(message).show();
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Error Validasi',
                            text: 'Terdapat kesalahan dalam data yang diinput'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Terjadi kesalahan yang tidak diketahui'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Server',
                        text: 'Terjadi kesalahan pada server: ' + error
                    });
                },
                complete: function () {
                    saveButton.html(originalText);
                    saveButton.prop('disabled', false);
                }
            });
        });

        // Modal show event - Hanya untuk tambah data
        // Modal show event - Hanya untuk tambah data
        // $('#modalFormKaryawan').on('show.bs.modal', function (e) {
        //     // Jika modal dibuka dari tombol edit, jangan reset form
        //     if (!$(e.relatedTarget).hasClass('btn-edit')) {
        //         // Reset form hanya untuk tambah data
        //         $('#formKaryawan')[0].reset();
        //         $('#id').val('');
        //         $('#uuid').val('');
        //         $('.form-control').removeClass('is-invalid');
        //         $('.invalid-feedback').hide();
        //         $('#modalFormKaryawanLabel').text('Tambah Karyawan');
        //         $('#btnSimpan').html('<i class="fas fa-save"></i> Simpan');
        //     }
        // });

        // Handle edit button click - PERBAIKAN: ganti #btn-edit menjadi .btn-edit
        // Handle edit button click - PERBAIKAN: ganti #btn-edit menjadi .btn-edit
        // Handle edit button click - PERBAIKAN: ganti #btn-edit menjadi .btn-edit

        // Reset form ketika modal ditutup
        $('#modalFormKaryawan').on('hidden.bs.modal', function () {
            $('#formKaryawan')[0].reset();
            $('#id').val('');
            $('#uuid').val('');
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').hide();
        });

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