<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikuler= Ekstrakurikuler::all();

        return view('Admin.Ekstrakurikuler.index', ['ekstrakurikuler'=>$ekstrakurikuler]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelatih=Pelatih::WhereNotIn('role',['kesiswaan'])->get();

        return view('Admin.Ekstrakurikuler.create', ['pelatih'=>$pelatih]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama' => ['required'],
            'id_pelatih' =>['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
       
        $ekstrakurikuler = Ekstrakurikuler::create([
            'nama'=> $data['nama'],
            'id_pelatih'=> $data['id_pelatih'],
        ]);

        if ($ekstrakurikuler) {
            return redirect()->route('ekstrakurikuler.index')->with(['ekstrakurikuler' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['ekstrakurikuler' => 'Gagal terkirim!', 'type' => 'danger']);
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
    public function edit($id_ekstra)
    {
        $ekstrakurikuler = Ekstrakurikuler::where('id_ekstra',$id_ekstra)->first();
        $pelatih = Pelatih::whereNotIn('role', ['kesiswaan'])->get(); 

        return view('Admin.Ekstrakurikuler.edit',['ekstrakurikuler'=>$ekstrakurikuler,'pelatih'=>$pelatih]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_ekstra)
    {
        $data = $request->all();

        $ekstrakurikuler = Ekstrakurikuler::find($id_ekstra);

        $ekstrakurikuler->update([
            'nama' => $data['nama'],
            'id_pelatih' => $data['id_pelatih'],
        ]);

        return redirect()->route('ekstrakurikuler.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_ekstra)
    {
        $ekstrakurikuler=Ekstrakurikuler::findOrFail($id_ekstra);

        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index');

    }
}
