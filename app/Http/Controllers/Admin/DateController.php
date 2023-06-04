<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Date;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index()
    {
        $dates = Date::query()
            ->get('date')
            ->sortByDesc('date');
        return view('admin.dates.index', compact('dates'));
    }

    public function create()
    {
        return view('admin.dates.create');
    }

    public function store(Request $request)
    {
        $date = Date::query()->create([
            'date' => $request->date,
        ]);

        return redirect()->route('admin.dates');
    }

    public function show(string $id)
    {
        return view('admin.dates.show');
    }

    public function edit(string $id)
    {
        return view('admin.dates.edit');
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
