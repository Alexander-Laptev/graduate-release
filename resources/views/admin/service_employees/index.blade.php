<x-app-layout>
    @section('title', 'Услуги и сотрудники')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>

    <div class="flex justify-center my-5">
        <a href="{{ route('admin.service_employees.create') }}">
            <x-primary-button >
                {{ __('Добавить запись') }}
            </x-primary-button>
        </a>
    </div>
    @if(empty($services->toArray()))
        {{ __('Нет записей.') }}
    @else
        <x-table>
            <x-table-head>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Услуга') }}
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Сотрудник') }}
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
                @foreach($services as $service)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $service->service_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $service->employee_name.' '.$service->employee_surname }}
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
