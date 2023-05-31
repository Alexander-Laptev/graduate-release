<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subview;
use Illuminate\Http\Request;

class SubviewController extends Controller
{
    public function index()
    {
        $subviews = Subview::all('name');
        return view('admin.subviews.index', compact('subviews'));
    }

    public function create()
    {
        return view('admin.subviews.create');
    }

    public function store(Request $request)
    {
        $subviews = Subview::query()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.subviews');
    }

    public function show(string $id)
    {
        return view('admin.subviews.show');
    }

    public function edit(string $id)
    {
        return view('admin.subviews.edit');
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
