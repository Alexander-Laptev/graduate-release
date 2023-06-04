<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Date;
use App\Models\Employee;
use App\Models\Schedule_master;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Schedule_masterController extends Controller
{
    public function index()
    {
        $schedule_masters = Schedule_master::query()
            ->join('dates', 'date_id', '=', 'dates.id')
            ->join('employees', 'employee_id', '=', 'employees.id')
            ->get(['dates.date as date', 'employees.name as name', 'employees.surname as surname', 'employees.patronymic as patronymic', 'start', 'end'])
            ->sortByDesc('dates.date');

        $schedule_masters = $schedule_masters->map(function ($schedule_master) {
            $schedule_master->date = new Carbon($schedule_master->date);
            $schedule_master->start = new Carbon( $schedule_master->start);
            $schedule_master->end = new Carbon( $schedule_master->end);
            return $schedule_master;
        });
        return view('admin.schedule_masters.index', compact('schedule_masters'));
    }

    public function create()
    {
        $employees = Employee::all('id', 'name', 'surname', 'patronymic');
        return view('admin.schedule_masters.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $date = new Carbon($request->date);
        $date = Date::query()->where('date', '=', $date->format('Y-m-d'))->get(['id', 'date'])->first();

        $schedule_master = Schedule_master::query()->create([
            'date_id' => $date->id,
            'employee_id' => $request->employee_id,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('admin.schedule_masters');
    }

    public function show(string $id)
    {
        return view('admin.schedule_masters.show');
    }

    public function edit(string $id)
    {
        return view('admin.schedule_masters.edit');
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
