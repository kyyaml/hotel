@extends('layouts.admin')

@section('header')
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Data Siswa</a>
@endsection

@section('content')
    <div class="container-fluid">
        <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>

        <div class="row">
            <div class="col-12 col-lg-4  col-md-5 ">
                <div class="mb-3">
                        <div class="input-group">
                            <input type="text" name="searchSiswa" id="searchSiswa" class="form-control"
                                placeholder="Cari Nama Siswa...">
                            <button type="button" class="btn btn-primary"><i class="ti ti-search"></i></button>
                        </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 d-flex align-items-stretch ">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Tabel Siswa</h5>
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
                                            <h6 class="fw-semibold mb-0">Username</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Detail</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="siswaTableBody">

                                    @if (count($siswa) > 0)
                                        @foreach ($siswa as $k => $v)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $k + 1 }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $v->nis }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $v->nama }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $v->username }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="{{ route('siswa.edit',$v->nis) }}" class="text-muted">
                                                        <u>
                                                            <p class="mb-0 fw-normal">Lihat</p>
                                                        </u>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak Ada Data</td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchSiswa').on('input', function() {
                var searchQuery = $(this).val();

                $.ajax({
                    url: '{{ route('siswa.search') }}', // Pastikan URL sesuai dengan rute yang telah ditentukan
                    method: 'GET',
                    data: {
                        'searchQuery': searchQuery
                    },
                    success: function(response) {
                        $('#siswaTableBody').html(response);
                    }
                });
            });
        });
    </script>
@endsection
