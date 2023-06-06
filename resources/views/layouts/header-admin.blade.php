<div class="flex grid grid-cols-6 grid-flow-row">
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.dates')" :active="request()->routeIs('admin.dates')">
            {{ __('Даты') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.schedule_masters')" :active="request()->routeIs('admin.schedule_masters')">
            {{ __('Расписание сотрудников') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.employees')" :active="request()->routeIs('admin.employees')">
            {{ __('Сотрудники') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.services')" :active="request()->routeIs('admin.services')">
            {{ __('Услуги') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.saloons')" :active="request()->routeIs('admin.saloons')">
            {{ __('Салоны') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.views')" :active="request()->routeIs('admin.views')">
            {{ __('Типы') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.subviews')" :active="request()->routeIs('admin.subviews')">
            {{ __('Подтипы') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.service_employees')" :active="request()->routeIs('admin.service_employees')">
            {{ __('Услуги и сотрудники') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.posts')" :active="request()->routeIs('admin.posts')">
            {{ __('Должности') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.cities')" :active="request()->routeIs('admin.cities')">
            {{ __('Города') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('admin.roles')" :active="request()->routeIs('admin.roles')">
            {{ __('Роли') }}
        </x-nav-link>
    </div>
</div>
