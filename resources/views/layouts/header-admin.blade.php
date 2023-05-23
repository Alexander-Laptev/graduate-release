<div class="flex">
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.services')" :active="request()->routeIs('admin.services')">
            {{ __('Услуги') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.employees')" :active="request()->routeIs('admin.employees')">
            {{ __('Работники') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.posts')" :active="request()->routeIs('admin.posts')">
            {{ __('Должности') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.saloons')" :active="request()->routeIs('admin.saloons')">
            {{ __('Салоны') }}
        </x-nav-link>
    </div>
</div>
