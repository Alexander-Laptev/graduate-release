<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all('name', 'domain_name', 'timezone');
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $cities = City::query()->create([
            'name' => $request->name,
            'domain_name' => $request->domain_name,
            'timezone' => $request->timezone,
        ]);

        return redirect()->route('admin.cities');
    }

    public function show(string $id)
    {
        return view('admin.cities.show');
    }

    public function edit(string $id)
    {
        return view('admin.cities.edit');
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
