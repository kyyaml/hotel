@extends('layouts.user')

@section('content')
    <div class="row pt-7">
        <div class="col-12 col-lg-5 col-md-6 mb-3">
            <form action="#" method="GET">
                <div class="input-daterange input-group" id="date-range">
                    <input type="date" class="form-control bg-white">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex gap-6 mb-3">
                <h5 class="card-title fw-semibold mb-4 col-md-4">Data Pertemuan</h5>
            </div>

            @foreach ($pertemuans as $pertemuan)
                @if ($statusAbsen[$pertemuan->id_pertemuan])
                    <a href="{{ route('presensi.createAbsen', $pertemuan->id_pertemuan) }}">
                            <div class="card mb-3">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <div>
                                    <h5 class="fw-semibold mb-0">{{ $pertemuan->judul_pertemuan }}</h5>
                                    <span class="fs-3 d-flex align-items-center">{{ $pertemuan->kegiatan }}</span>
                                </div>
                                <span class="py-1 px-2 ms-auto badge text-bg-primary">Dibuka</span>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="#" style="cursor: default">
                        <div class="card mb-3">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <div>
                                    <h5 class="fw-semibold mb-0">{{ $pertemuan->judul_pertemuan }}</h5>
                                    <span class="fs-3 d-flex align-items-center">{{ $pertemuan->kegiatan }}</span>
                                </div>
                                <span class="py-1 px-2 ms-auto badge text-bg-danger">Ditutup</span>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
