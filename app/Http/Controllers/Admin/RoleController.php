<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(['name']);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $role = Role::query()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.roles');
    }

    public function show(string $id)
    {
        return view('admin.roles.show');
    }

    public function edit(string $id)
    {
        return view('admin.roles.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
