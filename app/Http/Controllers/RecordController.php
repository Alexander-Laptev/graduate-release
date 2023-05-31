<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Employee;
use App\Models\Saloon;
use App\Models\Service;
use App\Models\Service_Employee;
use App\Models\View;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        if(empty(session('city_id')))
            return to_route('record.city');
        return view('record');
    }

    public function city()
    {
        $cities = City::all('id', 'name');
        return view('record.city', compact('cities'));
    }

    public function cityStore(Request $request)
    {
        $request->session()->put('city_id', $request->city_id);
        return to_route('record.saloon');
    }

    public function service()
    {
        if(empty(session('city_id')))
            return to_route('record.city');
        elseif(empty(session('saloon_id')))
            return to_route('record.saloon');
        elseif(empty(session('employee_id')))  //Если не выбран мастер, то выводится список всех услуг салона
        {
            $employees = Employee::query()->where('saloon_id', '=', session('saloon_id'))->get('id');
            $services = Service_Employee::query()
                ->join('services', 'service__employees.services_id', '=', 'services.id')
                ->join('views', 'services.view_id', '=', 'views.id')
                ->join('subviews', 'services.subview_id', '=', 'subviews.id')
                ->whereIn('service__employees.employee_id', $employees)
                ->distinct()
                ->get(['services.id', 'view_id', 'subviews.name as sname', 'services.name', 'cost', 'time', 'services.description']);
            $views = View::all('id', 'name');
            return view('record.service', compact(['services', 'views']));
        }
        else //Если выбран мастер, то выводится список всех услуг мастера
        {
            $services = Service_Employee::query()
                ->join('services', 'service__employees.services_id', '=', 'services.id')
                ->join('views', 'services.view_id', '=', 'views.id')
                ->join('subviews', 'services.subview_id', '=', 'subviews.id')
                ->where('employee_id', '=', session('employee_id'))
                ->get(['services.id', 'view_id', 'subviews.name as sname', 'services.name', 'cost', 'time', 'services.description']);
            $views = View::all('id', 'name');
            return view('record.service', compact(['services', 'views']));
        }
    }

    public function serviceStore(Request $request)
    {
        $request->session()->put('service_id', $request->service_id);

        if(!empty(session('employee_id')))
            return to_route('home');
        else
            return to_route('record.employee');
    }

    public function employee()
    {
        if(empty(session('city_id')))
            return to_route('record.city');
        elseif(empty(session('saloon_id')))
            return to_route('record.saloon');
        elseif(empty(session('service_id')))  //Если не выбрана услуга, то выводится список сотрудников салона
        {
            $employees = Employee::query()->join('posts', 'employees.post_id', '=', 'posts.id')
                ->join('saloons', 'employees.saloon_id', '=', 'saloons.id')
                ->join('cities', 'saloons.city_id', '=', 'cities.id')
                ->where('saloon_id', '=', session('saloon_id'))
                ->get(['employees.id as id', 'employees.name', 'surname', 'experience', 'posts.name as post', 'employees.picture']);

            return view('record.employee', compact('employees'));
        }
        else  //Если выбрана услуга, то выводится список сотрудников конкретной услуги, кокретного салона
        {
            $employees = Service_Employee::query()->join('employees', 'service__employees.employee_id', '=', 'employees.id')
                ->join('posts', 'employees.post_id', '=', 'posts.id')
                ->join('saloons', 'employees.saloon_id', '=', 'saloons.id')
                ->join('cities', 'saloons.city_id', '=', 'cities.id')
                ->where('saloon_id', '=', session('saloon_id'))
                ->where('services_id', '=', session('service_id'))
                ->get(['employees.id as id', 'employees.name', 'surname', 'experience', 'posts.name as post', 'employees.picture']);

            return view('record.employee', compact('employees'));
        }
    }

    public function employeeStore(Request $request)
    {
        $request->session()->put('employee_id', $request->employee_id);
        if(!empty(session('service_id')))
            return to_route('home');
        else
            return to_route('record.service');
    }

    public function saloon()
    {
        if(empty(session('city_id')))
            return to_route('record.city');
        else
        {
            $saloons = Saloon::query()->join('cities', 'saloons.city_id', '=', 'cities.id')
                ->where('city_id', '=', session('city_id'))
                ->get(['saloons.id','cities.name as city', 'street', 'home', 'open', 'close', 'number_phone', 'picture']);
            return view('record.saloon', compact('saloons'));
        }
    }

    public function saloonStore(Request $request)
    {
        $request->session()->put('saloon_id', $request->saloon_id);
        $request->session()->put('employee_id', null);
        $request->session()->put('service_id', null);
        return view('record');
    }
}
