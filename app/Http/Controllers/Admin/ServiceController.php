<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Страница всех услуг';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Создание услуги';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'Отправка формы услуги';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'Показ услуги';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return 'Изменение услуги';
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
