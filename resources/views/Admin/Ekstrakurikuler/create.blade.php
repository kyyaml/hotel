@extends('layouts.admin')

@section('header')
  <a class="nav-link fs-4 text-primary	 d-none d-lg-block" href="{{ route('ekstrakurikuler.index') }}">Data Ekstrakurikuler</a>
  <span class="nav-link fs-4 mx-2   d-none d-lg-block">/</span>
  <a href="#" class="nav-link fs-4 d-none d-lg-block">Tambah Ekstrakurikuler</a>
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Ekstrakurikuler  </h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('ekstrakurikuler.store') }}" method="POST">
                          @csrf

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Ekstrakurikuler</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Pelatih</label>
                                <select  name="id_pelatih" required class="form-select">
                                    <option value="" disabled selected> <--   Pilih pelatih   --> </option>
                                    @foreach ($pelatih as $pelatihs)
                                        <option value="{{ $pelatihs->id_pelatih }}">{{ $pelatihs->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
  </div>
</div>
@endsection
