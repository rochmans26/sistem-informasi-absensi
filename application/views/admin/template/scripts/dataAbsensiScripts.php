<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Validasi form filter
        $('#filterForm').on('submit', function (e) {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            if (startDate && endDate && startDate > endDate) {
                alert('Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
                e.preventDefault();
                return false;
            }
        });

        // Auto submit ketika select berubah (opsional)
        $('#karyawan, #status').on('change', function () {
            $('#filterForm').submit();
        });

        // Set max date untuk end_date berdasarkan start_date
        $('#start_date').on('change', function () {
            $('#end_date').attr('min', $(this).val());
        });

        // Set min date untuk start_date berdasarkan end_date
        $('#end_date').on('change', function () {
            $('#start_date').attr('max', $(this).val());
        });
    });
</script>