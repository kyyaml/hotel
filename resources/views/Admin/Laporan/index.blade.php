@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach ($ekstrakurikuler as $v)
            <div class="col-12 col-md-6 col-lg-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title fw-semibold  ">Ekstrakurikuler</h4>
                        <h4 class="fw-semibold card-subtitle mb-3  ">{{ $v->nama }}</h4>
                        <p class="card-text">Silahkan Buat Laporan Pada:</p>
                        <a href="{{ route('laporan.pilih' ,$v->id_ekstra) }}" class="btn btn-warning"> Buat Laporan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
