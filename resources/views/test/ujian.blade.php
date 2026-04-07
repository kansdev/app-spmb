<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Masuk SMK Nusantara 1 Kota Tangerang</title>
    <meta name="description" content="Test Masuk SMK Nusantara 1 Kota Tangerang">
    <meta name="keywords" content="Test Masuk SMK Nusantara 1 Kota Tangerang">
    <meta name="author" content="SMK Nusantara 1 Kota Tangerang">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Test Masuk <br> SMK Nusantara 1 Kota Tangerang</h1>
        <p class="text-center">Selamat datang di halaman ujian. Silakan masukkan nomor registrasi Anda untuk memulai ujian.</p>

        <div class="text-center fw-bold" id="clock">00:00:00</div>
        <div class="text-center fw-bold mb-3" id="date">Memuat tanggal...</div>

        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nomor_registrasi" class="form-label">Nomor Registrasi</label>
                    <input type="text" class="form-control" id="nomor_registrasi" required>
                </div>
                <button onclick="cekRegistrasi()" class="btn btn-primary w-100">Cek</button>

                <div id="error" class="alert alert-danger mt-3" style="display: none;"></div>
            </div>
        </div>  
    </div>

    <div class="modal fade" id="modalSiswa" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Siswa</h5>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="nama_siswa"></span></p>
                    <p><strong>Tanggal Lahir:</strong> <span id="tanggal_lahir"></span></p>
                    <p><strong>Asal Sekolah:</strong> <span id="asal_sekolah"></span></p>
                    <p><strong>Jurusan Pilihan:</strong> <span id="jurusan"></span></p>
                </div>
                <div class="modal-footer">
                    <a id="btnMulaiUjian" class="btn btn-primary">Mulai Ujian</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cekRegistrasi() {
            const nomorRegistrasi = document.getElementById('nomor_registrasi').value;
            let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const errorDiv = document.getElementById('error');
            errorDiv.style.display = 'none';

            if (!nomorRegistrasi) {
                errorDiv.textContent = 'Nomor registrasi tidak boleh kosong.';
                errorDiv.style.display = 'block';
                return;
            }

            fetch('/ujian/cek_registrasi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({ nomor_pendaftaran: nomorRegistrasi })
            })
            .then(response => response.json())
            .then(response => {
                if(response.status) {
                    let tanggal = response.data.tanggal_lahir;
                    let hasil = new Date(tanggal).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                    document.getElementById('nama_siswa').textContent = response.data.nama_siswa;
                    document.getElementById('asal_sekolah').textContent = response.data.asal_sekolah;
                    document.getElementById('jurusan').textContent = response.data.jurusan_pertama;
                    document.getElementById('tanggal_lahir').textContent = hasil;
                    document.getElementById('btnMulaiUjian').href = `/ujian/mulai/${response.data.id}`;
                    var my_modal = new bootstrap.Modal(document.getElementById('modalSiswa'));
                    my_modal.show();
                } else {
                    errorDiv.textContent = 'Nomor registrasi tidak ditemukan. Pastikan nomor registrasi benar.';
                    errorDiv.style.display = 'block';
                }
            })
            .catch(error => {
                console.log('Error :', error);
                errorDiv.textContent = 'Terjadi kesalahan saat memeriksa nomor registrasi.';
                errorDiv.style.display = 'block';
            });
        }
    </script>
    
    <script>
        function updateTime() {
            const now = new Date();
            
            // Format Jam (HH:mm:ss)
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

            // Format Tanggal
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('date').textContent = now.toLocaleDateString('id-ID', options);
        }

        // Jalankan fungsi setiap 1 detik (1000ms)
        setInterval(updateTime, 1000);
        updateTime(); // Panggil langsung agar tidak menunggu 1 detik pertama
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>