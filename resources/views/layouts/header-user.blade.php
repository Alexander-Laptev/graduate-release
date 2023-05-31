<div class="flex">
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('record.city')" :active="request()->routeIs('record.city')">
            {{ __('Города') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('record.saloon')" :active="request()->routeIs('record.saloon')">
            {{ __('Салоны') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('record.employee')" :active="request()->routeIs('record.employee')">
            {{ __('Мастера') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('record.service')" :active="request()->routeIs('record.service')">
            {{ __('Услуги') }}
        </x-nav-link>
    </div>
</div>
