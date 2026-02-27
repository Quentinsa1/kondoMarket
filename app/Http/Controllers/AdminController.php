<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Affiche la liste des administrateurs
     */
    public function index()
    {
        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Affiche le formulaire de création d'un admin
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Enregistre un nouvel admin
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin', // Seulement admin
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Administrateur créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $admin = User::whereIn('role', ['admin', 'super_admin'])->findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Met à jour un admin
     */
    public function update(Request $request, $id)
    {
        $admin = User::whereIn('role', ['admin', 'super_admin'])->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')->with('success', 'Administrateur mis à jour.');
    }

    /**
     * Supprime un admin (sauf super_admin)
     */
    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Administrateur supprimé.');
    }

    /**
     * Affiche les activités d'un administrateur (placeholder)
     */
    public function activities($id)
    {
        $admin = User::whereIn('role', ['admin', 'super_admin'])->findOrFail($id);
        // Pour l'instant, on passe juste l'admin à une vue (à créer)
        return view('admin.admins.activities', compact('admin'));
    }
}