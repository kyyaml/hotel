@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        {{-- <a href="#" class="btn btn-danger mb-3 mx-3"><img
            src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg" alt="" width="25"
            height="25" />
        <br />
        Cetak Pdf</a> --}}
        @if (isset($start) && isset($end))
            <a href="{{ route('laporanPelatih.exportAbsen', ['id_ekstra' => $id_ekstra, 'start' => $start, 'end' => $end]) }}"
                class="btn btn-success mb-3"><img
                    src="https://upload.wikimedia.org/wikipedia/commons/3/34/Microsoft_Office_Excel_%282019%E2%80%93present%29.svg"
                    alt="" width="25" height="25" /><br />
                Cetak Excel</a>
        @endif
        <div class="row">
            <div class="col-12 col-lg-6 col-md-6 mb-3">
                <form action="{{ route('laporanPelatih.cariAbsen') }}" method="GET">
                    <div class="input-daterange input-group" id="date-range">
                        <input type="hidden" name="id_ekstra" value="{{ $id_ekstra }}">
                        <input type="date" class="form-control bg-white" name="start"
                            value="{{ isset($start) ? $start : '' }}" />
                        <span class="input-group-text bg-primary b-0 text-white">TO</span>
                        <input type="date" class="form-control bg-white" name="end"
                            value="{{ isset($end) ? $end : '' }}" />
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Data Absen</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Jumlah Hadir</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Jumlah Pertemuan</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($siswa) && isset($jumlahKehadiran) && isset($jumlahPertemuan))
                                        @forelse($siswa as $index => $student)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $index + 1 }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $student->nama }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                        {{ isset($jumlahKehadiran[$student->nama]) ? $jumlahKehadiran[$student->nama] : 0 }}
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $jumlahPertemuan }}</p>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada Absen ditemukan</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Silakan cari data Absen sesuai
                                                tanggal</td>
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
