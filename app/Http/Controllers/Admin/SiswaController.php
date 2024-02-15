<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();

        return view('Admin.Siswa.index',['siswa'=>$siswa]);
    }


    public function searchSiswa(Request $request)
    {
        $searchQuery = $request->input('searchQuery');
        $siswa = Siswa::where('nama', 'like', "%$searchQuery%")->get();
    

        return view('Admin.Siswa.search', ['siswa'=>$siswa]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data,[
            'nis' => 'required|unique:siswa',
            'nama' => 'required',
            'username' => 'required|unique:siswa|min:5',
            'password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        Siswa::create([
            'nis' => $data['nis'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),      
        ]);

        return redirect()->route('siswa.index');    

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
    public function edit($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        return view('Admin.Siswa.edit', ['siswa' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$nis)
    {
        $data=$request->all();

        $siswa=Siswa::find($nis);  

        $validate = Validator::make($data,[
            'nis' => 'required|unique:siswa,nis,' . $nis. ',nis',
            'nama' => 'required',
            'username' => 'required|min:5|unique:siswa,username,' . $nis . ',nis',
            'password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        $siswa->update([
            'nis' => $data['nis'],
            'nama' => $data['nama'],
            'username'=> $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('siswa.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nis)
    {
        $siswa = Siswa::findOrFail($nis);

        $siswa->delete();

        return redirect()->route('siswa.index'); 
    }
}
