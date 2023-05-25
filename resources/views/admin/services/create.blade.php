<x-app-layout>
    @section('title', 'Добавление услуги')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>
    <div class="min-h-0 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full lg:max-w-3xl sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('admin.services.store')}}">
            @csrf
                <div>
                    <x-input-label for="name" :value="__('Наименование')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="on" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="view_id" :value="__('Тип')" />
                    <x-select id="view_id" class="mt-1 w-full" name="view_id" :value="old('view_id')" required autofocus autocomplete="on">
                        @foreach($views as $view)
                            <option value="{{ $view->id }}">{{ $view->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('view_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="subview_id" :value="__('Подтип')" />
                    <x-select id="subview_id" class="mt-1 w-full" name="subview_id" :value="old('subview_id')" required autofocus autocomplete="on">
                        @foreach($subviews as $subview)
                            <option value="{{ $subview->id }}">{{ $subview->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('subview_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="cost" :value="__('Стоимость')" />
                    <x-text-input id="cost" class="block mt-1 w-full" type="number" name="cost" :value="old('cost')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="time" :value="__('Время выполнения')" />
                    <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" :value="old('time')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
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
