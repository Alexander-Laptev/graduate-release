<x-app-layout>
    @section('title', 'Добавление расписания')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>
    <div class="min-h-0 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full lg:max-w-3xl sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('admin.schedule_masters.store')}}">
                @csrf
                <div>
                    <x-input-label for="date" :value="__('Дата')" />
                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autofocus autocomplete="on" />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="employee_id" :value="__('Сотрудник')" />
                    <x-select id="employee_id" class="mt-1 w-full" name="employee_id" :value="old('employee_id')" required autofocus autocomplete="on">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->surname.' '.$employee->name.' '.$employee->patronymic }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="start" :value="__('Начало рабочего времени')" />
                    <x-text-input id="start" class="block mt-1 w-full" type="time" name="start" :value="old('start')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('start')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="end" :value="__('Конец рабочего времени')" />
                    <x-text-input id="end" class="block mt-1 w-full" type="time" name="end" :value="old('end')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('end')" class="mt-2" />
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
