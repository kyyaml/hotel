@extends('layouts.admin')


@section('title', 'Ekstrakurikuler')

@section('header')
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Validasi Absen Siswa</a>
@endsection

@section('content')
    <div class="container-fluid ">

        <div class="row">
            <div class="col-12 col-lg-4 col-md-5">
                <form action="{{ route('validasiAbsen', $id_pertemuan) }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" name="search" placeholder="Cari nama siswa..." id="search"
                            class="form-control bg-white" />
                        <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>
                    </div>
                </form>
            </div>
        </div>


        @if (session('success'))
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12 d-flex align-items-stretch ">
                <div class="card w-100 ">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Validasi Absen</h5>
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
                                        <th colspan="2" class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Validasi</h6>
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
                                                <td class="border-bottom-0" style="display:flex ">
                                                    <form action="{{ route('validasi.terima', $v->id_absen) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success ">Terima</button>
                                                    </form>
                                                    <form action="{{ route('validasi.tolak', $v->id_absen) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda yakin ingin menolak?')"
                                                            class="btn btn-danger mx-2">Tolak</button>
                                                    </form>
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
