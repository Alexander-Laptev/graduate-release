<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
            $employees = Employee::query()
                ->join('saloons', 'employees.saloon_id', '=', 'saloons.id')
                ->join('cities', 'saloons.city_id', '=', 'cities.id')
                ->where('cities.id', '=', session('city_id'))
                ->get('employees.id');

            $services = Service_Employee::query()
                ->join('services', 'service__employees.services_id', '=', 'services.id')
                ->join('views', 'services.view_id', '=', 'views.id')
                ->join('subviews', 'services.subview_id', '=', 'subviews.id')
                ->whereIn('service__employees.employee_id', $employees)
                ->get(['services.id', 'view_id', 'subview_id', 'subviews.name as sname', 'services.name', 'cost', 'time', 'services.description']);

            $views = View::query()->whereIn('id', $services->pluck('view_id'))->distinct()->get(['id', 'name']);
            $subviews = $services;
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
            return view('home.index', compact(['views', 'services', 'subviews']));
        }
    }
}
