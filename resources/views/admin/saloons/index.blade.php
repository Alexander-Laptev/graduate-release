<x-app-layout>
    @section('title', 'Салоны')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>

    <div class="flex justify-center my-5">
        <a href="{{ route('admin.saloons.create') }}">
            <x-primary-button >
                {{ __('Добавить салон') }}
            </x-primary-button>
        </a>
    </div>
    @if(empty($saloons->toArray()))
        {{ __('Нет салонов.') }}
    @else
        <x-table>
            <x-table-head>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                        {{ __('Город') }}
                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg></a>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Улица') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Дом') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Время открытия') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Время закрытия') }}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{ __('Номер телефона') }}
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
                @foreach($saloons as $saloon)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $saloon->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $saloon->street }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $saloon->home }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $saloon->open->format('H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $saloon->close->format('H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $saloon->number_phone }}
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
