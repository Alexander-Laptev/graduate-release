<x-app-layout>
    @section('title', 'Дата')

    <x-slot name="header">
        @include('layouts.header-user')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    {{ __("Выберите дату") }}

                    <form action="{{ route('record.date.store')}}" method="POST">
                        @csrf
                        <div class="my-4 grid gap-4 grid-rows-1 grid-flow-col w-full">
                            @foreach($dates as $date)
                                <div>
                                    @if(session('date_id') == $date->id)
                                        <button value="{{ $date->id }}" name="date_id" id="date_id" type="submit" class="bg-gray-200 rounded-[0.4375rem] p-2">
                                            {{ $date->date->translatedFormat('j F') }}<br/>
                                            {{ $date->date->Format('Y') }}
                                        </button>

                                    @else
                                        <button value="{{ $date->id }}" name="date_id" id="date_id" type="submit">
                                            {{ $date->date->translatedFormat('j F') }}<br/>
                                            {{ $date->date->Format('Y') }}
                                        </button>

                                    @endif
                                </div>
                            @endforeach

                        </div>
                        <div class="text-start">
                            <div class="my-4 grid gap-4 grid-cols-4 w-full">
                                @foreach($hours as $hour)
                                    <button id="multiLevelDropdownButton{{$hour['hour']}}" data-dropdown-toggle="dropdown{{$hour['hour']}}" class="text-white bg-gray-700 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">{{ $hour['hour'].':00' }} <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown{{$hour['hour']}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton{{$hour['hour']}}">
                                            @for($i = 0; $i < 4; $i++)

                                                @if(!empty($oneMinutes->where('hour', '=', $hour['hour'])->toArray()) && $i == 0)
                                                    <button id="doubleDropdownButton1{{$hour['hour']}}" data-dropdown-toggle="doubleDropdown1{{$hour['hour']}}" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].': 00' }} <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                                                    <div id="doubleDropdown1{{$hour['hour']}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton1{{$hour['hour']}}">

                                                            @foreach($oneMinutes->where('hour', '=', $hour['hour']) as $oneMinute)
                                                                <li>
                                                                    <button value="{{ $hour['hour'].':'.$oneMinute['minute'] }}" name="start" id="start" type="submit" class="w-full text-start block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].':'.$oneMinute['minute'] }}</button>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>

                                                @elseif(!empty($twoMinutes->where('hour', '=', $hour['hour'])->toArray()) && $i == 1)
                                                    <button id="doubleDropdownButton2{{$hour['hour']}}" data-dropdown-toggle="doubleDropdown2{{$hour['hour']}}" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].': 15' }}<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                                                    <div id="doubleDropdown2{{$hour['hour']}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton2{{$hour['hour']}}">

                                                            @foreach($twoMinutes->where('hour', '=', $hour['hour']) as $twoMinute)
                                                                <li>
                                                                    <button value="{{ $hour['hour'].':'.$twoMinute['minute'] }}" name="start" id="start" type="submit" class="w-full text-start block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].':'.$twoMinute['minute'] }}</button>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>

                                                @elseif(!empty($threeMinutes->where('hour', '=', $hour['hour'])->toArray()) && $i == 2)
                                                    <button id="doubleDropdownButton3{{$hour['hour']}}" data-dropdown-toggle="doubleDropdown3{{$hour['hour']}}" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].': 30' }}<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                                                    <div id="doubleDropdown3{{$hour['hour']}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton3{{$hour['hour']}}">

                                                            @foreach($threeMinutes->where('hour', '=', $hour['hour']) as $threeMinute)
                                                                <li>
                                                                    <button value="{{ $hour['hour'].':'.$threeMinute['minute'] }}" name="start" id="start" type="submit" class="w-full text-start block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].':'.$threeMinute['minute'] }}</button>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>

                                                @elseif(!empty($fourMinutes->where('hour', '=', $hour['hour'])->toArray()) && $i == 3)
                                                    <button id="doubleDropdownButton4{{$hour['hour']}}" data-dropdown-toggle="doubleDropdown4{{$hour['hour']}}" data-dropdown-placement="right-start" type="button" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].': 45' }}<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                                                    <div id="doubleDropdown4{{$hour['hour']}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton4{{$hour['hour']}}">

                                                            @foreach($fourMinutes->where('hour', '=', $hour['hour']) as $fourMinute)
                                                                <li>
                                                                    <button value="{{ $hour['hour'].':'.$fourMinute['minute'] }}" name="start" id="start" type="submit" class="w-full text-start block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $hour['hour'].':'.$fourMinute['minute'] }}</button>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                @endif
                                            @endfor
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
