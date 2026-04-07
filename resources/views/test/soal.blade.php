<!DOCTYPE html>
<html>
    <head>
        <title>Ujian</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <div class="container mt-4">

            <!-- TIMER -->
            <div class="d-flex justify-content-between mb-3">
                <h5>Soal No: {{ $nomor }}</h5>
                <h5>Sisa Waktu: <span id="timer">60:00</span></h5>
            </div>

            <!-- SOAL -->
            <div class="card">
                <div class="card-body">
                    <p>{{ $soal->soal->pertanyaan }}</p>

                    <form id="formJawaban">
                        <input type="hidden" id="id_siswa" value="{{ $soal->id_siswa }}">
                        <input type="hidden" id="id_soal" value="{{ $soal->id_soal }}">
                        <input type="hidden" id="urutan" value="{{ $soal->urutan }}">
                        <input type="hidden" id="tahap" value="{{ $soal->tahap }}">

                        @foreach(['a','b','c','d','e'] as $opt)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban" value="{{ strtoupper($opt) }}">
                            <label class="form-check-label">
                                {{ $soal->soal->{'jawaban_'.$opt} }}
                            </label>
                        </div>
                        @endforeach

                        <button type="button" onclick="simpanJawaban()" class="btn btn-primary mt-3">
                            Next
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <script>
            function simpanJawaban() {
                let jawaban = document.querySelector('input[name="jawaban"]:checked');

                if (!jawaban) {
                    alert('Pilih jawaban dulu!');
                    return;
                }

                fetch('/ujian/simpan_jawaban', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id_siswa: document.getElementById('id_siswa').value,
                        id_soal: document.getElementById('id_soal').value,
                        jawaban: jawaban.value,
                        urutan: document.getElementById('urutan').value,
                        tahap: document.getElementById('tahap').value
                    })
                })
                .then(res => res.json())
                .then(() => {
                    location.reload();
                });
            }
        </script>

        <!-- TIMER 60 MENIT -->
        <script>
            let totalDetik = 60 * 60;

            function startTimer() {
                let menit = Math.floor(totalDetik / 60);
                let detik = totalDetik % 60;

                document.getElementById('timer').innerText =
                    `${menit}:${detik < 10 ? '0'+detik : detik}`;

                totalDetik--;

                if (totalDetik < 0) {
                    alert('Waktu habis!');
                    location.reload();
                }
            }

            setInterval(startTimer, 1000);
        </script>

    </body>
</html>