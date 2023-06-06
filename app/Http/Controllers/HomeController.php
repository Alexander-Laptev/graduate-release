<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Saloon;
use App\Models\Service;
use App\Models\Service_Employee;
use App\Models\Subview;
use App\Models\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if(empty(session('city_id')))
            return to_route('record.city');
        else
        {
            //Поиск всех сотрудников города
            $employees = Employee::query()
                ->join('saloons', 'employees.saloon_id', '=', 'saloons.id')
                ->join('cities', 'saloons.city_id', '=', 'cities.id')
                ->where('cities.id', '=', session('city_id'))
                ->get('employees.id');

            //Поиск всех услуг всех сотрудников города
            $services = Service_Employee::query()
                ->join('services', 'service__employees.services_id', '=', 'services.id')
                ->join('views', 'services.view_id', '=', 'views.id')
                ->join('subviews', 'services.subview_id', '=', 'subviews.id')
                ->whereIn('service__employees.employee_id', $employees)
                ->get(['services.id', 'view_id', 'subview_id', 'subviews.name as sname', 'services.name', 'cost', 'time', 'services.description']);

            $views = View::query()->whereIn('id', $services->pluck('view_id'))->distinct()->get(['id', 'name']);
            $subviews = $services;

            //Поиск всех салонов города
            $saloons = Saloon::query()->join('cities', 'saloons.city_id', '=', 'cities.id')
                ->where('city_id', '=', session('city_id'))
                ->get(['saloons.id','cities.name as city', 'street', 'home', 'open', 'close', 'number_phone', 'picture']);
//
//            $subviews = Subview::query()->whereIn('id', $services->pluck('subview_id'))->distinct()->get(['id', 'name']);
//
//            $subviews = $services
//            ->whereIn('view_id', $views->pluck('id'));
//            $services = $services->unique(function ($item) {
//                return $item['view_id'].$item['subview_id'];
//            });

//            $services = Service_Employee::query()
//                ->whereIn('service__employees.service', $subviews->pluck('id'));
            //dd($employees->toArray());
            //dd($services->toArray());
            //dd($subviews->toArray());
            return view('home.index', compact(['views', 'services', 'subviews', 'saloons']));
        }
    }
}
