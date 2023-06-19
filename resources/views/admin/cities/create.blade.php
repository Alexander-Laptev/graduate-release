<x-app-layout>
    @section('title', 'Добавление города')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>
    <div class="min-h-0 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full lg:max-w-3xl sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('admin.cities.store')}}">
            @csrf
                <div>
                    <x-input-label for="name" :value="__('Наименование')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="on" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="domain_name" :value="__('Доменное имя')" />
                    <x-text-input id="domain_name" class="block mt-1 w-full" type="text" name="domain_name" :value="old('domain_name')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('domain_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="timezone" :value="__('Часовой пояс')" />
                    <x-text-input id="timezone" class="block mt-1 w-full" type="number" name="timezone" :value="old('timezone')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('timezone')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="my-5">
                        {{ __('Добавить') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
