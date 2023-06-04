<x-app-layout>
    @section('title', 'Добавление сотрудника')

    <x-slot name="header">
        @include('layouts.header-admin')
    </x-slot>
    <div class="min-h-0 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full lg:max-w-3xl sm:max-w-md  mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('admin.employees.store')}}" enctype="multipart/form-data">
            @csrf
                <div>
                    <x-input-label for="user_id" :value="__('Учетная запись')" />
                    <x-select id="user_id" class="mt-1 w-full" name="user_id" autofocus autocomplete="off">
                        <option></option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->phone }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="name" :value="__('Имя')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autocomplete="on"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="surname" :value="__('Фамилия')" />
                    <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="patronymic" :value="__('Отчество')" />
                    <x-text-input id="patronymic" class="block mt-1 w-full" type="text" name="patronymic" :value="old('patronymic')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="birthday" :value="__('День рождения')" />
                    <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="workday" :value="__('День работы')" />
                    <x-text-input id="workday" class="block mt-1 w-full" type="date" name="workday" :value="old('workday')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('workday')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="gender" :value="__('Пол')" />
                    <x-select id="gender" class="mt-1 w-full" name="gender" :value="old('gender')" required autofocus autocomplete="off">
                            <option value="0">{{ __('Мужской') }}</option>
                            <option value="1">{{ __('Женский') }}</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="experience" :value="__('Опыт работы')" />
                    <x-text-input id="experience" class="block mt-1 w-full" type="number" name="experience" :value="old('experience')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="address" :value="__('Адрес')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="number_phone" :value="__('Номер телефона')" />
                    <x-text-input id="number_phone" class="block mt-1 w-full" type="text" name="number_phone" :value="old('number_phone')" required autocomplete="on" />
                    <x-input-error :messages="$errors->get('number_phone')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="post_id" :value="__('Должность')" />
                    <x-select id="post_id" class="mt-1 w-full" name="post_id" :value="old('post_id')" required autofocus autocomplete="off">
                        @foreach($posts as $post)
                            <option value="{{ $post->id }}">{{ $post->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('post_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="saloon_id" :value="__('Салон')" />
                    <x-select id="saloon_id" class="mt-1 w-full" name="saloon_id" :value="old('saloon_id')" required autofocus autocomplete="off">
                        @foreach($saloons as $saloon)
                            <option value="{{ $saloon->id }}">г. {{ $saloon->city }},  ул. {{ $saloon->street }} д. {{ $saloon->home }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('saloon_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="picture" :value="__('Фото')" />
                    <x-text-input id="picture" class="block mt-1 w-full" type="file" accept="image/png, image/jpeg" name="picture" :value="old('picture')" autocomplete="on" />
                    <x-input-error :messages="$errors->get('picture')" class="mt-2" />
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
