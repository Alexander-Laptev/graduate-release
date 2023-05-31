<x-app-layout>
    @section('title', 'Города')

    <x-slot name="header">
        @include('layouts.header-user')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Выберите город") }}

                    <form action="{{ route('record.city.store')}}" method="POST">
                    @csrf
                        <div class=" mt-2.5 flex flex-col justify-center rounded-md shadow-sm">
                    @foreach($cities as $city)
                       @if($loop->first)
                            <button type="submit" value="{{ $city->id }}" name="city_id" id="city_id" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-t-md border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                {{ $city->name }}
                            </button>
                       @elseif($loop->last)
                            <button type="submit" value="{{ $city->id }}" name="city_id" id="city_id" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 rounded-b-md border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                {{ $city->name }}
                            </button>
                       @else
                            <button type="submit" value="{{ $city->id }}" name="city_id" id="city_id" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                {{ $city->name }}
                            </button>
                       @endif
                    @endforeach
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>