<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pertemuan = Pertemuan::latest()->get();

        return view('Admin.Pertemuan.index', ['pertemuan'=>$pertemuan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('Admin.Pertemuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_pertemuan' => 'required',
            'kegiatan' => 'required',
            'tgl_pertemuan' => 'required|date',          
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $id_ekstra = Auth::guard('admin')->user()->ekstrakurikuler->id_ekstra;

        $pertemuan = Pertemuan::create([
            'judul_pertemuan' => $data['judul_pertemuan'],
            'kegiatan' => $data['kegiatan'],
            'tgl_pertemuan' => date_create($data['tgl_pertemuan'])->format('Y-m-d'),
            'id_ekstra' => $id_ekstra,
        ]);

        if ($pertemuan) {
            return redirect()->route('pertemuan.index')->with(['pertemuan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pertemuan' => 'Gagal terkirim!', 'type' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_pertemuan)
    {
        $pertemuan = Pertemuan::where('id_pertemuan',$id_pertemuan)->first();

        return view('Admin.Pertemuan.edit', ['pertemuan'=>$pertemuan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_pertemuan)
    {
        $pertemuan=Pertemuan::find($id_pertemuan);

        $data=$request->all();

        $pertemuan->update([
            'judul_pertemuan' => $data['judul_pertemuan'],
            'kegiatan' => $data['kegiatan'],
            'tgl_pertemuan' => date_create($data['tgl_pertemuan'])->format('Y-m-d'),
        ]);

        return redirect()->route('pertemuan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_pertemuan)
    {
        $pertemuan = Pertemuan::findOrFail($id_pertemuan);

        $pertemuan->delete();

        return redirect()->route('pertemuan.index') ;
    }
}
