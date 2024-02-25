@extends('layouts.admin')

@section('header')
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Dashboard</a>
@endsection


@section('content')
    <div class="row">


        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active">
                <div class="item">
                    <div
                        class="card border-0 zoom-in {{ $validasi === 0 ? 'bg-success-subtle' : 'bg-danger-subtle' }} shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                @if ($validasi !== 0)
                                    <img src="https://cdn-icons-png.flaticon.com/512/5442/5442020.png" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-danger mb-1">Presensi Belum Tervalidasi</p>
                                    <h5 class="fw-semibold text-danger mb-0">{{ $validasi }}</h5>
                                @endif
                                @if ($validasi === 0)
                                    <img src="https://cdn-icons-png.flaticon.com/512/8215/8215539.png" width="50"
                                        height="50" class="mb-3" alt="">
                                    <p class="fw-semibold fs-3 text-secondary    mb-4">Semua Presensi Tervalidasi</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active">
                <div class="item">
                    <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('assets/admin/images/logos/pertemuan.svg') }}" width="50"
                            height="50" class="mb-3" alt="">
                        
                                <p class="fw-semibold fs-3 text-primary mb-1">Pertemuan</p>
                                <h5 class="fw-semibold text-primary mb-0">{{ $pertemuan }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active">
                <div class="item">
                    <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/143/143438.png" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-primary mb-1">Anggota</p>
                                <h5 class="fw-semibold text-primary mb-0">{{ $member }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
