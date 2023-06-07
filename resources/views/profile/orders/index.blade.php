<x-app-layout>
    @section('title', 'Мои заказы')

    <x-slot name="header">
        @include('layouts.header-profile')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    @if(empty($records->toArray()))
                        {{ __('Вы еще не пользовались услугами нашей сети салонов Icon') }}
                    @else
                        <div>
                            {{ __('Ближайшие записи') }}
                            @foreach($records->where('status', '=', 'В ожидании') as $record)
                                @if($loop->first)
                                    <div class="mt-4 rounded-t-lg border border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $record->id }}">
                                            <button
                                                class="group relative flex w-full items-center rounded-t-[15px] border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $record->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $record->id }}">
                                                {{ $record->date->format('d.m.Y').' '.__('в').' '.$record->start }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $record->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $record->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                <div class="p-2 text-start border-s-2 border-purple-400">
                                                    {{ __('Адрес').': '.__('г.').' '.$record->city.__('ул.').' '.$record->street.', '.$record->home }}<br/>
                                                    {{ __('Мастер').': '.$record->post.' '.$record->employee_surname.' '.$record->employee_name.' '.$record->employee_patronymic}}<br/>
                                                    {{ __('Услуга').': '.$record->view_name.', '.mb_strtolower($record->subview_name).' '.$record->service_name}}<br/>
                                                    {{ __('Стоимость').': '.$record->cost.' руб.'}}<br/>
                                                    {{ __('Статус').': '.$record->status}}<br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($loop->last)
                                    <div class="rounded-b-lg border border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $record->id }}">
                                            <button
                                                class="group relative flex w-full items-center border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)] [&[data-te-collapse-collapsed]]:rounded-b-[15px] [&[data-te-collapse-collapsed]]:transition-none"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $record->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $record->id }}">
                                                {{ $record->date->format('d.m.Y').' '.__('в').' '.$record->start }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $record->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $record->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                <div class="p-2 text-start border-s-2 border-purple-400">
                                                    {{ __('Адрес').': '.__('г.').' '.$record->city.__('ул.').' '.$record->street.', '.$record->home }}<br/>
                                                    {{ __('Мастер').': '.$record->post.' '.$record->employee_surname.' '.$record->employee_name.' '.$record->employee_patronymic}}<br/>
                                                    {{ __('Услуга').': '.$record->view_name.', '.mb_strtolower($record->subview_name).' '.$record->service_name}}<br/>
                                                    {{ __('Стоимость').': '.$record->cost.' руб.'}}<br/>
                                                    {{ __('Статус').': '.$record->status}}<br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="border border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $record->id }}">
                                            <button
                                                class="group relative flex w-full items-center rounded-none border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $record->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $record->id }}">
                                                {{ $record->date->format('d.m.Y').' '.__('в').' '.$record->start }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $record->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $record->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                <div class="p-2 text-start border-s-2 border-purple-400">
                                                    {{ __('Адрес').': '.__('г.').' '.$record->city.__('ул.').' '.$record->street.', '.$record->home }}<br/>
                                                    {{ __('Мастер').': '.$record->post.' '.$record->employee_surname.' '.$record->employee_name.' '.$record->employee_patronymic}}<br/>
                                                    {{ __('Услуга').': '.$record->view_name.', '.mb_strtolower($record->subview_name).' '.$record->service_name}}<br/>
                                                    {{ __('Стоимость').': '.$record->cost.' руб.'}}<br/>
                                                    {{ __('Статус').': '.$record->status}}<br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ __('Архив') }}
                            @foreach($records->where('status', '=', 'Завершён')->sortByDesc('date') as $record)
                                @if($loop->first)
                                    <div class="mt-4 rounded-t-lg border border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $record->id }}">
                                            <button
                                                class="group relative flex w-full items-center rounded-t-[15px] border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $record->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $record->id }}">
                                                {{ $record->date->format('d.m.Y').' '.__('в').' '.$record->start }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $record->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $record->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                <div class="p-2 text-start border-s-2 border-purple-400">
                                                    {{ __('Адрес').': '.__('г.').' '.$record->city.__('ул.').' '.$record->street.', '.$record->home }}<br/>
                                                    {{ __('Мастер').': '.$record->post.' '.$record->employee_surname.' '.$record->employee_name.' '.$record->employee_patronymic}}<br/>
                                                    {{ __('Услуга').': '.$record->view_name.', '.mb_strtolower($record->subview_name).' '.$record->service_name}}<br/>
                                                    {{ __('Стоимость').': '.$record->cost.' руб.'}}<br/>
                                                    {{ __('Статус').': '.$record->status}}<br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($loop->last)
                                    <div class="rounded-b-lg border border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $record->id }}">
                                            <button
                                                class="group relative flex w-full items-center border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)] [&[data-te-collapse-collapsed]]:rounded-b-[15px] [&[data-te-collapse-collapsed]]:transition-none"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $record->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $record->id }}">
                                                {{ $record->date->format('d.m.Y').' '.__('в').' '.$record->start }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $record->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $record->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                <div class="p-2 text-start border-s-2 border-purple-400">
                                                    {{ __('Адрес').': '.__('г.').' '.$record->city.__('ул.').' '.$record->street.', '.$record->home }}<br/>
                                                    {{ __('Мастер').': '.$record->post.' '.$record->employee_surname.' '.$record->employee_name.' '.$record->employee_patronymic}}<br/>
                                                    {{ __('Услуга').': '.$record->view_name.', '.mb_strtolower($record->subview_name).' '.$record->service_name}}<br/>
                                                    {{ __('Стоимость').': '.$record->cost.' руб.'}}<br/>
                                                    {{ __('Статус').': '.$record->status}}<br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="border border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $record->id }}">
                                            <button
                                                class="group relative flex w-full items-center rounded-none border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $record->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $record->id }}">
                                                {{ $record->date->format('d.m.Y').' '.__('в').' '.$record->start }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $record->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $record->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                <div class="p-2 text-start border-s-2 border-purple-400">
                                                    {{ __('Адрес').': '.__('г.').' '.$record->city.__('ул.').' '.$record->street.', '.$record->home }}<br/>
                                                    {{ __('Мастер').': '.$record->post.' '.$record->employee_surname.' '.$record->employee_name.' '.$record->employee_patronymic}}<br/>
                                                    {{ __('Услуга').': '.$record->view_name.', '.mb_strtolower($record->subview_name).' '.$record->service_name}}<br/>
                                                    {{ __('Стоимость').': '.$record->cost.' руб.'}}<br/>
                                                    {{ __('Статус').': '.$record->status}}<br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
