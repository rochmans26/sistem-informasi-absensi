<script>
    $(document).ready(function () {
        // Validasi tanggal
        $('#start_date, #end_date').on('change', function () {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            if (startDate && endDate && startDate > endDate) {
                alert('Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
                $('#end_date').val(startDate);
            }
        });

        // Set min/max dates
        $('#start_date').on('change', function () {
            $('#end_date').attr('min', $(this).val());
        });

        $('#end_date').on('change', function () {
            $('#start_date').attr('max', $(this).val());
        });
    });
</script>