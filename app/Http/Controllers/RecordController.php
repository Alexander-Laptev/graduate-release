<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\Date;
use App\Models\Employee;
use App\Models\Record;
use App\Models\Saloon;
use App\Models\Schedule_master;
use App\Models\Service;
use App\Models\Service_Employee;
use App\Models\View;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Time;

class RecordController extends Controller
{
    public function index()
    {
        if(empty(session('city_id')))
            return redirect()->route('record.city');
        elseif(empty(session('saloon_id')))
            return redirect()->route('record.saloon');
        return view('record');
    }

    public function city()
    {
        $cities = City::all('id', 'name');
        return view('record.city', compact('cities'));
    }

    public function cityStore(Request $request)
    {
        $date = Date::query()->where('date', '=', Carbon::today('+4'))->get('id')->first();
        $request->session()->put('date_id', $date->id);
        $request->session()->put('city_id', $request->city_id);
        return redirect()->route('home.index');
    }

    public function saloon()
    {
        if(empty(session('city_id')))
            return redirect()->route('record.city');
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
        $request->session()->put('start', null);
        return redirect()->route('record');
    }

    public function service()
    {
        if(empty(session('city_id')))
            return redirect()->route('record.city');
        elseif(empty(session('saloon_id')))
            return redirect()->route('record.saloon');
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
            $views = View::query()->whereIn('id', $services->pluck('view_id'))->distinct()->get(['id', 'name']);

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
            $views = View::query()->whereIn('id', $services->pluck('view_id'))->distinct()->get(['id', 'name']);

            return view('record.service', compact(['services', 'views']));
        }
    }

    public function serviceStore(Request $request)
    {
        $request->session()->put('service_id', $request->service_id);

        if(!empty(session('employee_id')))
        {
            $request->session()->put('time', null);
            return redirect()->route('record.date');
        }
        else
            return redirect()->route('record.employee');
    }

    public function employee()
    {
        if(empty(session('city_id')))
            return redirect()->route('record.city');
        elseif(empty(session('saloon_id')))
            return redirect()->route('record.saloon');
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
        {
            $request->session()->put('time', null);
            return redirect()->route('record.date');
        }
        else
            return redirect()->route('record.service');
    }

    public function date()
    {
        if(empty(session('city_id')))
            return redirect()->route('record.city');
        elseif (empty(session('saloon_id')))
            redirect()->route('record.saloon');
        elseif (empty(session('service_id')))
            redirect()->route('record.service');
        elseif (empty(session('employee_id')))
            redirect()->route('record.employee');
        else
        {
            Carbon::setLocale('ru');

            $city = City::query()->where('id', '=', session('city_id'))->get('timezone')->first();



            //Все даты от текущей в течении недели, в которые работает сотрудник
            $dates = Schedule_master::query()->join('dates', 'schedule_masters.date_id', '=', 'dates.id')
                ->where('employee_id', '=', session('employee_id'))
                ->where('dates.date', '>=', Carbon::today('+4'))
                ->where('dates.date', '<=', Carbon::today('+4')->addWeek())
                ->get(['dates.id as id', 'dates.date', 'schedule_masters.start as start', 'schedule_masters.end as end'])
                ->sortBy('dates.date');


            //Приведение к Carbon
            $dates = $dates->map(function ($date) {
                $date->date = new Carbon($date->date);
                return $date;
            });

            //Все записи в выбранный день выбранного соотрудника
            $records = Record::query()
                ->join('services', 'service_id', '=', 'services.id')
                ->where('date_id', '=', session('date_id'))
                ->where('employee_id', '=', session('employee_id'))
                ->get(['services.time as time', 'start', 'records.id']);

            //Вычисление занятых промежутков времени, приведение к Carbon
            $timesClose = $records->map(function ($record) {
                $record->time = new Carbon($record->time);
                $record->start = new Carbon($record->start);
                $record->end = new Carbon($record->start);
                $record->end->addMinutes($record->time->format('i'));
                $record->end->addHours($record->time->format('H'));
                $record->start = $record->start->toTimeString();
                $record->end = $record->end->toTimeString();
                $record->start = Carbon::createFromTimeString( $record->start);
                $record->end = Carbon::createFromTimeString( $record->end);
                return $record;
            })->sortBy('start');

            //Вычисление расписания мастера, приведение к Carbon
            $timesWork = $dates->map(function ($time) {
                $time->start = new Carbon($time->start);
                $time->end = new Carbon($time->end);
                $time->start = $time->start->toTimeString();
                $time->end = $time->end->toTimeString();
                $time->start = Carbon::createFromTimeString( $time->start);
                $time->end = Carbon::createFromTimeString( $time->end);
                return $time;
            })->where('id', session('date_id'))->first();
            dd($timesWork);

            //Вычисление времени услуги
            $serviceTime = Service::query()->where('id', '=', session('service_id'))->get('time')->first();
            $serviceTime = $serviceTime->time->toTimeString();
            $serviceTime = Carbon::createFromTimeString($serviceTime);


            //Вычисление свободных промежутков времени
            $timesOpen = collect();
            $iteration = $timesClose->count();
            $timeWithService = collect();
            for($i = 0; $i <= $iteration; $i++)
            {
                if(empty($timesClose->toArray()))
                {
                    $timesWork->end->subMinutes($serviceTime->format('i'));
                    $timesWork->end->subHours($serviceTime->format('H'));
                    if(empty($timesOpen->toArray()) && empty($timeWithService->toArray()))
                    {
                        $timesOpen->push(['timeStart' => $timesWork->start->toTimeString(), 'timeClose' => $timesWork->end->toTimeString()]);
                    }
                    elseif($timesWork->end >= $timeWithService->end)
                    {
                        $timesOpen->push(['timeStart' => $timeWithService->end->toTimeString(), 'timeClose' => $timesWork->end->toTimeString()]);
                    }
                }
                //Если первая итерация, то
                elseif($i == 0)
                {
                    $time = $timesClose->shift();
                    $time->start->subMinutes($serviceTime->format('i'));
                    $time->start->subHours($serviceTime->format('H'));
                    //dd(session('date_id'));
                    if($timesWork->start <= $time->start)
                    {
                        $timesOpen->push(['timeStart' => $timesWork->start->toTimeString(), 'timeClose' => $time->start->toTimeString()]);
                    }
                    $timeWithService = $time;
                }
                else
                {
                    $time = $timesClose->shift();
                    $time->start->subMinutes($serviceTime->format('i'));
                    $time->start->subHours($serviceTime->format('H'));
                    if($timeWithService->end <= $time->start)
                    {
                        $timesOpen->push(['timeStart' => $timeWithService->end->toTimeString(), 'timeClose' => $time->start->toTimeString()]);
                    }
                    $timeWithService = $time;
                }
            }
            //dd($timesOpen->toArray());
            $timesOpen = $timesOpen->map(function ($timeOpen) {
                $timeOpen['timeStart'] = Carbon::createFromTimeString( $timeOpen['timeStart']);
                $timeOpen['timeClose'] = Carbon::createFromTimeString( $timeOpen['timeClose']);
                return $timeOpen;
            })->sortBy('timeStart');

            $d = Date::query()->where('id', '=', session('date_id'))->get('date')->first();

            $times = collect();
            $iteration = $timesOpen->count();
            for($i = 0; $i < $iteration; $i++)
            {
                $time = $timesOpen->shift();
                while($time['timeStart'] <= $time['timeClose'])
                {
                    $start = $time['timeStart'];
                    $now = Carbon::now('+4');
                    $s = Carbon::create($d->date->year, $d->date->month, $d->date->day, $start->hour, $start->minute, $start->second);
                    $t = Carbon::create($now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
                    if($s >= $t)
                        $times->push(['id' => $i, 'hour' =>  $time['timeStart']->format('H'), 'minute' => $time['timeStart']->format('i')]);
                    $time['timeStart']->addMinutes(5);
                }
            }
            //dd($times->toArray());
            $hours = $times->unique('hour');
            //dd($hours->toArray());
            $oneMinutes = $times->where('minute', '<', '15');
            $twoMinutes = $times->where('minute', '>=', '15')->where('minute', '<', '30');
            $threeMinutes = $times->where('minute', '>=', '30')->where('minute', '<', '45');
            $fourMinutes = $times->where('minute', '>=', '45');

            return view('record.date', compact(['dates', 'hours', 'oneMinutes', 'twoMinutes', 'threeMinutes', 'fourMinutes', 'times']));
        }
    }

    public function dateStore(Request $request)
    {
        if(!empty($request->start))
        {
            $request->session()->put('start', $request->start);
            return redirect()->route('record.order');
        }
        else
        {
            $request->session()->put('date_id', $request->date_id);
            $request->session()->put('start', null);
            return redirect()->route('record.date');
        }
    }

    public function order()
    {
        if(empty(session('city_id')))
            return redirect()->route('record.city');
        elseif (empty(session('saloon_id')))
            redirect()->route('record.saloon');
        elseif (empty(session('service_id')))
            redirect()->route('record.service');
        elseif (empty(session('employee_id')))
            redirect()->route('record.employee');
        elseif (empty(session('date_id')))
            redirect()->route('record.date');
        elseif (empty(session('start')))
            redirect()->route('record.date');
        elseif (empty(session('customer_id')) && !empty(auth()->user()) && auth()->user()->is_admin == true)
            redirect()->route('record');
        else {
            $saloon = Saloon::query()
                ->join('cities', 'city_id', '=', 'cities.id')
                ->where('saloons.id', '=', session('saloon_id'))
                ->get(['saloons.id as id', 'street', 'home', 'number_phone', 'cities.name as city'])->first();
            $service = Service::query()
                ->join('views', 'view_id', '=', 'views.id')
                ->join('subviews', 'subview_id', '=', 'subviews.id')
                ->where('services.id', '=', session('service_id'))
                ->get(['services.id as id', 'cost', 'time', 'services.name', 'views.name as view', 'subviews.name as subview'])->first();
            $employee = Employee::query()
                ->join('posts', 'post_id', '=', 'posts.id')
                ->where('employees.id', '=', session('employee_id'))
                ->get(['employees.id as id', 'employees.name', 'surname', 'patronymic', 'posts.name as post'])->first();
            $date = Date::query()->where('id', '=', session('date_id'))->get(['id', 'date'])->first();
            $date = new Carbon($date->date);
            $start = session('start');

            return view('record.order', compact(['saloon', 'service', 'employee', 'date', 'start']));
        }
    }

    public function orderStore(Request $request)
    {
        if(!empty(auth()->user()) && auth()->user()->is_admin != true)
        {
            $customer = Customer::query()->where('user_id', '=',auth()->user()->id)->get('id')->first();
            if(!empty($customer->toArray()))
            {
                $request->session()->put('customer_id', $customer->id);
            }
        }

        $records = Record::query()->create([
            'customer_id' => session('customer_id'),
            'saloon_id' => session('saloon_id'),
            'service_id'  => session('service_id'),
            'employee_id' => session('employee_id'),
            'date_id' => session('date_id'),
            'start' => session('start'),
            'status' => 'В ожидании',
        ]);

        $request->session()->put('employee_id', null);
        $request->session()->put('service_id', null);
        $request->session()->put('start', null);
        $request->session()->put('customer_id', null);

        if(!empty(auth()->user()) && auth()->user()->is_admin == true)
            return redirect()->route('admin.orders');
        else
            return redirect()->route('profile.orders');
    }

    public function customer(Request $request)
    {
        return view('record.customer');
    }

    public function customerStore(Request $request)
    {
        $customer = Customer::query()
            ->where('number_phone', '=', $request->number_phone)
            ->get('id')
            ->first();

        if(empty($customer))
        {
            $newcustomer = Customer::query()->create([
                'name' => $request->name,
                'number_phone' => $request->number_phone,
            ]);

            $request->session()->put('customer_id', $newcustomer->id);
        }
        else
        {
            $request->session()->put('customer_id', $customer->id);
        }

        return redirect()->route('record');
    }
}
