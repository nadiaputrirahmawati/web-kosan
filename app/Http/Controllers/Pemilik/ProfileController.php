<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
   
    public function index()
    {
        return view('pemilik.profile.index');
    }
    public function create()
    {
        return view('pemilik.profile.profile');
    }

    public function update(Request $request)
    {
        // dd($request);
        $user = User::findOrFail(Auth::user()->user_id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'no_ktp' => 'required|string|max:16|min:16',
            'gender' => 'required|in:L,P',
            'tgl_lahir' => 'required|date',
            'address' => 'required|string',
            'no_npwp' => 'nullable|max:16|min:16',
            'bank' => 'nullable|string',
            'no_rekening' => 'nullable|string',
            'phone_number' => 'required|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ktp_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ktp_picture_person' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);



        // Update file jika ada upload baru
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
        }

        if ($request->hasFile('ktp_picture')) {
            $validated['ktp_picture'] = $request->file('ktp_picture')->store('ktp', 'public');
        }

        if ($request->hasFile('ktp_picture_person')) {
            $validated['ktp_picture_person'] = $request->file('ktp_picture_person')->store('ktp-person', 'public');
        }

        // Jika kamu pakai custom method `saved` di model User

        $validated['status_verification'] = 'pending';
        $user->update($validated);

        notyf()->success('Your profile has been updated.');
        return redirect()->route('owner.profile');
    }
}
