<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\MemberEkstra;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberEkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikuler = Ekstrakurikuler::all();
        return view('Admin.MemberEkstra.index', ['ekstrakurikuler' => $ekstrakurikuler]);
    }


    public function searchDaftarSiswa(Request $request)
    {
      $id_ekstra = $request->id_ekstra;
      $search = $request->search;
    
      $ekstrakurikuler = Ekstrakurikuler::findOrFail($id_ekstra);
    
      $siswa = Siswa::whereDoesntHave('ekstrakurikuler', function ($query) use ($id_ekstra) {
        $query->where('ekstrakurikuler.id_ekstra', $id_ekstra);
      })->where('nama', 'like', "%$search%")->get();
    
      return view('Admin.MemberEkstra.create', ['ekstrakurikuler' => $ekstrakurikuler, 'id_ekstra' => $id_ekstra, 'siswa' => $siswa]);
    }

    public function searchMember(Request $request, $id_ekstra)
  {
    $query = $request->get('searchMember');

    $ekstrakurikuler = Ekstrakurikuler::findOrFail($id_ekstra);

    $siswa = $ekstrakurikuler->siswa()->where('nama', 'like', '%' . $query . '%')->get();

    return view('Admin.MemberEkstra.showMember', ['ekstrakurikuler' => $ekstrakurikuler, 'siswa' => $siswa]);
  }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id_ekstra)
    {
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id_ekstra);
        $siswa = Siswa::whereDoesntHave('ekstrakurikuler', function ($query) use ($id_ekstra) {
            $query->where('ekstrakurikuler.id_ekstra', $id_ekstra);
        })->get();

        return view('Admin.MemberEkstra.create', ['ekstrakurikuler' => $ekstrakurikuler, 'id_ekstra' => $id_ekstra, 'siswa' => $siswa]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validate = Validator::make($data, [
            'id_ekstra' => 'required',
            'nis' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $member_ekstra = MemberEkstra::create([
            'id_ekstra' => $data['id_ekstra'],
            'nis' => $data['nis'],
        ]);

        $id_ekstra = $request->input('id_ekstra');

        if ($member_ekstra) {
            return redirect()->route('member-ekstra.show', $id_ekstra)->with(['member_ekstra' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['member_ekstra' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */

    public function showMember($id_ekstra){
        
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id_ekstra);
        $siswa = $ekstrakurikuler->siswa;

        return view('Admin.MemberEkstra.showMember', ['ekstrakurikuler' => $ekstrakurikuler,  'siswa' => $siswa]);
    } 
    

    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


public function destroyData($nis, $id_ekstra)
{
    // Temukan siswa berdasarkan NIS
    $siswa = Siswa::where('nis', $nis)->first();

    if (!$siswa) {
        return redirect()->back()->with(['message' => 'Siswa tidak ditemukan.', 'type' => 'error']);
    }

    // Hapus anggota ekstrakurikuler dari ekstrakurikuler yang sesuai dengan ID yang diterima
    $siswa->memberEkstra()->where('id_ekstra', $id_ekstra)->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with(['message' => 'Anggota ekstrakurikuler berhasil dihapus dari ekstrakurikuler yang sesuai.', 'type' => 'success']);
}

}
