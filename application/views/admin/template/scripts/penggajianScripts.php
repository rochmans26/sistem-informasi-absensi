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

        // Info ketentuan baru
        $('.alert-info').html(`
        <small>
            <i class="fas fa-info-circle"></i> 
            <strong>Ketentuan Penggajian:</strong><br>
            - Jam kerja ≥ 10 jam: Gaji harian 100%<br>
            - Jam kerja ≤ 5 jam: Gaji harian 50%<br>
            - Jam kerja > 5 jam dan < 10 jam: Gaji proporsional (gaji/10 × total jam)<br>
            - Jam kerja > 10 jam: Lembur Rp 5.000/jam
        </small>
    `);
    });
</script>