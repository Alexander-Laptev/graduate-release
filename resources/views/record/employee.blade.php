<x-app-layout>
    @section('title', 'Мастера')

    <x-slot name="header">
        @include('layouts.header-user')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Выберите мастера") }}

                    <form action="{{ route('record.employee.store')}}" method="POST">
                        @csrf
                        <div class="mt-4 flow-root">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($employees as $employee)
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="{{ asset('/pictures').'/'.$employee->picture}}" alt="">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <button value="{{ $employee->id }}" name="employee_id" id="employee_id" type="submit">
                                                    <p class="ps-8 font-medium text-gray-900 truncate dark:text-white">
                                                        {{ $employee->surname.' '.$employee->name }}
                                                    </p>
                                                </button>

                                                <p class="ps-8 text-sm text-gray-500 truncate dark:text-gray-400">
                                                    {{ $employee->post}}
                                                </p>
                                            </div>
                                            <div class="text-sm inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                {{ __('Стаж: ').$employee->experience.' г.' }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
