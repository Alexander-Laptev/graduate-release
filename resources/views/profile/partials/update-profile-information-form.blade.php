<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Информация профиля') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Обновите информацию профиля своей учетной записи, адрес электронной почты и номер телефона.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="surname" :value="__('Фамилия')" />
            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', $customer->surname)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>

        <div>
            <x-input-label for="patronymic" :value="__('Отчество')" />
            <x-text-input id="patronymic" name="patronymic" type="text" class="mt-1 block w-full" :value="old('patronymic', $customer->patronymic)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('patronymic')" />
        </div>

        <div>
            <x-input-label for="login" :value="__('Логин')" />
            <x-text-input id="login" name="login" type="text" class="mt-1 block w-full" :value="old('login', $user->login)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('login')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Номер телефона')" />
            <x-text-input id="phone" name="name" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="birthday" :value="__('День рождения')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $customer->birthday)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="picture" :value="__('Фото')" />
            <x-text-input id="picture" name="picture" type="file" class="mt-1 block w-full" :value="old('picture', $customer->picture)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('picture')" />
        </div>

        <div>
            <x-input-label for="card" :value="__('Карта')" />
            <x-text-input id="card" name="card" type="text" disabled="true" class="mt-1 block w-full" :value="old('card', $customer->card)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('card')" />
        </div>

        <div>
            <x-input-label for="role_id" :value="__('Роль')" />
            <x-text-input id="role_id" name="card" type="number" class="mt-1 block w-full" :value="old('role_id', $user->role_id)" autocomplete="on" />
            <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Сохранено.') }}</p>
            @endif
        </div>
    </form>
</section>
