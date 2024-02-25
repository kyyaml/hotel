@extends('layouts.user')

@section('content')
<div class="row justify-content-between align-items-center py-5 mb-lg-5 mb-md-5">
    <div class="col-lg-6">
        <div class="text-center text-lg-start">
            <h1 class="text-muted mb-5 pb-2 fs-23 lh-xl aos-init aos-animate" data-aos="fade-up" data-aos-delay="200"
                data-aos-duration="1000">"Kesuksesan bukanlah kunci kebahagiaan. Kebahagiaan adalah kunci kesuksesan. Jika Anda mencintai apa yang Anda lakukan, Anda akan sukses."</h1>

            {{-- <p class="fs-6 text-muted mb-4 pb-3 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">Embed powerful financial features into your product, Launch in weeks.
    </p> --}}

            <div class="d-block d-sm-flex align-items-center justify-content-center justify-content-lg-start aos-init aos-animate"
                data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                <div class="me-0 me-sm-3 mb-2 mb-sm-0">
                    <a href="#absen">
                    <button class="btn btn-primary start-btn text-white">Absen Sekarang <i
                            class="ms-1 fas fa-chevron-right fs-2 fw-bold"></i></button>
                        </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-5">
        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjdQKO3PbZbXODNhAZDC97HKZ1HeeDj0S-La4PQ92TE9asTtcppGl7iRrHSsyIc_fSqSbUVEqrd678feYzpp_wMMN2wVJmzJFV-cHjXmcicLEGRVmWwTx_8bPL-1yheyH2KH8iWXAYRGaFts_puRw_BZd40_IkDuf1_emidz7vCrIo1hEb76v4uLabhA1hM/s578/3133066_37219-removebg-preview.png"
            class="card-img-top mt-lg-0 mt-3 mb-lg-5" alt="">
    </div>
</div>

<div class="row" id="absen">
    @foreach ($ekstrakurikuler as $v)
        <div class="col-12 col-md-6 col-lg-4 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title fw-semibold  ">Ekstrakurikuler</h4>
                    <h4 class="fw-semibold card-subtitle mb-3  ">{{ $v->nama }}</h4>
                    <p class="card-text">Silahkan Absen Pada: </p>
                    <a href="{{ route('show.absen', $v->id_ekstra) }}" class="btn btn-warning"> Lihat Absen</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
