<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();
        return view('superadmin.admins.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'admin',
            'is_active'=> 1,
        ]);

        return redirect()->route('superadmin.admins.index')
                         ->with('success', 'Administrateur créé avec succès.');
    }

    public function activities($id)
    {
        $admin = User::whereIn('role', ['admin', 'super_admin'])->findOrFail($id);
        return view('superadmin.admins.activities', compact('admin'));
    }

    public function toggleStatus($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->is_active = !$admin->is_active;
        $admin->save();

        $status = $admin->is_active ? 'activé' : 'désactivé';
        return redirect()->route('superadmin.admins.index')
                         ->with('success', "Administrateur {$status} avec succès.");
    }

    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();

        return redirect()->route('superadmin.admins.index')
                         ->with('success', 'Administrateur supprimé.');
    }
}