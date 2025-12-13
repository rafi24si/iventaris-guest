<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * Halaman Login
     */
    public function index()
    {
        return view('pages.auth.login-form');
    }

    /**
     * Halaman Register
     */
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        // VALIDASI LOGIN
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:255',
            'password' => 'required|min:3',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email'    => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min'      => 'Password minimal 3 karakter',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //  CEK USER
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar'])->withInput();
        }

        //  CEK PASSWORD
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah'])->withInput();
        }


        //  SIMPAN SESSION LOGIN
        Session::put('login', true);
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_role', $user->role);
        Session::put('user_photo', $user->profile_photo);

        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    /**
     * Proses Register
     */
    public function register(Request $request)
    {
        //  VALIDASI REGISTER
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|max:255',
            'email'                 => 'required|email|max:255|unique:users,email',
            'role'                  => 'required|in:admin,petugas,user',
            'password'              => 'required|min:3|confirmed',
            'password_confirmation' => 'required',
            'profile_photo'         => 'nullable|image|max:2048',
        ], [
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'role.required' => 'Role wajib dipilih',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'profile_photo.image' => 'File harus berupa gambar',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //  SIMPAN FOTO PROFIL (opsional)
        $photoPath = null;

        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile', 'public');
        }

        //  SIMPAN USER BARU
        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'role'          => $request->role,
            'password'      => Hash::make($request->password),
            'profile_photo' => $photoPath,
        ]);

        return redirect('/auth')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Logout
     */
    public function logout()
    {
        Session::flush();
        return redirect('/auth')->with('success', 'Anda berhasil logout.');
    }
}
