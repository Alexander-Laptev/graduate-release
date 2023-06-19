<x-app-layout>
    @section('title', 'Добавление города')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>
    <div class="min-h-0 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full lg:max-w-3xl sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('record.customer.store')}}">
                @csrf
                <div>
                    <x-input-label for="number_phone" :value="__('Номер телефона клиента')" />
                    <x-text-input id="number_phone" class="block mt-1 w-full" type="text" name="number_phone" :value="old('number_phone')" required autofocus autocomplete="on" />
                    <x-input-error :messages="$errors->get('number_phone')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="name" :value="__('Имя клиента')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
