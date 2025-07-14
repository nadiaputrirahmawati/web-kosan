<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roleFilter = $request->input('role');

        $users = User::when($roleFilter, function ($query, $roleFilter) {
            return $query->where('role', $roleFilter);
        })
            ->paginate(10);

        return view('admin.userman.index', compact('users'));
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
        $user = User::findOrFail($id);
        return view('admin.userman.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'action' => 'required|in:verified,reject',
        ]);

        if ($request->action == 'verified') {
            $user->status_verification = 'verified';
        } elseif ($request->action == 'reject') {
            $user->status_verification = 'reject';
        }

        $user->save();

        return redirect()->route('admin.user-management.index')->with('success', 'Status pengguna telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
