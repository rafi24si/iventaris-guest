<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil
     */
    public function index()
    {
        $user = User::find(Session::get('user_id'));

        return view('pages.profile.index', compact('user'));
    }

    /**
     * Update nama, email, dan foto profil
     */
    public function updateProfile(Request $request)
    {
        $user = User::find(Session::get('user_id'));

        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        // ================================
        // UPDATE FOTO PROFIL (FIX PATH)
        // ================================
        if ($request->hasFile('profile_photo')) {

            // ❌ SEBELUM: profile_photos (SALAH)
            // ✅ SEKARANG: profile-photos (BENAR)
            $path = $request->file('profile_photo')
                ->store('profile-photos', 'public');

            $user->profile_photo = $path;

            // Update session (dipakai di header)
            Session::put('profile_photo', $path);
        }

        // Update data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Session::put('user_name', $user->name);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'      => 'required',
            'password'          => 'required|min:3|confirmed',
        ]);

        $user = User::find(Session::get('user_id'));

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }
}
