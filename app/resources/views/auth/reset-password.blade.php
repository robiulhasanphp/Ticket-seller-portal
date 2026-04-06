<x-guest-layout>
    <div class="py-5">
        <div id="cards" class="flex border py-2  pr-10">
            <div><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                </svg>
            </div>
            <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Anmeldung per Kunden-Account”</p>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="bg-gray-800  max-w-2xl h-16">
            <div class=" w-70 px-4 sm:px-6 lg:px-8">
                <div class="alert alert-success text-white w-70 pt-3 flex inline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg> <div class="px-6">{{ session('message') }}</div>
                </div>
            </div>
        </div>
    @endif
    <form method="POST" class="px-6  mb-12" action="{{ route('createNewPassword') }}">
        @csrf
        <div>
          <input type="hidden" name="token" value="{{ $token }}">
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input class="block mt-1 w-full" type="email" name="USER_mail" required/>
                @error('USER_mail')
                <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    <p class="text-white">{{ $message }}</p>
                </div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input  class="block mt-1 w-full" type="password" name="USER_password" required/>
            @error('USER_password')
            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-white">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input class="block mt-1 w-full" type="password" name="confirm_password" required/>
            @error('confirm_password')
            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p class="text-white">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 pr-2" href="{{ route('login') }}">
                {{ __('Already kennwort ändern?') }}
            </a>
            <div class="float-right">
                <x-primary-button class="ml-4">{{ __('Kennwort ändern') }}</x-primary-button>
            </div>

        </div>
    </form>
</x-guest-layout>
