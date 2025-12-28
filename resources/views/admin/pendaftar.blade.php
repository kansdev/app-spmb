@extends('layouts.main')

@section('content')

    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card mb-4">
        <div class="card-header pt-2 pb-2">
            <h5>Jumlah Jurusan Yang Sudah Terdaftar</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <tr>
                    @foreach ($jurusan as $j)
                        @if ($j->total > 36)
                            <th style="color: red">{{ $j->jurusan_pertama }} : {{ $j->total }}</th>   
                        @else
                            <th>{{ $j->jurusan_pertama }} : {{ $j->total }}</th>   
                        @endif
                    @endforeach
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Data Calon Pendaftar</h5>
        </div>
        <div class="card-body">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Jurusan Utama Akuntansi
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-border table-striped w-100" id="ak">
                                    <thead>
                                        <tr>
                                            <th>No Pendaftaran</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Skor Raport</th>
                                            <th>Jurusan 1</th>
                                            <th>Jurusan 2</th>
                                            <th>Berkas</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($pendaftar_ak as $cp)
                                            <tr>
                                                <td>{{ $cp->nomor_pendaftaran}}</td>
                                                <td>{{ $cp->nama_siswa }}</td>
                                                <td>{{ $cp->nik }}</td>
                                                <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                                <td>{{ $cp->jurusan_pertama }}</td>
                                                <td>{{ $cp->jurusan_kedua }}</td>
                                                <td>
                                                    <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                                        Lihat Berkas
                                                    </a>
                                                </td>
                                                @if ($cp->status == 'Belum Terverifikasi')
                                                    <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                                @elseif($cp->status == 'Terverifikasi')
                                                    <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                                @else
                                                    <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Jurusan Utama Manajemen Perkantoran
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table-responsive">
                              <table class="table table-border table-striped w-100" id="mp">
                                  <thead>
                                      <tr>
                                          <th>No Pendaftaran</th>
                                          <th>Nama</th>
                                          <th>NIK</th>
                                          <th>Skor Raport</th>
                                          <th>Jurusan 1</th>
                                          <th>Jurusan 2</th>
                                          <th>Berkas</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      @foreach ($pendaftar_mp as $cp)
                                          <tr>
                                              <td>{{ $cp->nomor_pendaftaran}}</td>
                                              <td>{{ $cp->nama_siswa }}</td>
                                              <td>{{ $cp->nik }}</td>
                                              <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                              <td>{{ $cp->jurusan_pertama }}</td>
                                              <td>{{ $cp->jurusan_kedua }}</td>
                                              <td>
                                                  <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                                      Lihat Berkas
                                                  </a>
                                              </td>
                                              @if ($cp->status == 'Belum Terverifikasi')
                                                  <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                              @elseif($cp->status == 'Terverifikasi')
                                                  <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                              @else
                                                  <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                              @endif
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        Jurusan Utama Animasi
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table-responsive">
                              <table class="table table-border table-striped w-100" id="an">
                                  <thead>
                                      <tr>
                                          <th>No Pendaftaran</th>
                                          <th>Nama</th>
                                          <th>NIK</th>
                                          <th>Skor Raport</th>
                                          <th>Jurusan 1</th>
                                          <th>Jurusan 2</th>
                                          <th>Berkas</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      @foreach ($calon_pendaftar as $cp)
                                          <tr>
                                              <td>{{ $cp->nomor_pendaftaran}}</td>
                                              <td>{{ $cp->nama_siswa }}</td>
                                              <td>{{ $cp->nik }}</td>
                                              <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                              <td>{{ $cp->jurusan_pertama }}</td>
                                              <td>{{ $cp->jurusan_kedua }}</td>
                                              <td>
                                                  <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                                      Lihat Berkas
                                                  </a>
                                              </td>
                                              @if ($cp->status == 'Belum Terverifikasi')
                                                  <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                              @elseif($cp->status == 'Terverifikasi')
                                                  <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                              @else
                                                  <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                              @endif
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        Jurusan Utama Teknik Jaringan Komputer dan Telekomunikasi
                      </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table-responsive">
                              <table class="table table-border table-striped w-100" id="tjkt">
                                  <thead>
                                      <tr>
                                          <th>No Pendaftaran</th>
                                          <th>Nama</th>
                                          <th>NIK</th>
                                          <th>Skor Raport</th>
                                          <th>Jurusan 1</th>
                                          <th>Jurusan 2</th>
                                          <th>Berkas</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      @foreach ($pendaftar_tjkt as $cp)
                                          <tr>
                                              <td>{{ $cp->nomor_pendaftaran}}</td>
                                              <td>{{ $cp->nama_siswa }}</td>
                                              <td>{{ $cp->nik }}</td>
                                              <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                              <td>{{ $cp->jurusan_pertama }}</td>
                                              <td>{{ $cp->jurusan_kedua }}</td>
                                              <td>
                                                  <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                                      Lihat Berkas
                                                  </a>
                                              </td>
                                              @if ($cp->status == 'Belum Terverifikasi')
                                                  <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                              @elseif($cp->status == 'Terverifikasi')
                                                  <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                              @else
                                                  <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                              @endif
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        Jurusan Utama Desain Komunikasi Visual
                      </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table-responsive">
                              <table class="table table-border table-striped w-100" id="dkv">
                                  <thead>
                                      <tr>
                                          <th>No Pendaftaran</th>
                                          <th>Nama</th>
                                          <th>NIK</th>
                                          <th>Skor Raport</th>
                                          <th>Jurusan 1</th>
                                          <th>Jurusan 2</th>
                                          <th>Berkas</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      @foreach ($pendaftar_dkv as $cp)
                                          <tr>
                                              <td>{{ $cp->nomor_pendaftaran}}</td>
                                              <td>{{ $cp->nama_siswa }}</td>
                                              <td>{{ $cp->nik }}</td>
                                              <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                              <td>{{ $cp->jurusan_pertama }}</td>
                                              <td>{{ $cp->jurusan_kedua }}</td>
                                              <td>
                                                  <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                                      Lihat Berkas
                                                  </a>
                                              </td>
                                              @if ($cp->status == 'Belum Terverifikasi')
                                                  <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                              @elseif($cp->status == 'Terverifikasi')
                                                  <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                              @else
                                                  <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                              @endif
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        Jurusan Utama Pengembangan Perangkat Lunak dan Gim
                      </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table-responsive">
                              <table class="table table-border table-striped w-100" id="pplg">
                                  <thead>
                                      <tr>
                                          <th>No Pendaftaran</th>
                                          <th>Nama</th>
                                          <th>NIK</th>
                                          <th>Skor Raport</th>
                                          <th>Jurusan 1</th>
                                          <th>Jurusan 2</th>
                                          <th>Berkas</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      @foreach ($pendaftar_pplg as $cp)
                                          <tr>
                                              <td>{{ $cp->nomor_pendaftaran}}</td>
                                              <td>{{ $cp->nama_siswa }}</td>
                                              <td>{{ $cp->nik }}</td>
                                              <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                              <td>{{ $cp->jurusan_pertama }}</td>
                                              <td>{{ $cp->jurusan_kedua }}</td>
                                              <td>
                                                  <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                                      Lihat Berkas
                                                  </a>
                                              </td>
                                              @if ($cp->status == 'Belum Terverifikasi')
                                                  <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                              @elseif($cp->status == 'Terverifikasi')
                                                  <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                              @else
                                                  <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                              @endif
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                        Jurusan Utama Broadcasting dan Perfilman
                      </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table-responsive">
                              <table class="table table-border table-striped w-100" id="bp">
                                  <thead>
                                      <tr>
                                          <th>No Pendaftaran</th>
                                          <th>Nama</th>
                                          <th>NIK</th>
                                          <th>Skor Raport</th>
                                          <th>Jurusan 1</th>
                                          <th>Jurusan 2</th>
                                          <th>Berkas</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      @foreach ($pendaftar_bp as $cp)
                                          <tr>
                                              <td>{{ $cp->nomor_pendaftaran}}</td>
                                              <td>{{ $cp->nama_siswa }}</td>
                                              <td>{{ $cp->nik }}</td>
                                              <td>{{ optional($cp->user->nilai_raport)->skor}}</td>
                                              <td>{{ $cp->jurusan_pertama }}</td>
                                              <td>{{ $cp->jurusan_kedua }}</td>
                                              <td>
                                                  <a href="#" class="badge bg-label-success" data-bs-toggle="modal" data-bs-target="#berkasModal_{{ $cp->user_id }}">
                                                      Lihat Berkas
                                                  </a>
                                              </td>
                                              @if ($cp->status == 'Belum Terverifikasi')
                                                  <td><span class="badge bg-label-warning">{{ $cp->status }}</span></td>
                                              @elseif($cp->status == 'Terverifikasi')
                                                  <td><span class="badge bg-label-success">{{ $cp->status }}</span></td>
                                              @else
                                                  <td><span class="badge bg-label-danger">{{ $cp->status }}</span></td>
                                              @endif
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                    </div>
                </div>
            </div>

            
        </div>        
        
    </div>

        @foreach ($calon_pendaftar as $cp)
            <div class="modal fade" id="verifikasi_{{ $cp->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi verifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin memverfikasi pendaftar ini ?
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</a>
                            <a href="{{ route('admin.ditolak', $cp->id) }}" class="btn btn-danger btn-md">Tolak Verifikasi</a>
                            <a href="{{ route('admin.verifikasi', $cp->id) }}" class="btn btn-primary btn-md">Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($calon_pendaftar as $cp)
            <div class="modal fade" id="berkasModal_{{ $cp->user_id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                @foreach ($berkas as $b)
                                    <tr>
                                        <th>{{ str_replace('_', ' ', $b->type) }}</th>
                                        <td>
                                            <div class="d-grid gap-2">
                                                <a href="{{ asset('storage/' . $b->file_path) }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm btn-block mt-1">
                                                    Lihat
                                                </a>
                                            </div>
                                        </td>
                                    </tr>              
                                @endforeach
                            </table>
                        </div>  
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Batal</a>
                            <a href="{{ route('admin.ditolak', $cp->id) }}" class="btn btn-danger btn-md">Tolak Verifikasi</a>
                            <a href="{{ route('admin.verifikasi', $cp->id) }}" class="btn btn-primary btn-md">Verifikasi</a>
                        </div>              
                    </div>
                </div>
            </div>  
        @endforeach

@endsection
