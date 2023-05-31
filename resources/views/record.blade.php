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
                        <a type="button" href="{{ route('record.service') }}" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-t-md border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                            {{ __('Выбрать услугу') }}
                        </a>
                        <a type="button" href="{{ route('record.employee') }}" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                            {{ __('Выбрать мастера') }}
                        </a>
                        <a type="button" href="{{ route('record.saloon') }}" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 rounded-b-md border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                            {{ __('Выбрать салон') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
