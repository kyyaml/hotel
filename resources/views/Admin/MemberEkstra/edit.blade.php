@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    

                    <div class="card-body">
                        <div class="card-title">
                            Detail Member
                        </div>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>NIS</td>
                                    <td>:</td>
                                    <td>{{ $member_ekstra->siswa->nis }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $member_ekstra->siswa->nama }}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>    
        </div>    
    </div>    
@endsection