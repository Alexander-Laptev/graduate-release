<div class="flex">
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            {{ __('Профиль') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('home.index')" :active="request()->routeIs('home.index')">
            {{ __('Мои заказы') }}
        </x-nav-link>
    </div>
</div>
