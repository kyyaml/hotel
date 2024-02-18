@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <a href="#" class="btn btn-danger mb-3 mx-3"><img
                src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="" width="25"
                height="25" />
            <br />
            Cetak Pdf</a>
        <a href="#" class="btn btn-success mb-3"><img
                src="https://upload.wikimedia.org/wikipedia/commons/3/34/Microsoft_Office_Excel_%282019%E2%80%93present%29.svg"
                alt="" width="25" height="25" /><br />
            Cetak Excel</a>
        <div class="row">
            <div class="col-12 col-lg-6 col-md-6 mb-3">
                <form action="{{ route('laporan.cariKegiatan',$id_ekstra) }}" method="GET">
                    <div class="input-daterange input-group" id="date-range">
                        <input type="hidden" name="id_ekstra" value="{{ $id_ekstra }}">
                        <input type="date" class="form-control bg-white" name="start" />
                        <span class="input-group-text bg-primary b-0 text-white">TO</span>
                        <input type="date" class="form-control bg-white" name="end" />
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Data Kegiatan</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Judul Pertemuan</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Kegiatan</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($pertemuan))
                                        @forelse($pertemuan as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->kegiatan }}</td>
                                                <td>{{ $item->created_at->format('d-M-Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada pertemuan ditemukan</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Silakan cari data pertemuan sesuai tanggal</td>
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
