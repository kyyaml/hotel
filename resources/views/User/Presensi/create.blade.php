@extends('layouts.user')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Presensi Siswa</h5>
                <div class="card">
                    <div class="card-body">
                        @if ($sudahAbsen)
                        
                        @if ($validasi->status === 'proses')
                        <div class="alert alert-warning" role="alert">
                            Anda telah mengirim data, tetapi pelatih belum memvalidasi.
                        </div>
                        @elseif ($validasi->status === 'diterima')
                        <div class="alert alert-success" role="alert">
                            Presensi Anda telah dilihat oleh pelatih dan diterima.
                        </div>
                        @elseif ($validasi->status === 'ditolak')
                        <div class="alert alert-danger" role="alert">
                            Presensi Anda telah dilihat oleh pelatih dan ditolak.
                        </div>
                        
                        @endif
                        @else
                        <form action="{{ route('presensi.storeAbsen', $pertemuan->id_pertemuan) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <h4>{{ $pertemuan->judul_pertemuan }}</h4>
                            </div>
                            <div class="mb-3">
                                <p class="">{{ $pertemuan->kegiatan }}</p>
                            </div>
                            <span class="mb-7 badge badge-sm text-bg-light">{{ $pertemuan->formatTime()['start_time'] }} - {{ $pertemuan->formatTime()['end_time'] }}</span>
                            <input type="hidden" name="keterangan" value="hadir">
                            <button type="submit" class="btn btn-success w-100">Masuk</button>
                        </form>

                        <form action="{{ route('presensi.storeAbsen', $pertemuan->id_pertemuan) }}" method="POST">
                            @csrf
                            <input type="hidden" name="keterangan" value="izin">
                            <button type="submit" class="btn btn-warning mt-2 w-100">Izin</button>
                        </form>
                        <a class="btn btn-danger mt-2 w-100" href="{{ route('show.absen', $pertemuan->id_ekstra) }}">Kembali</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection