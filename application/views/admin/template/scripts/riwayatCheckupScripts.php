<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    $(document).ready(function () {
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
                        url: '<?= site_url('checkup/hapus_riwayat'); ?>',
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