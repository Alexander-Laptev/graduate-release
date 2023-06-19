<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;

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
        ->join('views', 'services.view_id', '=', 'views.id')
        ->join('subviews', 'services.subview_id', '=', 'subviews.id')
        ->join('employees', 'records.employee_id', '=', 'employees.id')
        ->join('posts', 'employees.post_id', '=', 'posts.id')
        ->join('dates', 'records.date_id', '=', 'dates.id')
        ->where('users.id', '=', auth()->user()->id)
        ->orderBy('dates.date')
        ->orderBy('records.start')
        ->get(['saloons.street as street', 'saloons.home as home', 'cities.name as city', 'services.name as service_name',
            'services.cost as cost', 'views.name as view_name', 'subviews.name as subview_name', 'employees.name as employee_name',
            'employees.surname as employee_surname', 'employees.patronymic as employee_patronymic', 'posts.name as post',
            'dates.date as date', 'records.id as id', 'records.status as status', 'records.start as start']);

        $records = $records->map( function ($record) {
            $record->date = new Carbon($record->date);
            return $record;
        });

        return view('profile.orders.index', compact('records'));
    }

    public function destroy(string $id)
    {
        Record::query()->find($id)->delete();

        return redirect()->back();
    }
}
