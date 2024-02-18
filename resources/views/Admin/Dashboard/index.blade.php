@extends('layouts.admin')

@section('header')
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Dashboard</a>
@endsection


@section('content')

<div class=" text-center mt-2">
    <h4>Selamat Datang {{ Auth::guard('admin')->user()->nama }}</h4>
    <img src="{{ asset('assets/admin/images/logos/dashboard.svg') }}" alt="" style="width: 40%; opacity: 70%">       
</div>

        {{-- <div class="row">


        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active" ">
                <div class="item">
                    <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('assets/admin/images/logos/coachlogo.png') }}" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-info mb-1">Pelatih</p>
                                <h5 class="fw-semibold text-info mb-0">{{$pelatih}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="owl-item active" >
                <div class="item">
                    <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('assets/admin/images/logos/extralogo.png') }}" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-primary mb-1">Ekstra</p>
                                <h5 class="fw-semibold text-primary mb-0">{{$ekstrakurikuler}}</h5>
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
                                <img src="{{ asset('assets/admin/images/logos/siswalogo.png') }}" width="50"
                                    height="50" class="mb-3" alt="">
                                <p class="fw-semibold fs-3 text-primary mb-1">Siswa</p>
                                <h5 class="fw-semibold text-primary mb-0">{{$siswa}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
@endsection
