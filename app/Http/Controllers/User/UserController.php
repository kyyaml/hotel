<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('User.login');
    }

    public function login(request $request){

        $username = Siswa::where('username', $request->username)->first();

        if(!$username){
            return redirect()->back()->with(['pesan'=>'Username tidak terdaftar!']);
        }

        $password = Hash::check($request->password,$username->password);
        
        if (!$password){
            return redirect()->back()->with(['pesan' => 'Passsword tidak sesuai!']);
        }

            $auth = Auth::guard('siswa')->attempt(['username'=>$request->username,'password'=>$request->password]);
            
            if($auth) {
                return redirect()->route('presensi.index');
            }else{
                return redirect()->back()->with(['pesan'=>'Akun tidak terdaftar!']);
            }

    }

    public function logout(){
        Auth::guard('siswa')->logout();
        return redirect()->route('user.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
