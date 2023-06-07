<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $records = Record::all();
        return view('admin.orders.index', compact('records'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $record = Record::query()->create([
        ]);

        return redirect()->route('admin.orders');
    }

    public function show(string $id)
    {
        return view('admin.orders.show');
    }

    public function edit(string $id)
    {
        return view('admin.orders.edit');
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
