@extends('layouts.admin')

@section('content')
<div class="row mt-5">
    <div class="col-lg-6">
      <div class="card text-center ">
        <div class="card-body">
          <h5 class="card-title">Laporan Absen</h5>
          <p class="card-text">
            Untuk Melihat Laporan Absen
          </p>
          <a href="#" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Laporan Kegiatan</h5>
          <p class="card-text">
            Untuk Melihat Laporan  Kegiatan
          </p>
          <a href="{{ route('laporan.kegiatan', $id_ekstra) }}" class="btn btn-primary">Lihat</a>
        </div>
      </div>
    </div>
    </div> 
@endsection