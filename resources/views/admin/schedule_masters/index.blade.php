<x-app-layout>
    @section('title', 'Расписания')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>

    <div class="flex justify-center my-5">
        <a href="{{ route('admin.schedule_masters.create') }}">
            <x-primary-button >
                {{ __('Добавить расписание') }}
            </x-primary-button>
        </a>
    </div>
    @if(empty($schedule_masters->toArray()))
        {{ __('Нет расписаний.') }}
    @else
        <x-table>
            <x-table-head>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Дата') }}
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Сотрудник') }}
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Начало рабочего времени') }}
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Конец рабочего времени') }}
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Редактировать') }}</span>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Удалить') }}</span>
                    </th>
                </tr>
            </x-table-head>
            <x-table-body>
                @foreach($schedule_masters as $schedule_master)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $schedule_master->date->format('d.m.Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $schedule_master->name.' '.$schedule_master->surname.' '.$schedule_master->patronymic }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $schedule_master->start->format('H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $schedule_master->end->format('H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Редактировать</a>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Удалить</a>
                        </td>
                    </tr>
                @endforeach
            </x-table-body>
        </x-table>
    @endif
</x-app-layout>
