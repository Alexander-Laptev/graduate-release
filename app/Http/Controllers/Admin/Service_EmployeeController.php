<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Service_Employee;
use Illuminate\Http\Request;

class Service_EmployeeController extends Controller
{
    public function index()
    {
        $services = Service_Employee::query()
            ->join('employees', 'service__employees.employee_id', '=', 'employees.id')
            ->join('services', 'service__employees.services_id', '=', 'services.id')
            ->get(['employees.name as employee_name', 'employees.surname as employee_surname', 'services.name as service_name']);
        return view('admin.service_employees.index', compact('services'));
    }

    public function create()
    {
        $services = Service::all('id', 'name');
        $employees = Employee::all('id', 'name', 'surname');

        return view('admin.service_employees.create', compact(['services', 'employees']));
    }

    public function store(Request $request)
    {
        $services = Service_Employee::query()->create([
            'employee_id' => $request->employee_id,
            'services_id' => $request->services_id,
        ]);

        return redirect()->route('admin.service_employees');
    }

    public function show(string $id)
    {
        return view('admin.service_employees.show');
    }

    public function edit(string $id)
    {
        return view('admin.service_employees.edit');
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
