<x-app-layout>
    @section('title', 'Салоны')

    <x-slot name="header">
        @include('layouts.header-user')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Выберите салон") }}

                    <form action="{{ route('record.saloon.store')}}" method="POST">
                        @csrf
                            <div class="mt-4 grid grid-flow-row lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 justify-items-center">
                                @foreach($saloons as $saloon)
                                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a type="button">
                                        <img class="object-cover h-48 w-96 rounded-t-lg" src="{{ asset('/pictures').'/'.$saloon->picture}}" alt="" />
                                    </a>
                                    <div class="p-5">
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-start">
                                            {{ __('Адрес').': г.'.$saloon->city.' ул.'.$saloon->street.' д.'.$saloon->home}}<br/>
                                            {{ __('Номер телефона').': '.$saloon->number_phone}}<br/>
                                            {{ __('Время открытия').': '.$saloon->open->format('H:i')}}<br/>
                                            {{ __('Время закрытия').': '.$saloon->close->format('H:i')}}<br/>
                                        </p>
                                        <x-primary-button type="submit" value="{{ $saloon->id }}" id="saloon_id" name="saloon_id" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            {{ __('Выбрать') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
