@extends('layouts.admin')


@section('title', 'Ekstrakurikuler')

@section('header')
    <a href="#" class="nav-link fs-4 d-none d-lg-block"> Siswa Belum Absen</a>
@endsection

@section('content')
    <div class="container-fluid ">

        <div class="row">
            <div class="col-12 col-lg-4 col-md-5">
                <form action="{{ route('absensiSiswa', $id_pertemuan) }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" name="search" placeholder="Cari nama siswa ..."
                            class="form-control bg-white" />
                        <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-12 d-flex align-items-stretch ">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-2">Data Siswa Belum Absen </h5>
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
                                            <h6 class="fw-semibold mb-0">Presensi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($siswa) > 0)
                                        @foreach ($siswa as $v)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $v->nis }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $v->nama }}</p>
                                                </td>
                                                <td class="border-bottom-0" style="display: flex">
                                                    <form action="{{ route('absensi.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_pertemuan"
                                                            value="{{ $id_pertemuan }}">
                                                        <input type="hidden" name="nis" value="{{ $v->nis }}">
                                                        <input type="hidden" name="keterangan" value="hadir">
                                                        <button type="submit" class="btn btn-success">Hadir</button>
                                                    </form>
                                                    <form action="{{ route('absensi.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_pertemuan"
                                                            value="{{ $id_pertemuan }}">

                                                        <input type="hidden" name="nis" value="{{ $v->nis }}">
                                                        <input type="hidden" name="keterangan" value="izin">
                                                        <button type="submit" class="btn btn-warning mx-2">Izin</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <p class="mb-0 fw-normal">Tidak Ada Data</p>
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
