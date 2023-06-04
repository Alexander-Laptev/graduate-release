<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Saloon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Monolog\toArray;

class SaloonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saloons = Saloon::query()->join('cities', 'saloons.city_id', '=', 'cities.id')
            ->get(['cities.name', 'street', 'home', 'open', 'close', 'number_phone']);

        $saloons = $saloons->map(function ($saloon) {
            $saloon->open = new Carbon($saloon->open);
            $saloon->close = new Carbon( $saloon->close);
            return $saloon;
        });

        return view('admin.saloons.index', compact('saloons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all(['id', 'name']);
        return view('admin.saloons.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pictureName = time().'.'.$request->picture->extension();
        $request->picture->move(public_path('pictures'), $pictureName);

        $cities = Saloon::query()->create([
            'city_id' => $request->city_id,
            'street' => $request->street,
            'home' => $request->home,
            'picture' => $pictureName,
            'open' => $request->open,
            'close' => $request->close,
            'number_phone' => $request->number_phone,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.saloons');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.saloons.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.saloons.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
