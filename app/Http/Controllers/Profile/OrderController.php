<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $records = Record::query()
        ->join('customers', 'records.customer_id', '=', 'customers.id')
        ->join('users', 'customers.user_id', '=', 'user.id')
        ->join('saloons', 'records.saloon_id', '=', 'saloons.id')
        ->join('cities', 'saloons.city_id', '=', 'city.id')
        ->join('services', 'records.service_id', '=', 'services.id')
        ->join('views', 'services.view_id', '=', 'views.id')
        ->join('subviews', 'services.subview_id', '=', 'subviews.id')
        ->join('employees', 'records.employee_id', '=', 'employees.id')
        ->join('posts', 'employees.post_id', '=', 'post.id')
        ->join('dates', 'records.date_id', '=', 'date.id')
        ->where('users.id', '=', auth()->user()->id)
        ->get(['saloons.street as street', 'saloons.home as home', 'cities.name as city', 'services.name as service_name',
            'services.cost as cost', 'views.name as view_name', 'subviews.name as subview_name', 'employees.name as employee_name',
            'employees.surname as employee_surname', 'employees.patronymic as employee_patronymic', 'posts.name as post',
            'dates.date as date', 'records.id as id']);

        return view('profile.orders.index', compact('records'));
    }

    public function destroy(string $id)
    {
        //
    }
}
