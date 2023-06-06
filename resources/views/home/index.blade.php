<x-app-layout>
    <section>
        <div class="relative overflow-hidden bg-cover bg-no-repeat" style="
        background-position: 50%;
        background-image: url('https://img3.akspic.ru/crops/6/5/1/6/5/156156/156156-sostav-krasota-salon_krasoty-vizazhist-volosy-3840x2160.jpg');
        height: 500px;">
            <div
                class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsla(0,0%,0%,0.75)] bg-fixed">
                <div class="flex h-full items-center justify-center">
                    <div class="px-6 text-center text-white md:px-12">
                        <h1 class="mt-2 mb-16 text-5xl font-bold tracking-tight md:text-6xl xl:text-7xl">
                            <span>{{ __('Лучшее в каждом из Вас') }}</span>
                        </h1>
                        <form action="{{ route('record') }}">
                            @csrf
                            <button type="submit"
                                    class="rounded border-2 border-neutral-50 px-[46px] pt-[14px] pb-[12px] text-sm font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-100 hover:bg-neutral-100 hover:bg-opacity-10 hover:text-neutral-100 focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200"
                                    data-te-ripple-init data-te-ripple-color="light">
                                {{ __('Записаться') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(empty($views->toArray()))
        {{ __('Отсутствуют услуги в данном городе') }}
    @else
        <div class="w-full flex justify-center mb-32 py-6">
            <div class="w-3/4">
                <div class="w-full flex flex-col md:flex-row rounded overflow-hidden shadow-xl">

                    <div class="w-full md:w-1/4 h-auto">
                        <div class="top flex items-center px-5 h-16 bg-gray-950 text-white">
                            <div class="ml-3 flex flex-col text-2xl">
                                {{ __('Типы услуг') }}
                            </div>
                        </div>
                        <div class="w-full h-full sm:flex md:block">
                            @foreach($views as $view)
                                <button id="button-{{ $view->id }}" onclick="showView({{ $view->id }})" class="w-full flex justify-between items-center px-5 py-2 hover:bg-gradient-to-r from-purple-500 to-pink-500 cursor-pointer focus:outline-none">
                                    <span><i class="w-6"></i>{{ $view->name }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-full md:w-3/4">
                        <div class="top flex items-center px-5 h-16 bg-gray-950 text-white text-2xl">
                            @foreach($views as $view)
                                <div id="title-{{ $view->id }}" class="hidden">
                                    {{ $view->name }}
                                </div>
                            @endforeach
                        </div>
                        <div class="w-full px-5 py-3 max-h-screen overflow-y-auto">
                            @foreach($views as $view)
                                <div id="view-{{ $view->id }}" class="hidden">
                                    @foreach($subviews->where('view_id', '=' , $view->id)->unique('subview_id') as $subview)
                                        {{ $subview->sname }}
                                        <hr class="my-2 border-gray-500">
                                        <div class="m-4 grid grid-rows-1 grid-cols-2 place-content-between">
                                            @foreach($services->where('view_id', '=' , $view->id)->where('subview_id', '=' , $subview->subview_id)->unique('id') as $service)
                                                <div>
                                                {{ $service->name }}
                                                </div>
                                                <div class="text-end">
                                                    {{ __('Цена: ').$service->cost.' руб.' }}
                                                </div>
                                            @endforeach
                                        </div>
                                        <br/>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="w-full flex flex-col md:flex-row rounded overflow-hidden shadow-xl">
        
    </div>

        <script>
            var activeClasses = ["bg-gradient-to-r", "from-purple-500", "to-pink-500", "border-l-4","pl-4","border-gray-900"];
            var lastId = null;
            showView(1)

            function showView(id) {
                if(id == null)return
                closeLast()
                document.getElementById('view-'+id).style.display = "block"
                document.getElementById('title-'+id).style.display = "block"
                document.getElementById('button-'+id).classList.add(...activeClasses)

                lastId = id;
            }

            function closeLast() {
                if(lastId == null)return

                document.getElementById('view-'+lastId).style.display = "none"
                document.getElementById('title-'+lastId).style.display = "none"
                document.getElementById('button-'+lastId).classList.remove(...activeClasses)
            }

            /*
                //If you want to use your own identifiers replace js code

                var views = ['view-1','view-2','view-3','view-4']
                var titles = ['title-1','title-2','title-3','title-4']
                var buttons = ['button-1','button-2','button-3','button-4']
                var activeClasses = ["bg-gray-500","border-l-4","pl-4","border-gray-700"];
                close()
                showView(1)

                function showView(buttonId) {
                    "use strict";

                    close()
                    document.getElementById(views[buttonId-1]).style.display = "block"
                    document.getElementById(titles[buttonId-1]).style.display = "block"

                    document.getElementById(buttons[buttonId -1]).classList.add(...activeClasses)
                }
                function close() {
                    "use strict";

                    views.forEach(view => {
                        document.getElementById(view).style.display = "none"
                    });
                    titles.forEach(title => {
                        document.getElementById(title).style.display = "none"
                    });
                    buttons.forEach(button => {
                        document.getElementById(button).classList.remove(...activeClasses)
                    });
                }
            */
        </script>

</x-app-layout>

