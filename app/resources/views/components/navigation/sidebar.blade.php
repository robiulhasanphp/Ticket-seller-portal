<div class="min-h-full" x-data="{ menuOpen: false }">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" x-show="menuOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <div class="fixed inset-0 z-40 flex" x-show="menuOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">

        <div class="relative flex w-full max-w-xs flex-1 flex-col bg-cyan-700 pt-5 pb-4">
                <div class="absolute top-0 right-0 -mr-12 pt-2" x-show="menuOpen"
                     x-transition:enter="ease-in-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in-out duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">

                    <button type="button" class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click.prevent="menuOpen = false" @keydown.window.escape="menuOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex flex-shrink-0 items-center px-4">
                    <a href="/"><img src="{{url('/images/logo_64DD17.png')}}" alt="Image" width="300" height="400"/></a>
                </div>
                <nav class="mt-5 h-full flex-shrink-0 divide-y divide-cyan-800" aria-label="Sidebar">

                    @if(! empty($brokermenu))
                    <div class="space-y-1 px-2">
                        @foreach ($brokermenu as $listItem)
                            <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                <x-slot:svg>
                                    <x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/>
                                    </x-slot>
                            </x-navigation.list-item>
                        @endforeach
                    </div>
                    @endif
                    <div class="space-y-1 px-2">
                        @foreach ($listItems as $listItem)
                            <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                <x-slot:svg>
                                    <x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/>
                                    </x-slot>
                            </x-navigation.list-item>
                        @endforeach
                    </div>
                    <div class="space-y-1 px-2">
                        @foreach ($listItems as $listItem)
                            <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                <x-slot:svg>
                                    <x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/>
                                </x-slot>
                            </x-navigation.list-item>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-6">
                        <div class="space-y-1 px-2">
                            @foreach ($additionalListItems as $listItem)
                                <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                    <x-slot:svg>
                                        <x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/>
                                    </x-slot>
                                </x-navigation.list-item>
                            @endforeach
                        </div>
                    </div>
                </nav>
            </div>
            <div class="w-14 flex-shrink-0" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex flex-grow flex-col bg-cyan-700">
            <div class="flex flex-shrink-0 items-center px-4 py-10">
                <a href="/"><img src="{{url('/images/logo_64DD17.png')}}" alt="Image" width="200" height="200"/></a>
            </div>
            <nav class="flex flex-1 flex-col divide-y divide-cyan-800" aria-label="Sidebar">
                <div class="flex grow flex-col gap-y-5   border-gray-200 px-6">
                    <nav class="flex flex-1 flex-col mt-10">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <div x-data="{ auftragoption: false }" >
                                            @if(! empty($brokermenu))
                                                <div class="space-y-1 px-2">
                                                    @foreach ($brokermenu as $listItem)
                                                        <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                                            <x-slot:svg><x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/></x-slot>
                                                        </x-navigation.list-item>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if(!empty($order_main_menu))
                                            <button type="button" @click="auftragoption = ! auftragoption" class=" flex items-center w-full text-left rounded-md  text-sm leading-6 font-semibold text-gray-700" aria-controls="sub-menu-1" aria-expanded="false">
                                                    <x-navigation.list-item name="{{ $order_main_menu['name'] }}">
                                                        <x-slot:svg><x-navigation.list-item-svg name="{{ $order_main_menu['routeName'] }}"/></x-slot>
                                                    </x-navigation.list-item>
                                                <!-- Expanded: "rotate-90 text-gray-500", Collapsed: "text-gray-400" -->
                                                <svg class="text-white ml-auto h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            @endif
                                            <!-- Expandable link section, show/hide based on state. -->

                                            <ul class="mt-1 px-2 ml-3" id="sub-menu-1"  x-show="!auftragoption">
                                                @foreach ($additionalListItems as $listItem)
                                                    <li>
                                                        <a href="{{ route($listItem['routeName']) }}">
                                                            <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                                                <x-slot:svg><x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/></x-slot>
                                                            </x-navigation.list-item>
                                                        </a>
                                                    </li>

                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>

                                    @foreach ($listItems as $listItem)
                                        <li>
                                            <a href="{{ route($listItem['routeName']) }}">
                                                <x-navigation.list-item name=" {{$listItem['name']}}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                                    <x-slot:svg>
                                                        @php
                                                            if($listItem['name'] =='Nachrichten'){
                                                                $comments =   app(\App\Http\Livewire\Message\Show::class)->getUnreadConversationsCount();
                                                                ?> <?php if ($comments >= 1){?><div class="rounded-full bg-red-600 w-6 h-6 text-center ml-3 -mt-8 absolute"> <?php  echo $comments;  ?></div><?php } ?><?php
                                                            }
                                                        @endphp
                                                        <x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/></x-slot>
                                                </x-navigation.list-item>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li>
                                        <div x-data = "{setting :false }">
                                            @if(!empty($settings))
                                            <button @click="setting = ! setting" type="button" class=" flex items-center w-full text-left rounded-md text-sm leading-6 font-semibold text-gray-700" aria-controls="sub-menu-2" aria-expanded="false">
                                                <x-navigation.list-item name="{{ $settings['name'] }}"  active="">
                                                    <x-slot:svg>
                                                        <x-navigation.list-item-svg name="{{ $settings['routeName'] }}"/>
                                                        </x-slot>
                                                </x-navigation.list-item>
                                                <!-- Expanded: "rotate-90 text-gray-500", Collapsed: "text-gray-400" -->
                                                <svg class="text-white ml-auto h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            @endif
                                            <!-- Expandable link section, show/hide based on state. -->
                                            @if(!empty($settingsItems))
                                            <ul class="mt-1 px-2 ml-3" id="sub-menu-2"  x-show="!setting">
                                                @foreach ($settingsItems as $listItem)
                                                    <li>
                                                        <a href="{{ route($listItem['routeName']) }}">
                                                            <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                                                <x-slot:svg><x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/></x-slot>
                                                            </x-navigation.list-item>
                                                        </a>
                                                    </li>
                                                @endforeach
                                                    <div x-data = "{einstellungen :false }">
                                                        @if(!empty($einstellungen))
                                                            <button @click="einstellungen = ! einstellungen" type="button" class=" flex items-center w-full text-left rounded-md text-sm leading-6 font-semibold text-gray-700" aria-controls="sub-menu-2" aria-expanded="false">
                                                                <x-navigation.list-item name="{{ $einstellungen['name'] }}"  active="">
                                                                    <x-slot:svg><x-navigation.list-item-svg name="{{ $einstellungen['routeName'] }}"/></x-slot>
                                                                </x-navigation.list-item>
                                                                <svg class="text-white ml-auto h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        @endif
                                                        <!-- Expandable link section, show/hide based on state. -->
                                                        @if(!empty($einstellungenItems))
                                                            <ul class="mt-1 px-2 ml-3" id="sub-menu-2"  x-show="!einstellungen">
                                                                @foreach ($einstellungenItems as $listItem)
                                                                    <li>
                                                                        <a href="{{ route($listItem['routeName']) }}">
                                                                            <x-navigation.list-item name="{{ $listItem['name'] }}" href="{{ route($listItem['routeName']) }}" active="{{ \Request::route()->getName() === $listItem['routeName'] }}">
                                                                                <x-slot:svg><x-navigation.list-item-svg name="{{ $listItem['routeName'] }}"/></x-slot>
                                                                            </x-navigation.list-item>
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                            </ul>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
    </div>

    <div class="flex flex-1 flex-col lg:pl-72">
        <div class="flex h-16 flex-shrink-0 border-b border-gray-200 bg-nav-color lg:border-none">
            <button type="button" class="border-r border-gray-200 px-4 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden"
                    @click.prevent="menuOpen = true">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                </svg>
            </button>
            <!-- Search bar -->
            <div class="flex flex-1 justify-between  lg:mx-auto lg:max-w-6xl">
                <div class="flex flex-1"></div>
                <div class="ml-4 flex items-center md:ml-6">
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                                   <img class="h-8 w-8 rounded-full" src="{{url('/images/user.png')}}" alt="Image"/>

                                    <span class="ml-3 hidden text-sm font-medium text-white lg:block"><span class="sr-only"> </span>@if(!empty(Auth::user()->USER_lastname)){{ Auth::user()->USER_lastname }}@else {{'Name Missing'}} @endif</span>

                                    <div class="ml-1 text-white">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
        <main>
            <div>
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
