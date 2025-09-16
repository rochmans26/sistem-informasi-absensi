<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="<?php echo base_url('vendor/mystyle/') ?>assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Absensi</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotrons/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="<?php echo base_url('vendor/mystyle/') ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('vendor/mystyle/') ?>style.css" rel="stylesheet">
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>


    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Bootstrap</title>
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z">
            </path>
        </symbol>
        <symbol id="arrow-right-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
        </symbol>
        <symbol id="check2-circle" viewBox="0 0 16 16">
            <path
                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
            <path
                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
        </symbol>
    </svg>

    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <img src="<?= base_url('assets/img/vmdigis.png') ?>" alt="Unla" width="100" class="mb-4">
            <h1 class="text-body-emphasis">Prototipe Absensi</h1>
            <span class="col-lg-8 mx-auto fs-5 text-muted">© 2025 Prototype by Vortex Media Digital Solutions</span>
        </div>

        <div class="p-5 bg-body-tertiary rounded-3 mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-body-emphasis mb-3 text-center">Daftar Absensi</h2>
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Tanggal:</strong> <span id="current-date"><?= date('d-m-Y') ?></span></p>
                        </div>
                        <div class="col-6">
                            <p class="text-end"><strong>Waktu:</strong> <span
                                    id="current-time"><?= date('H:i:s') ?></span></p>
                        </div>
                    </div>
                    <div id="hasil"></div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-body-emphasis text-center">Form Absensi</h2>
                    <p class="lead text-center">
                        Mohon untuk absensi dengan jujur dan tidak boleh titip absen!
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center mb-3">
                                        <video id="video" width="320" height="240" autoplay></video>
                                        <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                        <button id="capture" class="btn btn-sm btn-primary mb-3 mt-3"
                                            style="width: 100px;">Capture</button>
                                        <img id="preview" src="" alt="Preview"
                                            style="display:none; border:1px solid #ccc;">
                                    </div>
                                    <form id="myForm">
                                        <div class="mb-3">
                                            <label for="selectKaryawan" class="form-label">Pilih ID Karyawan</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="id_karyawan" id="id_karyawan">
                                                <option value="">-- Pilih Karyawan --</option>
                                                <?php foreach ($karyawan as $k): ?>
                                                    <option value="<?= $k->id ?>"><?= $k->uuid ?> |
                                                        <?= $k->nm_karyawan ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kodeAbsensi" class="form-label">Kode Absensi</label>
                                            <input type="password" class="form-control" id="kode_karyawan"
                                                name="kode_karyawan">
                                        </div>

                                        <button id="submit" class="btn btn-md btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <script src="<?php echo base_url('vendor/mystyle/') ?>assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Inisialisasi variabel
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const preview = document.getElementById('preview');
            const context = canvas.getContext('2d');
            let stream = null;
            let isCameraReady = false;

            // Fungsi untuk memulai kamera
            function startCamera() {
                navigator.mediaDevices.getUserMedia({ video: true, audio: false })
                    .then(function (localStream) {
                        stream = localStream;
                        video.srcObject = stream;
                        isCameraReady = true;

                        // Update status kamera
                        $('#camera-status').removeClass('status-not-ready').addClass('status-ready');
                        $('#camera-status-text').text('Kamera siap digunakan');
                    })
                    .catch(function (err) {
                        console.error("Tidak bisa akses kamera: ", err);
                        $('#camera-status-text').text('Error: ' + err.message);

                        Swal.fire({
                            icon: 'error',
                            title: 'Kamera Tidak Dapat Diakses',
                            text: 'Pastikan Anda memberikan izin akses kamera dan perangkat kamera berfungsi dengan baik.',
                            confirmButtonText: 'Mengerti'
                        });
                    });
            }

            // Memulai kamera saat halaman dimuat
            startCamera();

            // Menangani tombol capture
            $("#capture").on("click", function (e) {
                e.preventDefault();

                if (!isCameraReady) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kamera Belum Siap',
                        text: 'Tunggu hingga kamera siap atau refresh halaman jika masalah berlanjut.'
                    });
                    return;
                }

                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                let dataURL = canvas.toDataURL("image/png");
                $("#preview").attr("src", dataURL).show();

                // Beri feedback bahwa foto berhasil diambil
                $(this).html('<i class="bi bi-check-circle"></i> Terambil').addClass('btn-success').removeClass('btn-primary');

                // Reset tombol setelah 2 detik
                setTimeout(() => {
                    $(this).html('<i class="bi bi-camera"></i> Capture').addClass('btn-primary').removeClass('btn-success');
                }, 2000);
            });

            // Load data pertama kali
            loadData();

            // Menangani submit form
            $("#myForm").on("submit", function (e) {
                e.preventDefault();

                let id_karyawan = $("#id_karyawan").val();
                let kode_karyawan = $("#kode_karyawan").val();
                let foto = $("#preview").attr("src");

                // Validasi form
                if (!id_karyawan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan pilih karyawan terlebih dahulu!'
                    });
                    $("#id_karyawan").focus();
                    return;
                }

                if (!kode_karyawan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan masukkan kode absensi!'
                    });
                    $("#kode_karyawan").focus();
                    return;
                }

                if (!foto) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan ambil foto terlebih dahulu!'
                    });
                    $("#capture").focus();
                    return;
                }

                // Tampilkan loading state
                $("#submit").prop('disabled', true);
                $("#submit-text").text('Mengirim data...');
                $("#loading-spinner").show();

                // Kirim data via AJAX
                $.ajax({
                    url: "<?= site_url('index/proses') ?>",
                    type: "POST",
                    data: {
                        id_karyawan: id_karyawan,
                        kode_karyawan: kode_karyawan,
                        foto: foto
                    },
                    success: function (response) {
                        // Reset loading state
                        $("#submit").prop('disabled', false);
                        $("#submit-text").text('Submit Absensi');
                        $("#loading-spinner").hide();

                        // Cek jika response mengandung ERROR
                        if (response.startsWith("ERROR:")) {
                            const errorMessage = response.substring(6);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: errorMessage
                            });
                            return;
                        }

                        // Cek jika response mengandung SUCCESS
                        if (response.startsWith("SUCCESS:")) {
                            const parts = response.split("|");
                            const status = parts[0].substring(8); // Extract status (MASUK/KELUAR)
                            const tableData = parts[1]; // Extract tabel data

                            // Update daftar absensi
                            $("#hasil").html(tableData);

                            // Reset form
                            $("#kode_karyawan").val("");
                            $("#preview").hide();
                            $("#id_karyawan").val("");

                            // Tampilkan notifikasi sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Absensi Berhasil',
                                text: 'Anda berhasil absensi ' + status,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            return;
                        }

                        // Jika hanya data tabel (untuk load data)
                        $("#hasil").html(response);
                    },
                    error: function (xhr, status, error) {
                        // Reset loading state
                        $("#submit").prop('disabled', false);
                        $("#submit-text").text('Submit Absensi');
                        $("#loading-spinner").hide();

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan koneksi. Silakan coba lagi.'
                        });
                        console.error("AJAX Error: ", status, error);
                    }
                });
            });

            // Fungsi untuk memuat data absensi
            function loadData() {
                $.ajax({
                    url: "<?= site_url('index/proses') ?>",
                    type: "POST",
                    data: { action: 'load_data' },
                    success: function (response) {
                        $("#hasil").html(response);
                    },
                    error: function () {
                        $("#hasil").html('<div class="alert alert-warning">Gagal memuat data absensi.</div>');
                    }
                });
            }

            // Memuat data setiap 30 detik
            setInterval(loadData, 30000);
        });
    </script>
    <script>
        // Fungsi untuk update tanggal dan waktu
        function updateDateTime() {
            const now = new Date();

            // Format tanggal: DD-MM-YYYY
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
            const year = now.getFullYear();
            const formattedDate = `${day}-${month}-${year}`;

            // Format waktu: HH:MM:SS
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const formattedTime = `${hours}:${minutes}:${seconds}`;

            // Update elemen HTML
            document.getElementById('current-date').textContent = formattedDate;
            document.getElementById('current-time').textContent = formattedTime;
        }

        // Update pertama kali
        updateDateTime();

        // Update setiap detik
        setInterval(updateDateTime, 1000);
    </script>

</body>

</html>