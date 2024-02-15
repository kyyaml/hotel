<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatih = Pelatih::WhereNotIn('role',['kesiswaan'])->get();

        return view('Admin.Pelatih.index', ['pelatih'=>$pelatih]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function searchPelatih(Request $request){
        $query = $request->input('searchPelatih');

        $pelatih = Pelatih::where('nama', 'like', "%$query%")
        ->whereNotIn('role', ['kesiswaan'])
        ->get();

        return view('Admin.Pelatih.index', ['pelatih'=>$pelatih]);
    }

    public function create()
    {
        return view('Admin.Pelatih.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nama' =>'required',
            'username' => 'required|unique:pelatih|min:5',
            'password' => 'required|min:6',
            'jenis_pelatih' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $pelatih = Pelatih::create([
            'nama' => $data['nama'],
            'username' => $data ['username'],
            'password' => Hash::make($data['password']),
            'jenis_pelatih' => $data['jenis_pelatih'],
            'role' => 'pelatih'
        ]);

        if ($pelatih) {
            return redirect()->route('pelatih.index')->with(['pelatih' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pelatih' => 'Gagal terkirim!', 'type' => 'danger']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_pelatih)
    {
        $pelatih = Pelatih::where('id_pelatih', $id_pelatih)->first();

        if($pelatih->role ==='kesiswaan'){
            return redirect()->route('pelatih.index');
        }


        return view('Admin.Pelatih.edit', ['pelatih' => $pelatih]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_pelatih)
    {

        $pelatih = Pelatih::find($id_pelatih);

        $data = $request->all();

        $validate = Validator::make($data, [
            'nama' =>'required',
            'username' => 'required|string|unique:pelatih,username,' . $id_pelatih . ',id_pelatih',
            'password' => 'required|min:6',
            'jenis_pelatih' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }


        $pelatih->update([
            'nama' => $data['nama'],
            'username'=>$data['username'],
            'password'=>Hash::make($data['password']),
            'jenis_pelatih' =>$data['jenis_pelatih'],
        ]);

        return redirect()->route('pelatih.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id_pelatih)
    {
       $pelatih=Pelatih::findOrFail($id_pelatih);

       $pelatih->delete();

       return redirect()->route('pelatih.index');
    }
}
