@extends('layouts.admin')

@section('header')
    <a class="nav-link fs-4 text-primary d-none d-lg-block" href="{{ route('member-ekstra.index') }}">Member Ekstrakurikuler</a>
    <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
    <a class="nav-link fs-4 text-primary d-none d-lg-block" href="{{ route('member-ekstra.showMember', $ekstrakurikuler->id_ekstra) }}">Data Member Ekstrakurikuler {{ $ekstrakurikuler->nama }}</a>
    <span class="nav-link fs-4 mx-2 d-none d-lg-block">/</span>
    <a href="" class="nav-link fs-4 d-none d-lg-block">Tambah Member Ekstrakurikuler {{ $ekstrakurikuler->nama }}</a>
@endsection


@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-4 col-md-5 ">
                <form action="{{ route('member-ekstra.searchDaftarSiswa',$ekstrakurikuler->id_ekstra) }}" method="GET">
                  <div class="input-group mb-3">
                    <input type="search" name="search" placeholder="cari nama siswa..." id="form1" class="form-control bg-white"/>
                    <button type="submit" class="btn btn-primary">Cari</button>
                  </div>
                </form>
              </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex align-items-stretch ">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Tabel Daftar Ekstra {{ $ekstrakurikuler->nama }}</h5>
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
                                            <h6 class="fw-semibold mb-0">Aksi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="siswaTableBody">


                                    @foreach ($siswa as $k => $v)
                                        <tr>
                                            <td class="border-bottom-0">{{ $k + 1 }}</td>
                                            <td class="border-bottom-0">{{ $v->nis }}</td>
                                            <td class="border-bottom-0">{{ $v->nama }}</td>
                                            <td class="border-bottom-0">
                                                <form method="POST" action="{{ route('member-ekstra.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="id_ekstra"
                                                        value="{{ $ekstrakurikuler->id_ekstra }}">
                                                    <input type="hidden" name="nis" value="{{ $v->nis }}">
                                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if ($siswa->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada hasil yang ditemukan</td>
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
