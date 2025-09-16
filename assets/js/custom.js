// Custom JavaScript for additional functionality
$(document).ready(function () {
	// Enable tooltips
	$('[data-toggle="tooltip"]').tooltip();

	// Handle form submissions
	$("form").submit(function () {
		$('button[type="submit"]')
			.prop("disabled", true)
			.html('<i class="fas fa-spinner fa-spin"></i> Processing...');
	});

	// Initialize DataTables with responsive feature
	if ($.fn.DataTable) {
		$("#dataTable").DataTable({
			responsive: true,
		});
	}
});
