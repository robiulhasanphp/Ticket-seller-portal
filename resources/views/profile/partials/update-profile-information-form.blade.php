<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profil Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Aktualisieren Sie die Profilinformationen und die E-Mail-Adresse Ihres Kontos.") }}
        </p>
    </header>
    <form method="post" action="{{ route('ProfileUpdate') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <x-input-label for="name" :value="__('Familienname, Nachname')" />
            <x-text-input id="name" name="USER_lastname" type="text" class="mt-1 block w-full" :value="old('name', $user->USER_lastname)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('USER_lastname')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="USER_mail" type="email" class="mt-1 block w-full" :value="old('email', $user->USER_mail)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('USER_mail')" />

        </div>
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-green-500">{{ __('Updateinformation') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
