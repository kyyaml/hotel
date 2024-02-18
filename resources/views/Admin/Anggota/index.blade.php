@extends('layouts.admin')


@section('title', 'Ekstrakurikuler')

@section('header')
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Data Member Ekstrakurikuler</a>
@endsection

@section('content')
    <div class="container-fluid ">

        <a href="{{ route('anggota.create') }}" class="btn btn-primary mb-3">Tambah Member </a>

        <div class="row">
            <div class="col-12 col-lg-4 col-md-5 ">
                <form action="{{ route('anggota.searchAnggota') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" name="searchAnggota" placeholder="cari nama siswa.." id="form1"
                            class="form-control bg-white  " />
                        <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    @if (session('success'))
        <div class="row">
            <div class="co-12 col-lg-6">
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
                    <h5 class="card-title fw-semibold mb-4">Tabel Member Ekstrakurikuler {{ $ekstrakurikuler->nama }}</h5>
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
                            <tbody>
                                @if (count($siswa) > 0)
                                    @foreach ($siswa as $k => $v)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $k += 1 }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $v->nis }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $v->nama }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <form action="{{ route('anggota.destroyAnggota', ['nis' => $v->nis, 'id_ekstra' => $id_ekstra]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">
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
