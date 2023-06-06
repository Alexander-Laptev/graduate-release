<x-app-layout>
    @section('title', 'Корзина')

    <x-slot name="header">
        @include('layouts.header-user')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Детали заказа") }}
                    <p class="p-2 text-start border-s-2 border-purple-400">
                        {{ $date->format('d.m.Y').' '.__('в').' '.$start }}<br/>
                        {{ __('Адрес').': '.__('г.').' '.$saloon->city.__('ул.').' '.$saloon->street.', '.$saloon->home }}<br/>
                        {{ __('Номер телефона').': '.$saloon->number_phone }}<br/>
                        {{ __('Мастер').': '.$employee->post.' '.$employee->surname.' '.$employee->name.' '.$employee->patronymic}}<br/>
                        {{ __('Услуга').': '.$service->view.', '.mb_strtolower($service->subview).' '.$service->name}}<br/>
                        {{ __('Стоимость').': '.$service->cost.' руб.'}}<br/>
                        {{ __('Длительность').': '.$service->time->format('H').' ч. '.$service->time->format('i').' мин'}}<br/>
                    </p>

                    @if(!auth()->check())
                        <p>Для того чтобы записаться, вам необходимо зарегистрироваться</p>

                        <div class="flex items-center justify-center mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                {{ __('Уже зарегистрированы?') }}
                            </a>

                            <form action="{{ route('register') }}">
                                <x-primary-button class="ml-4">
                                    {{ __('Зарегистрироваться') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @else
                        <form method="POST" action="{{route('record.order.store')}}">
                            @csrf
                            <div class="flex items-center justify-center mt-4">
                                <x-primary-button class="my-5">
                                    {{ __('Записаться') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
