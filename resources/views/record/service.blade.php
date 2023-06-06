<x-app-layout>
    @section('title', 'Услуги')

    <x-slot name="header">
        @include('layouts.header-user')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Выберите услугу") }}

                    <form action="{{ route('record.service.store')}}" method="POST">
                        @csrf
                            @foreach($views as $view)
                                @if($loop->first)
                                    <div class="mt-4 rounded-t-lg border border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $view->id }}">
                                            <button
                                                class="group relative flex w-full items-center rounded-t-[15px] border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $view->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $view->id }}">
                                                {{ $view->name }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $view->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $view->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                @foreach($services->where('view_id', '=' , $view->id) as $service)
                                                    <button type="submit" value="{{ $service->id }}" name="service_id" id="service_id" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 bg-white text-gray-700 align-middle hover:bg-gradient-to-r from-purple-500 to-pink-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                                        {{ $service->name }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @elseif($loop->last)
                                    <div class="rounded-b-lg border border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $view->id }}">
                                            <button
                                                class="group relative flex w-full items-center border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)] [&[data-te-collapse-collapsed]]:rounded-b-[15px] [&[data-te-collapse-collapsed]]:transition-none"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $view->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $view->id }}">
                                                {{ $view->name }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $view->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $view->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                @foreach($services->where('view_id', '=' , $view->id) as $service)
                                                    <button type="submit" value="{{ $service->id }}" name="service_id" id="service_id" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 bg-white text-gray-700 align-middle hover:bg-gradient-to-r from-purple-500 to-pink-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                                        {{ $service->name }}
                                                    </button>
                                                @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="border border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                        <h2 class="mb-0" id="heading{{ $view->id }}">
                                            <button
                                                class="group relative flex w-full items-center rounded-none border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                type="button"
                                                data-te-collapse-init
                                                data-te-collapse-collapsed
                                                data-te-target="#collapse{{ $view->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse{{ $view->id }}">
                                                {{ $view->name }}
                                                <span class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $view->id }}" class="!visible hidden" data-te-collapse-item aria-labelledby="heading{{ $view->id }}">
                                            <div class="flex flex-col justify-center rounded-md">
                                                @foreach($services->where('view_id', '=' , $view->id) as $service)
                                                    <button type="submit" value="{{ $service->id }}" name="service_id" id="service_id" class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 bg-white text-gray-700 align-middle hover:bg-gradient-to-r from-purple-500 to-pink-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
                                                        {{ $service->name }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
