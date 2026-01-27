<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SPMB - SMK Nusantara 1 Kota Tangerang</title>

    <meta name="description" content="Seleksi Penerimaan Murid Baru SMK Nusantara 1 Kota Tangerang" />
    <meta name="keyword" content="spmb, smk nusantara 1 kota tangerang">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="preconnect" href="https://lh3.googleusercontent.com">

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/3fee3556d5.js" crossorigin="anonymous"></script>
    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>

    <style>
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        .status-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0;
            margin: 20px 0;
        }

        .status-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 120px;
            text-align: center;
        }

        .circle {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
            color: white;
            margin-bottom: 8px;
        }

        .success {
            background: #28a745;
        }

        .danger {
            background: #dc3545;
        }

        /* GARIS NYA OTOMATIS CENTER & RESPONSIF */
        .status-line {
            flex: 1;
            height: 4px;
            background: #ccc;
            margin: 0 2px;
            border-radius: 3px;
        }

        /* RESPONSIVE MOBILE */
        @media (max-width: 768px) {
            .status-wrapper {
                flex-direction: column;
            }

            .status-line {
                width: 4px;
                height: 40px;
                margin: 10px 0;
            }
        }


    </style>

    @livewireStyles
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Sidebar --}}
            @include('layouts.sidebar')
            {{-- End Sidebar --}}
            <!-- Layout container -->
            <div class="layout-page">

                {{-- Navbar --}}
                @include('layouts.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Layout Demo -->
                        @yield('content')
                    </div>
                    {{-- End Content --}}

                    {{-- Footer --}}
                    @include('layouts.footer')
                    {{-- End Footer --}}

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- MODAL LOADING -->
    <div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                {{-- <div class="spinner-border text-primary mb-3" role="status"></div> --}}
                <h5>Memuat data...</h5>
                <small class="text-muted">Mohon tunggu</small>
            </div>
        </div>
    </div>

    <!-- MODAL TIMEOUT -->
    <div class="modal fade" id="timeoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Request Timeout</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Sepertinya koneksi kurang stabil, server butuh waktu lebih lama.</p>
                    <p class="text-muted">Silakan klik tombol refresh atau periksa koneksi internet Anda.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="loadHalaman()">Refresh</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>


    <!-- Livewire scripts WAJIB terakhir -->
    @livewireScripts

    <script>
        new DataTable('#pendaftar', {
            fixedHeader: {
                header: true,
            },
            paging: false,
            scrollCollapse: true,
            scrollX: true,
            scrollY: 300
        });

        new DataTable('#dataAkun' {
            paging: false,
        });
        new DataTable('#dataCalonPendaftar');
        new DataTable('#dataRegistrasi');
    </script>

    <script>
        window.Livewire.on('bukaKamera', () => {
            // console.log("Event bekerja");

            const modalEl = document.getElementById('cameraModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();

            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "user"
                    }
                })
                .then(s => {
                    document.getElementById('camera').srcObject = s;
                })
                .catch(err => alert('Error akses kamera: ' + err.message));
        });

        window.addEventListener('close-modal', event => {
            let modal = bootstrap.Modal.getInstance(document.getElementById('cameraModal'));
            if (modal) {
                modal.hide();
            }
        });

        document.getElementById('cameraModal').addEventListener('hidden.bs.modal', () => {
            const video = document.getElementById('camera');
            const stream = video.srcObject;
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            video.srcObject = null;
        });

        function takeSnapshot() {
            const video = document.getElementById('camera');
            const canvas = document.getElementById('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0);
            const dataURL = canvas.toDataURL('image/png');
            console.log(dataURL);
            Livewire.dispatch('setFoto', {
                dataUrl: dataURL
            });
        }
    </script>

    <script>
        function openPrintWindow(url) {
            const printWindow = window.open(url, '_blank');
        }
    </script>

    <script>
        const oldWilayah = {
            provinsi: "{{ old('provinsi', $siswa->provinsi ?? '') }}",
            kota: "{{ old('kota', $siswa->kota ?? '') }}",
            kecamatan: "{{ old('kecamatan', $siswa->kecamatan ?? '') }}",
            kelurahan: "{{ old('kelurahan', $siswa->kelurahan ?? '') }}",
        };

        // document.addEventListener("DOMContentLoaded", function () {

        //     loadProvinsi();

        //     function loadProvinsi() {
        //         fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
        //             .then(res => res.json())
        //             .then(data => {
        //                 let options = "<option value=''>-- Pilih Provinsi --</option>";
        //                 data.forEach(p => {
        //                     let selected = p.id == oldWilayah.provinsi ? 'selected' : '';
        //                     options += `<option value="${p.id}" ${selected}>${p.name}</option>`;
        //                 });
        //                 document.getElementById("provinsi").innerHTML = options;
        //             });
        //     }

        //     document.getElementById("provinsi").addEventListener("change", function () {
        //         let provinceId = this.value;

        //         fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
        //             .then(res => res.json())
        //             .then(data => {
        //                 let options = "<option value=''>-- Pilih Kota --</option>";
        //                 data.forEach(k => {
        //                     options += `<option value="${k.id}">${k.name}</option>`;
        //                 });
        //                 document.getElementById("kota").innerHTML = options;
        //                 document.getElementById("kecamatan").innerHTML = "";
        //                 document.getElementById("kelurahan").innerHTML = "";
        //             });
        //     });

        //     document.getElementById("kota").addEventListener("change", function () {
        //         let cityId = this.value;

        //         fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${cityId}.json`)
        //             .then(res => res.json())
        //             .then(data => {
        //                 let options = "<option value=''>-- Pilih Kecamatan --</option>";
        //                 data.forEach(kec => {
        //                     options += `<option value="${kec.id}">${kec.name}</option>`;
        //                 });
        //                 document.getElementById("kecamatan").innerHTML = options;
        //                 document.getElementById("kelurahan").innerHTML = "";
        //             });
        //     });

        //     document.getElementById("kecamatan").addEventListener("change", function () {
        //         let kecId = this.value;

        //         fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`)
        //             .then(res => res.json())
        //             .then(data => {
        //                 let options = "<option value=''>-- Pilih Kelurahan --</option>";
        //                 data.forEach(kel => {
        //                     options += `<option value="${kel.id}">${kel.name}</option>`;
        //                 });
        //                 document.getElementById("kelurahan").innerHTML = options;
        //             });
        //     });

        // });
        document.addEventListener("DOMContentLoaded", function () {

            loadProvinsi();

            function loadProvinsi() {
                fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
                    .then(res => res.json())
                    .then(data => {
                        let options = "<option value=''>-- Pilih Provinsi --</option>";
                        data.forEach(p => {
                            let selected = p.id == oldWilayah.provinsi ? 'selected' : '';
                            options += `<option value="${p.id}" ${selected}>${p.name}</option>`;
                        });
                        provinsi.innerHTML = options;

                        if (oldWilayah.provinsi) {
                            loadKota(oldWilayah.provinsi);
                        }
                    });
            }

            function loadKota(provinsiId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsiId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        let options = "<option value=''>-- Pilih Kota --</option>";
                        data.forEach(k => {
                            let selected = k.id == oldWilayah.kota ? 'selected' : '';
                            options += `<option value="${k.id}" ${selected}>${k.name}</option>`;
                        });
                        kota.innerHTML = options;

                        if (oldWilayah.kota) {
                            loadKecamatan(oldWilayah.kota);
                        }
                    });
            }

            function loadKecamatan(kotaId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kotaId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        let options = "<option value=''>-- Pilih Kecamatan --</option>";
                        data.forEach(kec => {
                            let selected = kec.id == oldWilayah.kecamatan ? 'selected' : '';
                            options += `<option value="${kec.id}" ${selected}>${kec.name}</option>`;
                        });
                        kecamatan.innerHTML = options;

                        if (oldWilayah.kecamatan) {
                            loadKelurahan(oldWilayah.kecamatan);
                        }
                    });
            }

            function loadKelurahan(kecamatanId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
                    .then(res => res.json())
                    .then(data => {
                        let options = "<option value=''>-- Pilih Kelurahan --</option>";
                        data.forEach(kel => {
                            let selected = kel.id == oldWilayah.kelurahan ? 'selected' : '';
                            options += `<option value="${kel.id}" ${selected}>${kel.name}</option>`;
                        });
                        kelurahan.innerHTML = options;
                    });
            }

            provinsi.addEventListener("change", function () {
                oldWilayah.kota = oldWilayah.kecamatan = oldWilayah.kelurahan = null;
                loadKota(this.value);
            });

            kota.addEventListener("change", function () {
                oldWilayah.kecamatan = oldWilayah.kelurahan = null;
                loadKecamatan(this.value);
            });

            kecamatan.addEventListener("change", function () {
                oldWilayah.kelurahan = null;
                loadKelurahan(this.value);
            });

        });
    </script>

    <script>
        let timeoutHandle;

        function loadHalaman() {
            const loadingModal = new bootstrap.Modal(
                document.getElementById('loadingModal')
            );
            const timeoutModal = new bootstrap.Modal(
                document.getElementById('timeoutModal')
            );

            // Tampilkan loading
            loadingModal.show();

            // ⏱ Timeout 10 detik
            timeoutHandle = setTimeout(() => {
                loadingModal.hide();
                timeoutModal.show();
            }, 10000);

            fetch('/admin/grafik/data')
                .then(res => {
                    if (!res.ok) throw new Error('Server error');
                    return res.json();
                })
                .then(data => {
                    clearTimeout(timeoutHandle);
                    loadingModal.hide();

                    // 👉 render grafik di sini
                    // renderGrafik(data);
                })
                .catch(err => {
                    clearTimeout(timeoutHandle);
                    loadingModal.hide();
                    timeoutModal.show();
                    console.error(err);
                });
        }
        </script>


</body>

</html>
