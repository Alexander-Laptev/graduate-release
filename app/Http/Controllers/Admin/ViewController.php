<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        $views = View::all('name');
        return view('admin.views.index', compact('views'));
    }

    public function create()
    {
        return view('admin.views.create');
    }

    public function store(Request $request)
    {
        $views = View::query()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.views');
    }

    public function show(string $id)
    {
        return view('admin.views.show');
    }

    public function edit(string $id)
    {
        return view('admin.views.edit');
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

