<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    
    public function index()
    {
        $admins = User::where('role', 'admin')->paginate(10);
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'can_edit' => false,
        ]);

        return redirect(route('admins.index'))->with('success', 'Admin berhasil dibuat');
    }

    public function edit(User $admin)
    {
        if ($admin->role !== 'admin') {
            return redirect(route('admins.index'))->with('error', 'User bukan admin');
        }
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        if ($admin->role !== 'admin') {
            return redirect(route('admins.index'))->with('error', 'User bukan admin');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($admin->id)],
            'password' => 'nullable|string|min:8',
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        
        if ($validated['password'] ?? null) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect(route('admins.index'))->with('success', 'Admin berhasil diperbarui');
    }

    public function destroy(User $admin)
    {
        if ($admin->role !== 'admin') {
            return redirect(route('admins.index'))->with('error', 'User bukan admin');
        }

        $admin->delete();
        return redirect(route('admins.index'))->with('success', 'Admin berhasil dihapus');
    }

    public function toggleEdit(Request $request, User $admin)
    {
        if ($admin->role !== 'admin') {
            return redirect(route('admins.index'))->with('error', 'User bukan admin');
        }

        $admin->can_edit = !$admin->can_edit;
        $admin->save();

        $action = $admin->can_edit ? 'diberikan' : 'dicabut';
        return redirect(route('admins.index'))->with('success', "Izin edit $action untuk {$admin->name}");
    }
}
