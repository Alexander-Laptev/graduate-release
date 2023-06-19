<x-app-layout>
    @section('title', 'Записи')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>

    <div class="flex justify-center my-5">
        <a href="{{ route('record') }}">
            <x-primary-button >
                {{ __('Добавить запись') }}
            </x-primary-button>
        </a>
    </div>
    @if(empty($records->toArray()))
        {{ __('Нет записей.') }}
    @else
        <x-table>
            <x-table-head>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Клиент') }}
                        </div>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Салон') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Услуга') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Мастер') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Дата') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Время') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Статус') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Изменить статус') }}</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Редактировать') }}</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">{{ __('Отменить запись') }}</span>
                    </th>
                </tr>
            </x-table-head>
            <x-table-body>
                @foreach($records as $record)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $record->user.' '.$record->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $record->city.__(' ул.').' '.$record->street.', '.$record->home }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $record->service }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $record->employee_surname.' '.$record->employee_name.' '.$record->employee_patronymic }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $record->date->format('d-m-y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $record->start->format('H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $record->status }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form method="POST" action="{{route('admin.orders.status', $record->id)}}">
                                @method('PUT')
                                @csrf
                                <button type="submit"><p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Изменить статус</p></button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Редактировать</a>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form method="POST" action="{{route('profile.orders.destroy', $record->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit"><p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('Отменить запись') }}</p></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-table-body>
        </x-table>
    @endif
</x-app-layout>
