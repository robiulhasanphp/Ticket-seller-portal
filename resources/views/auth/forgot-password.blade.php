<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Passwort zurücksetzen') }}
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session()->has('message'))
        <div class="bg-red-700 max-w-2xl h-16">
            <div class=" w-70 px-4 sm:px-6 lg:px-8">
                <div class="alert alert-success text-white w-70 pt-3 flex inline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg> <div class="px-6 mb-2">{{ session('message') }}</div>
                </div>
            </div>
        </div>
    @endif

    <form id="form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-Mail Adresse')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="USER_mail"  autofocus />
            @error('USER_mail')
            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-white">{{ $message }}</p>
            </div>
            @enderror
        </div>


        <div class="block mt-4">
            <div class="text-left">
                <a href="{{ route('register') }}"> <button type="button" class="ml-2 inline-flex items-center rounded-md border border-transparent bg-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"> {{ __('Kontoregister') }}</button></a>
            </div>
        </div>
        <div class="flex justify-end -mt-8">
            <x-primary-button>
                {{ __('E-Mail mit Reset-Link senden') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
