<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Post;
use App\Models\Saloon;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::query()->join('posts', 'employees.post_id', '=', 'posts.id')
            ->join('saloons', 'employees.saloon_id', '=', 'saloons.id')
            ->join('cities', 'saloons.city_id', '=', 'cities.id')
            ->get(['employees.name', 'surname', 'patronymic', 'birthday', 'gender', 'experience', 'address', 'employees.number_phone', 'posts.name as post', 'cities.name as city', 'saloons.street', 'saloons.home']);
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::query()->get(['id', 'name', 'phone']);
        $posts = Post::all();
        $saloons = Saloon::query()->join('cities', 'saloons.city_id', '=', 'cities.id')
            ->get(['saloons.id', 'cities.name as city', 'street', 'home']);

        return view('admin.employees.create', compact(['users', 'posts', 'saloons']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pictureName = time().'.'.$request->picture->extension();
        $request->picture->move(public_path('pictures'), $pictureName);

        $employees = Employee::query()->create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'surname'  => $request->surname,
            'patronymic' => $request->patronymic,
            'birthday' => $request->birthday,
            'workday' => $request->workday,
            'gender' => $request->gender,
            'experience' => $request->experience,
            'address' => $request->address,
            'number_phone' => $request->number_phone,
            'post_id' => $request->post_id,
            'saloon_id' => $request->saloon_id,
            'picture' => $pictureName,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.employees');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.employees.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.employees.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
