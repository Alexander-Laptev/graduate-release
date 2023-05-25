<x-app-layout>
    @section('title', 'Города')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>

    <div class="flex justify-center my-5">
        <a href="{{ route('admin.cities.create') }}">
            <x-primary-button >
                {{ __('Добавить город') }}
            </x-primary-button>
        </a>
    </div>
    @if(empty($cities->all()))
        {{ __('Нет городов.') }}
    @else
        <x-table>
            <x-table-head>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Наименование') }}
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Доменное имя') }}
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
                    @foreach($cities as $city)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $city->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $city->domain_name }}
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
