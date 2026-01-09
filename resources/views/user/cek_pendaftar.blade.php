<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

        <style>
            p, table {
                font-family: "Raleway", sans-serif;
            }

            h5 {
              font-family: "Raleway", sans-serif;
              font-weight: bold;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <div class="card m-4 shadow" style="margin-left: 20% !important; margin-right: 20% !important;">
                <div class="card-body">
                  <h5 class="pt-2 pb-2">Informasi Data Pendaftar SMK Nusantara 1 Kota Tangerang</h5>
                    <table class="table table-striped table-borderless">
                        <tbody>
                            <tr>
                                <th style="width:25%">Nama</th>
                                <td>: {{ $registrasi->nama_siswa }}</td>
                            </tr>
                            <tr>
                                <th>NISN</th>
                                <td>: {{ $registrasi->nisn }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>: {{ $registrasi->nik }}</td>
                            </tr>
                            <tr>
                                <th>Pilihan Pertama</th>
                                <td>: {{ $registrasi->jurusan_pertama }}</td>
                            </tr>
                            <tr>
                                <th>Pilihan Kedua</th>
                                <td>: {{ $registrasi->jurusan_kedua }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    :
                                    <span class="badge bg-info">
                                        {{ $registrasi->status }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                      <div class="col-sm-2 text-center">
                        <img src="https://img.icons8.com/?size=80&id=kktvCbkDLbNb&format=png&color=000000">
                      </div>
                      <div class="col-sm-10">
                        <p>Data ini merupakan data pendaftar yang telah masuk ke dalam basis data sistem penerimaan siswa baru SMK Nusantara 1 Kota Tangerang.</p>

                      </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    </body>
</html>
