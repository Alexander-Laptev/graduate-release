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
    @if(empty($employees->toArray()))
        {{ __('Нет сотрудников.') }}
    @else
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
            @foreach($employees as $employee)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                    {{ $employee->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $employee->surname }}
                </td>
                <td class="px-6 py-4">
                    {{ $employee->patronymic }}
                </td>
                <td class="px-6 py-4">
                    {{ $employee->birthday }}
                </td>
                <td class="px-6 py-4">
                    @if($employee->gender == 0)
                        Мужской
                    @else
                        Женский
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{ $employee->experience }}
                </td>
                <td class="px-6 py-4">
                    {{ $employee->address }}
                </td>
                <td class="px-6 py-4">
                    {{ $employee->number_phone }}
                </td>
                <td class="px-6 py-4">
                    {{ $employee->post }}
                </td>
                <td class="px-6 py-4">
                    г. {{ $employee->city }},  ул. {{ $employee->street }} д. {{ $employee->home }}
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
