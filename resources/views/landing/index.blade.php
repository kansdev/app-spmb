<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PMB Online</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .hero {
      background: linear-gradient(
        rgba(0,0,0,0.55),
        rgba(0,0,0,0.55)
      ),
      url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f') center/cover no-repeat;
      color: #fff;
      padding: 145px 0;
    }

    .hero h1 {
      font-weight: 700;
    }

    .section-title {
      font-weight: 700;
      margin-bottom: 40px;
    }

    .step-icon {
      width: 60px;
      height: 60px;
      background: #0d6efd;
      color: #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      margin: 0 auto 15px;
    }

    .checklist li::before {
      content: "✔";
      color: #198754;
      font-weight: bold;
      margin-right: 10px;
    }

    .card-body .nav-link {
      color: var(--bs-secondary);
    }

    .card-body .nav-link.active {
      color: var(--bs-primary)!important;
      font-weight: 600;
    }

    footer {
      background: #0b1c2d;
      color: #fff;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="/assets/img/landing/logo.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#info">Info SPMB</a></li>
        <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
        <li class="nav-item"><a class="btn btn-light ms-lg-3" href="{{ route('login') }}">Login/Daftar</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section id="beranda" class="hero text-center">
  <div class="container">
    <h1 class="display-5 mb-3">Seleksi Penerimaan Murid Baru</h1>
    <h1 class="display-5 mb-3">SMK Nusantara 1 Kota Tangerang</h1>
    <p class="lead">Tahun Akademik 2026 / 2027</p>
    <p class="lead">Jalan Cisadane VII - VIII Perumnas 1, Jl. Cisadane V, RT.003/RW.002, Nusa Jaya, Kec. Karawaci, Kota Tangerang, Banten 15116</p>
    <a href="{{ route('login') }}" class="btn btn-primary btn-lg shadow fw-bold text-white">
      DAFTAR SEKARANG
    </a>
  </div>
</section>

<!-- INFO PMB -->
<section id="info" class="p-5">
  <div class="container">
    <div class="card border-0 shadow">
      <div class="card-body">
        <div class="m-5 p-5">
          <h2 class="section-title text-center">Informasi</h2>
          <nav>
            <ul class="nav nav-underline justify-content-center " id="informasiTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal-tab-pane" type="button" role="tab" aria-controls="jadwal-tab-pane" aria-selected="true">Jadwal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="persyaratan-tab" data-bs-toggle="tab" data-bs-target="#persyaratan-tab-pane" type="button" role="tab" aria-controls="persyaratan-tab-pane" aria-selected="true">Persyaratan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="tata-cara-tab" data-bs-toggle="tab" data-bs-target="#tata-cara-tab-pane" type="button" role="tab" aria-controls="tata-cara-tab-pane" aria-selected="true">Tata Cara</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" id="pendaftaran-reguler-tab" data-bs-toggle="tab" data-bs-target="#pendaftaran-reguler-tab-pane" type="button" role="tab" aria-controls="pendaftaran-reguler-tab-pane" aria-selected="true">Pendaftaran Reguler</a>
              </li>
            </ul>
          </nav>
          <div class="tab-content mt-4" id="informasiTabContent">
            <div class="tab-pane fade show active" id="jadwal-tab-pane" role="tabpanel" aria-labelledby="jadwal-tab" tabindex="0">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gelombang</th>
                    <th scope="col">Pendaftaran</th>
                    <th scope="col">Test</th>
                    <th scope="col">Pengumuman</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Gelombang 1</td>
                    <td>1 Januari 2025 - 28 Februari 2025</td>
                    <td>5 Maret 2025</td>
                    <td>20 Mei 2025</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Gelombang 2</td>
                    <td>5 Maret 2025 - 30 April 2025</td>
                    <td>5 Mei 2025</td>
                    <td>20 Mei 2025</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="persyaratan-tab-pane" role="tabpanel" aria-labelledby="persyaratan-tab" tabindex="0">
              <div class="row">
                <div class="col-md-4">
                  <img src="/assets/img/landing/image.webp" class="img-fluid" alt="image">
                </div>
                <div class="col-md-8">
                  <div class="card border-0 shadow">
                    <div class="card-body">
                      <ul class="checklist list-unstyled">
                        <li class="mb-2">Deposit tabungan wajib Rp. 500.000,-</li>
                        <li class="mb-2">Mengunggah Pas Foto Berwarna terbaru ukuran 3x4 cm</li>
                        <li class="mb-2">Mengunggah Akta Kelahiran</li>
                        <li class="mb-2">Mengunggah Kartu Keluarga</li>
                        <li class="mb-2">Mengunggah KTP Ayah dan Ibu</li>
                        <li class="mb-2">Mengikuti tes Akademik dan Wawancara</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="tata-cara-tab-pane" role="tabpanel" aria-labelledby="tata-cara-tab" tabindex="0">
              <img class="img-fluid" src="/assets/img/landing/alur-pendaftaran.jpg" alt="Alur Pendaftaran">
            </div>
            <div class="tab-pane fade text-center" id="pendaftaran-reguler-tab-pane" role="tabpanel" aria-labelledby="pendaftaran-reguler-tab" tabindex="0">
              Informasi lebih lanjut hubungi : 082133353539
            </div>
          </div>
        </div>

      </div>
    </div>
    <h2 class="section-title text-center mt-4">Alur Pendaftaran</h2>
    <div class="row g-4 text-center">
      <div class="col-md-3">
        <div class="step-icon">1</div>
        <h6>Buat Akun</h6>
        <p>Isi data diri calon pendaftar.</p>
      </div>
      <div class="col-md-3">
        <div class="step-icon">2</div>
        <h6>Lengkapi Berkas</h6>
        <p>Upload dokumen persyaratan.</p>
      </div>
      <div class="col-md-3">
        <div class="step-icon">3</div>
        <h6>Verifikasi</h6>
        <p>Data diverifikasi oleh panitia.</p>
      </div>
      <div class="col-md-3">
        <div class="step-icon">4</div>
        <h6>Pengumuman</h6>
        <p>Cek hasil seleksi secara online.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section id="faq" class="py-5 text-center">
  <div class="container">
    <h2 class="fw-bold mb-3">FAQs</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-col-1-1" aria-expanded="false" aria-controls="flush-collapseOne">
                Apa itu PSG (Program Sekolah Gratis) ?
              </button>
            </h2>
            <div id="flush-collapse-col-1-1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body text-start">
                PSG atau Program sekolah gratis adalah program pemerintah untuk mewajibkan masyarakat khususnya provinsi Banten mendapatkan pendidikan secara gratis
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-col-1-2" aria-expanded="false" aria-controls="flush-collapseOne">
                Apakah harus wajib menggunakan KTP Banten ?
              </button>
            </h2>
            <div id="flush-collapse-col-1-2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body text-start">
                Ya, peserta didik yang ingin mendapatkan manfaat program sekolah gratis wajib mendaftarkan dirinya menggunakan identitas sebagai warga provinsi Banten
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-col-1-3" aria-expanded="false" aria-controls="flush-collapseOne">
                Apakah ada biaya pendaftaran ?
              </button>
            </h2>
            <div id="flush-collapse-col-1-3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body text-start">
                Tidak, peserta didik tidak membayar biaya masuk, namun peserta didik melakukan deposit tabungan wajib sebesar Rp. 500.000,-. Deposit tersebut akan dapat diambil sampai peserta didik menyelesaikan pendidikan selama 3 tahun.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-col-2-1" aria-expanded="false" aria-controls="flush-collapseOne">
                Apa akreditasi SMK Nusantara 1 ?
              </button>
            </h2>
            <div id="flush-collapse-col-2-1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                Akreditasi SMK Nusantara 1 Kota Tangerang adalah A (Unggul)
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-col-2-2" aria-expanded="false" aria-controls="flush-collapseOne">
                Ada apa saja jurusan yang ada di sekolah ini ?
              </button>
            </h2>
            <div id="flush-collapse-col-2-1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                Jurusan yang ada di SMK Nusantara 1 Kota Tangerang adalah Manajemen Perkantoran (MP), Akuntansi (AK), Animasi (AN), Broadcasting dan Perfilman (BP), Desain Komunikasi Visual (DKV), Teknik Jaringan Komputer dan Telekomunikasi (TJKT) dan Pengembangan Perangkat Lunak dan Gim (PPLG)
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="py-4">
  <div class="container text-center">
    <p class="mb-1 fw-bold">SMK Nusantara 1 Kota Tangerang</p>
    <p class="mb-1">Jalan Cisadane VII - VIII Perumnas 1, Jl. Cisadane V, RT.003/RW.002, Nusa Jaya, Kec. Karawaci, Kota Tangerang, Banten 15116</p>
    <!-- <p class="mb-1">📞 08xxxxxxxxxx | ✉️ info@sekolah.ac.id</p> -->
    <p class="mb-1">✉️Email : smknusantara1@gmail.com</p>
    <small>&copy; 2026 Tim - SPMB Online. All Rights Reserved.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

  window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach(section => {
      const sectionTop = section.offsetTop - 150;
      const sectionHeight = section.offsetHeight;

      if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
        current = section.getAttribute("id");
      }
    });

    navLinks.forEach(link => {
      link.classList.remove("active");
      link.classList.remove("fw-bold");
      if (link.getAttribute("href") === `#${current}`) {
        link.classList.add("active");
        link.classList.add("fw-bold");
      }
    });
  });
</script>

</body>
</html>
