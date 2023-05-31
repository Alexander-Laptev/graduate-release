<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Subview;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::query()->join('views', 'services.view_id', '=', 'views.id')
            ->join('subviews', 'services.subview_id', '=', 'subviews.id')
            ->get(['views.name as vname', 'subviews.name as sname', 'services.name', 'cost', 'time', 'description']);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $views = View::all(['id', 'name']);
        $subviews = Subview::all(['id', 'name']);

        return view('admin.services.create', compact(['views', 'subviews']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cities = Service::query()->create([
            'name' => $request->name,
            'view_id' => $request->view_id,
            'subview_id' => $request->subview_id,
            'cost' => $request->cost,
            'time' => $request->time,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.services');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.services.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.services.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return 'Отправка формы изминения услуги';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'Удаление услуги';
    }
}
