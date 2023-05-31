<x-app-layout>
    @section('title', 'Добавление записи')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>
    <div class="min-h-0 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full lg:max-w-3xl sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('admin.service_employees.store')}}">
                @csrf
                <div class="mt-4">
                    <x-input-label for="services_id" :value="__('Услуга')" />
                    <x-select id="services_id" class="mt-1 w-full" name="services_id" :value="old('services_id')" required autofocus autocomplete="on">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('services_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="employee_id" :value="__('Сотрудник')" />
                    <x-select id="employee_id" class="mt-1 w-full" name="employee_id" :value="old('employee_id')" required autofocus autocomplete="on">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name.' '.$employee->surname }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="my-5">
                        {{ __('Добавить') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
