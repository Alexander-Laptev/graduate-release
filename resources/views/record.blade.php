<x-app-layout>
    <x-slot name="header">
        @include('layouts.header-user')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Записаться") }}

                    <div class="mt-4 flex flex-col justify-center rounded-md shadow-sm">
                        <a type="button" href="{{ route('record.service') }}" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-t-md border  bg-white text-black align-middle hover:bg-gradient-to-r from-purple-500 to-pink-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                            {{ __('Выбрать услугу') }}
                        </a>
                        <a type="button" href="{{ route('record.employee') }}" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 border  bg-white text-black align-middle hover:bg-gradient-to-r from-purple-500 to-pink-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                            {{ __('Выбрать мастера') }}
                        </a>
                        @if(!empty(auth()->user()) && auth()->user()->is_admin == true)
                            <a type="button" href="{{ route('record.customer') }}" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 border  bg-white text-black align-middle hover:bg-gradient-to-r from-purple-500 to-pink-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                {{ __('Указать клиента') }}
                            </a>
                        @endif
                        <a type="button" href="{{ route('record.saloon') }}" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 rounded-b-md border bg-white text-black align-middle hover:bg-gradient-to-r from-purple-500 to-pink-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                            {{ __('Изменить салон') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
