<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $records = Record::query()
            ->join('customers', 'records.customer_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->join('saloons', 'records.saloon_id', '=', 'saloons.id')
            ->join('cities', 'saloons.city_id', '=', 'cities.id')
            ->join('services', 'records.service_id', '=', 'services.id')
            ->join('employees', 'records.employee_id', '=', 'employees.id')
            ->join('dates', 'records.date_id', '=', 'dates.id')
            ->orderByDesc('dates.date')
            ->orderBy('records.start')
            ->orderBy('status')
            ->get(['saloons.street as street', 'saloons.home as home', 'cities.name as city', 'services.name as service',
                'employees.name as employee_name', 'employees.surname as employee_surname', 'employees.patronymic as employee_patronymic',
                'dates.date as date', 'records.id as id', 'records.status as status', 'records.start as start', 'users.phone as phone', 'users.name as user']);

        $records = $records->map( function ($record) {
            $record->date = new Carbon($record->date);
            $record->start = new Carbon($record->start);
            return $record;
        });

        return view('admin.orders.index', compact('records'));
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

    public function status(string $id)
    {
        $record = Record::query()->find($id);

        if ($record->status == 'В ожидании')
        {
            $record->status = 'Завершён';

            $record->save();
        }
        elseif ($record->status == 'Завершён')
        {
            $record->status = 'В ожидании';

            $record->save();
        }
        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        Record::query()->find($id)->delete();

        return redirect()->back();
    }
}
