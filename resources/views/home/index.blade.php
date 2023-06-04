<x-app-layout>
    <section class="mb-40">
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
</x-app-layout>

