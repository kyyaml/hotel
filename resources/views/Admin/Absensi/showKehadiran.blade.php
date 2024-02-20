@extends('layouts.admin')


@section('title', 'Ekstrakurikuler')

@section('header')
    <a href="{{ route('absensi.index') }}" class="nav-link text-primary fs-4 d-none d-lg-block">Data Pertemuan</a>
    <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Data Kehadiran</a>
@endsection

@section('content')
    <div class="container-fluid ">

        <a href="{{ route('absensiSiswa', ['id_pertemuan' => $id_pertemuan]) }}" class="btn btn-warning mb-3">Siswa Belum
            Absen</a>

        <div class="row">
            <div class="col-12 col-lg-4 col-md-5 ">
                <form action="{{ route('absensi.searchKehadiran', $id_pertemuan) }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" name="search" placeholder="cari nama siswa ..." id="form1"
                            class="form-control bg-white  " />
                        <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>
                    </div>
            </div>
            </form>
        </div>
    </div>



    <div class="row">
        <div class="col-12 d-flex align-items-stretch ">
            <div class="card w-100 ">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-2">Data Kehadiran </h5>
                    <h6 class="card-subtitle fw-light mb-4">NB: siswa akan tampil hanya ketika absen telah diterima atau
                        diabsenkan oleh pelatih</h6>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Id</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">NIS</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nama</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Waktu Absen</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Keterangan</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($presensi) > 0)
                                    @foreach ($presensi as $k => $v)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $k += 1 }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $v->nis }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"> {{ $v->siswa->nama }}</p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $v->formatTime()['time'] }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $v->keterangan }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <p class="mb-0 fw-normal ">Tidak Ada Data</p>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
