<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10', 'unique:'.User::class],
            'login' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $roles = Role::all();
        if (empty($roles->toArray()))
        {
            Role::query()->create([
                'name' => 'Пользователь',
            ]);
            Role::query()->create([
                'name' => 'Администратор',
            ]);
        }

        $role = Role::query()->where('name', 'like', '%Пользователь%')->get(['id', 'name'])->first();

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'login' => $request->login,
            'email' => $request->email,
            'role_id' => $role->id,
            'password' => Hash::make($request->password),
        ]);

        $customer = Customer::query()->create([
            'user_id' => $user->id,
            'name' => $request->name,
            'surname',
            'patronymic',
            'gender',
            'birthday',
            'picture',
            'card',
        ]);

        event(new Registered($user));

        Auth::login($user);

        if (!empty(session('city_id')) && !empty(session('saloon_id')) && !empty(session('service_id')) && !empty(session('employee_id')) &&
                    !empty(session('date_id')) && !empty(session('start')))
            return redirect()->route('record.order');
        else
            return redirect(RouteServiceProvider::HOME);
    }
}
