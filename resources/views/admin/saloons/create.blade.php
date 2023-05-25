<x-app-layout>
    @section('title', 'Добавление салона')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>
    <div class="min-h-0 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full lg:max-w-3xl sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('admin.saloons.store')}}" enctype="multipart/form-data">
            @csrf
                <div>
                    <x-input-label for="city_id" :value="__('Город')" />
                    <x-select id="city_id" class="mt-1 w-full" name="city_id" :value="old('city_id')" required autofocus autocomplete="on">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="street" :value="__('Улица')" />
                    <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('street')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="home" :value="__('Дом')" />
                    <x-text-input id="home" class="block mt-1 w-full" type="text" name="home" :value="old('home')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('home')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="picture" :value="__('Фото')" />
                    <x-text-input id="picture" class="block mt-1 w-full" type="file" accept="image/png, image/jpeg" name="picture" :value="old('picture')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="open" :value="__('Время открытия')" />
                    <x-text-input id="open" class="block mt-1 w-full" type="time" name="open" :value="old('open')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('open')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="close" :value="__('Время закрытия')" />
                    <x-text-input id="close" class="block mt-1 w-full" type="time" name="close" :value="old('close')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('close')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="number_phone" :value="__('Номер телефона')" />
                    <x-text-input id="number_phone" class="block mt-1 w-full" type="text" name="number_phone" :value="old('number_phone')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('number_phone')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Описание')" />
                    <x-text-area id="description" class="block mt-1 w-full" type="text" name="description" :value="('description')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
