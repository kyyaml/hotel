@extends('layouts.admin')


@section('title', 'Ekstrakurikuler')

@section('header')
    <a href="#" class="nav-link fs-4 d-none d-lg-block">Data Ekstrakurikuler</a>
@endsection 

@section('content')
    <div class="container-fluid">
        <a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-primary mb-3">Tambah Ekstrakurikuler</a>
        <div class="row">
            <div class="col-12 col-lg-4 col-md-5 ">
                <form action="#" method="GET">
                    <div class="input-group mb-3">
                        <input type="search" name="query" placeholder="cari nama ekstra..." id="form1" class="form-control"/>
                        <button type="submit" class="btn btn-primary">Cari</button>
                      </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex align-items-stretch ">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Data Ekstrakurikuler</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Id</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama Ekstrakurikuler</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Pelatih</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Detail</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ekstrakurikuler as $k => $v)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $k += 1 }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $v->nama }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $v->pelatih->nama }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="{{ route('ekstrakurikuler.edit', $v->id_ekstra) }}" class="text-muted"><u><p class="mb-0 fw-normal ">Lihat</p></u></a>                           
                                            </td>
                                        </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
