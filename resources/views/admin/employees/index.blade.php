<x-app-layout>
    @section('title', 'Сотрудники')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>

    <div class="flex justify-center my-5">
        <a href="{{ route('admin.employees.create') }}">
            <x-primary-button >
                {{ __('Добавить сотрудника') }}
            </x-primary-button>
        </a>
    </div>

    <x-table>
        <x-table-head>
            <tr>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Имя') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Фамилия') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Отчество') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('День рождения') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Пол') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Опыт работы') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Адрес') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Номер телефона') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Должность') }}
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        {{ __('Салон') }}
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
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                    Александр
                </td>
                <td class="px-6 py-4">
                    Лаптев
                </td>
                <td class="px-6 py-4">
                    Романович
                </td>
                <td class="px-6 py-4">
                    16.07.2003
                </td>
                <td class="px-6 py-4">
                    Мужской
                </td>
                <td class="px-6 py-4">
                    5
                </td>
                <td class="px-6 py-4">
                    Школьная 23
                </td>
                <td class="px-6 py-4">
                    89127514020
                </td>
                <td class="px-6 py-4">
                    Мастер
                </td>
                <td class="px-6 py-4">
                    Ижевск, Студенческая 7
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Редактировать</a>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Удалить</a>
                </td>
            </tr>

        </x-table-body>
    </x-table>
</x-app-layout>
