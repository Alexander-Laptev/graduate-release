<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        $request->session()->put('date_id', null);
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

            $date = Date::query()->where('date', '=', Carbon::now()->format('Y-m-d'))->get('id')->first();

            return view('record.employee', compact(['employees', 'date']));
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

            $date = Date::query()->where('date', '=', Carbon::now()->format('Y-m-d'))->get('id')->first();

            return view('record.employee', compact(['employees', 'date']));
        }
    }

    public function employeeStore(Request $request)
    {
        $request->session()->put('employee_id', $request->employee_id);
        $request->session()->put('date_id', $request->date_id);

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
            $dates = Schedule_master::query()->join('dates', 'schedule_masters.date_id', '=', 'dates.id')
                ->where('employee_id', '=', session('employee_id'))
                ->where('dates.date', '>=', Carbon::now()->format('Y-m-d'))
                ->where('dates.date', '<', Carbon::now()->addDays(7)->format('Y-m-d'))
                ->get(['dates.id', 'dates.date']);

            $dates = $dates->map(function ($date) {
                $date->date = new Carbon($date->date);
                return $date;
            });

            $records = Record::query()
                ->join('services', 'service_id', '=', 'services.id')
                ->where('date_id', '=', session('date_id'))
                ->where('employee_id', '=', session('employee_id'))
                ->get(['services.time as time', 'start', 'records.id']);

            $timesClose = $records->map(function ($record) {
                $record->time = new Carbon($record->time);
                $record->start = new Carbon($record->start);
                $record->end = new Carbon($record->start);
                $record->end->addMinutes($record->time->format('i'));
                $record->end->addHours($record->time->format('H'));
                $record->start = $record->start->toTimeString();
                $record->end = $record->end->toTimeString();
                return $record;
            });

            $schedule_master = Schedule_master::query()
                ->where('employee_id', '=', session('employee_id'))
                ->where('date_id', '=', session('date_id'))
                ->get(['schedule_masters.start as start', 'schedule_masters.end as end', 'id']);

            $timesWork = $schedule_master->map(function ($time) {
                $time->start = new Carbon($time->start);
                $time->end = new Carbon($time->end);
                $time->start = $time->start->toTimeString();
                $time->end = $time->end->toTimeString();
                return $time;
            });

            $serviceTime = Service::query()->where('id', '=', session('service_id'))->get('time')->first();
            $serviceTime = $serviceTime->time->toTimeString();


            //Приведение к одному дню из строки времени на всякий
            $timesClose = $timesClose->map(function ($timeClose) {
                $timeClose->start = Carbon::createFromTimeString( $timeClose->start);
                $timeClose->end = Carbon::createFromTimeString( $timeClose->end);
                return $timeClose;
            })->sortBy('start');

            $timesWork = $timesWork->map(function ($timeWork) {
                $timeWork->start = Carbon::createFromTimeString( $timeWork->start);
                $timeWork->end = Carbon::createFromTimeString( $timeWork->end);
                return $timeWork;
            })->first();

            $serviceTime = Carbon::createFromTimeString($serviceTime);

            $timesOpen = collect();
            $iteration = $timesClose->count();
            $timeWithService = collect();
            for($i = 0; $i<=$iteration; $i++)
            {
                if($i == 0)
                {
                    $time = $timesClose->shift();
                    $time->start->subMinutes($serviceTime->format('i'));
                    $time->start->subHours($serviceTime->format('H'));
                    if($timesWork->start < $time->start)
                    {
                        $timesOpen->push(['timeStart' => $timesWork->start->toTimeString(), 'timeClose' => $time->start->toTimeString()]);
                    }
                    $timeWithService = $time;
                }
                elseif ($i == $iteration)
                {
                    $timesWork->end->subMinutes($serviceTime->format('i'));
                    $timesWork->end->subHours($serviceTime->format('H'));
                    if($timeWithService->end < $timesWork->end)
                    {
                        $timesOpen->push(['timeStart' => $timeWithService->end->toTimeString(), 'timeClose' => $timesWork->end->toTimeString()]);
                    }
                }
                else
                {
                    $time = $timesClose->shift();
                    $time->start->subMinutes($serviceTime->format('i'));
                    $time->start->subHours($serviceTime->format('H'));
                    if($timeWithService->end < $time->start)
                    {
                        $timesOpen->push(['timeStart' => $timeWithService->end->toTimeString(), 'timeClose' => $time->start->toTimeString()]);
                    }
                    $timeWithService = $time;
                }
            }

            $timesOpen = $timesOpen->map(function ($timeOpen) {
                $timeOpen['timeStart'] = Carbon::createFromTimeString( $timeOpen['timeStart']);
                $timeOpen['timeClose'] = Carbon::createFromTimeString( $timeOpen['timeClose']);
                return $timeOpen;
            })->sortBy('timeStart');

            $times = collect();
            for($i = 0; $i<=$timesOpen->count(); $i++)
            {
                $time = $timesOpen->shift();
                while($time['timeStart'] <= $time['timeClose'])
                {
                    $times->push(['id' => $i, 'hour' =>  $time['timeStart']->format('H'), 'minute' => $time['timeStart']->format('i')]);
                    $time['timeStart']->addMinutes(5);
                }
            }
            $hours = $times->unique('hour');
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
        $records = Record::query()->create([
            'customer_id' => 1,
            'saloon_id' => session('saloon_id'),
            'service_id'  => session('service_id'),
            'employee_id' => session('employee_id'),
            'date_id' => session('date_id'),
            'start' => session('start'),
            'status' => 'В ожидании',
        ]);

        return redirect()->route('profile.edit');
    }
}
