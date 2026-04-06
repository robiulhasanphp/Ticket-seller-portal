<div>
    <div id="loadingClass" class=""></div>
    <div class="col-span-12">
        @if (session()->has('message'))
            <div class="bg-gray-800  max-w-2xl h-12">
                <div class=" w-70 px-4 sm:px-6 lg:px-8">
                    <div class="alert alert-success text-white w-70 pt-3 flex inline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
                        </svg>
                        <div class="px-6 text-center justify-center">{{ session('message') }}</div>
                    </div>
                </div>
            </div>
        @endif
        <div class="h-1/2">
            <div class="sm:col-span-6">
                <div class="w-72 ">
                    <div x-data="{ openNewMessage: false }" class="flex mx-6">
                        <button @click="openNewMessage = ! openNewMessage" type="button" data-te-ripple-init data-te-ripple-color="light" class="px-6 w-40 my-4 bg-blue-600 flex items-center rounded bg-primary pb-2 pt-2.5 text-xs text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            Neue Nachricht
                        </button>

                        <select onchange="addLoadingClass()" class="ml-2 px-6 w-40 my-4 bg-red-700 flex items-center rounded justify-between pb-2 pt-2.5 text-xs text-white" wire:change="getConversationByType($event.target.value)" name="conversation_types">
                            <option value="all">Alle</option>
                            <option value="open">Offene</option>
                        </select>

                        <div x-show="openNewMessage">
                            @livewire('message.newmessage')
                        </div>
                    </div>

                    <div class="mb-3 mx-6 ">
                        <div class="w-full relative mb-4 flex  flex-wrap items-stretch">
                            <input wire:model.debounce.500ms="search" type="search" class="w-20 relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] "
                                placeholder="Search" aria-label="Search" aria-describedby="button-addon1"/>

                            <!--Search button-->
                            <button class="bg-red-600 relative z-[2] flex items-center rounded-r px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white" type="button" id="button-addon1" data-te-ripple-init data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="">
                    @if($searchPagination =='yes')
                        @if ($conversations->hasPages())
                            <nav role="Page navigation" aria-label="{{ __('Pagination Navigation') }}"
                                 class="flex items-center justify-between">
                            <span class="relative mb-4 z-0 inline-flex shadow-sm rounded-md mx-20">
                                {{-- Previous Page Link --}}
                                @if ($conversations->onFirstPage())
                                    <button class="flex items-center justify-center w-10 h-10 text-green-600 transition-colors duration-150 rounded-full focus:shadow-outline hover:bg-green-100 hover:bg-amber-500">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                    </button>
                                @else
                                    <a href="{{ $conversations->previousPageUrl() }}" rel="prev" class="flex items-center justify-center w-10 h-10 text-green-600 transition-colors duration-150 rounded-full focus:shadow-outline bg-green-600" aria-label="{{ __('pagination.previous') }}">
                                        <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                    </a>
                                @endif
                                {{-- Next Page Link --}}
                                @if ($conversations->hasMorePages())
                                    <a href="{{ $conversations->nextPageUrl() }}" rel="next"
                                       class="flex items-center justify-center w-10 h-10 text-green-600 transition-colors duration-150 rounded-full focus:shadow-outline bg-indigo-500 "
                                       aria-label="{{ __('pagination.previous') }}">
                                        <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                    </a>
                                @else
                                    <button
                                        class="flex items-center justify-center w-10 h-10 text-green-600 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-amber-500">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                    </button>
                                @endif
                            </span>
                            </nav>
                        @endif
                    @endif

                    <div class="w-72  h-3/4 lg:absolute overflow-y-scroll  bg-cyan-50 py-2">
                        <ul role="list" class="mx-4">
                            @foreach($conversations as $conversation)
                                <li class="row-as-link @if($conversation->user_has_unread_messages == true) bg-green-600 m-1 @endif  py-1 sm:py-2">
                                    @if($conversation->user_has_unread_messages == false)
                                        <?php  $isUnread = 'false';?>
                                    @else
                                        <?php  $isUnread = 'true';?>
                                    @endif
                                    @if(!empty($conversation_types))
                                      <a onclick="addLoadingClass()" x-on:click="$wire.getConversationByID({{$conversation->id}},{{$isUnread}})" class="  divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid  sm:divide-y-0">
                                                <div class=" group relative bg-white p-6 ">
                                                    <div>
                                                      <span class="inline-flex text-black ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                                        </svg>
                                                      </span>
                                                    </div>
                                                    <div class="mt-1">
                                                        <div class="text-base font-semibold leading-6 text-gray-900">
                                                            <div class="focus:outline-none">
                                                                <!-- Extend touch target to entire panel -->
                                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                                                                    Auftrags-ID:{{ $conversation->sale_id}}
                                                                </p>
                                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                    Ticket-ID::{{ $conversation->ticket_id }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-500">
                                                            @if(Auth::user()->isAdmin())
                                                                @if(($conversation->seller['firstname'] !='') ||($conversation->seller['lastname'] !=''))
                                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                                                                        {{ $conversation->seller['firstname']}}
                                                                        , {{ $conversation->seller['lastname']}}
                                                                    </p>
                                                                @endif
                                                            @endif
                                                            @if($conversation->sale)
                                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                    {!! $conversation->sale->detail->ticket->event->name !!}
                                                                </p>
                                                            @endif
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $conversation->subject }}</p>
                                                        </div>
                                                    </div>
                                                    <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400"
                                                        aria-hidden="true">
                                                            @if($conversation->user_has_unread_messages == false)
                                                            <?php  $isUnread = 'false';?>
                                                        @else
                                                            <?php  $isUnread = 'true';?>
                                                        @endif
                                                            <button onclick="addLoadingClass()" x-on:click="$wire.getConversationByID({{$conversation->id}},{{$isUnread}})" class="flex text-center justify-end px-6 ">
                                                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z"/></svg>
                                                            </button>
                                                        </span>
                                                </div>
                                            </a>
                                    @else
                                        <a onclick="addLoadingClass()" x-on:click="$wire.getConversationByID({{$conversation->id}},{{$isUnread}})" class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid  sm:divide-y-0">
                                            <div class=" group relative bg-white p-6">
                                                <div>
                                                    <span class="inline-flex text-black">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="mt-1">
                                                    <div class="text-base font-semibold leading-6 text-gray-900">
                                                        <div class="focus:outline-none">
                                                            <!-- Extend touch target to entire panel -->
                                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                                                                Auftrags-ID:{{ $conversation->sale_id}}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                Ticket-ID::{{ $conversation->ticket_id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-500">
                                                        @if(!Auth::user()->isAdmin())
                                                            @if(($conversation->seller['firstname'] !='') ||($conversation->seller['lastname'] !=''))
                                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-black">
                                                                    {{ $conversation->seller['firstname']}}
                                                                    , {{ $conversation->seller['lastname']}}
                                                                </p>
                                                            @endif
                                                        @endif
                                                        @if($conversation->sale)
                                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                {!! $conversation->sale->detail->ticket->event->name !!}
                                                            </p>
                                                        @endif
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            {{ $conversation->subject }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
                                                @if($conversation->user_has_unread_messages == false)
                                                        <?php  $isUnread = 'false';?>
                                                    @else
                                                        <?php  $isUnread = 'true';?>
                                                    @endif
                                                    <button onclick="addLoadingClass()" x-on:click="$wire.getConversationByID({{$conversation->id}},{{$isUnread}})" class="flex text-center justify-end px-6 ">
                                                        <svg x-on:click="$wire.getConversationByID({{$conversation->id}},{{$isUnread}})" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z"/></svg>
                                                    </button>
                                                </span>
                                            </div>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mx-auto sm:col-span-6">
                <div class="lg:col-start-2 overflow-y-scroll max-h-300">
                    @if(!empty($conversationById))
                        @foreach($conversationById as $conversation)
                            <div class="ml-72 flex-1 p:2 sm:p-6 justify-between flex flex-col">
                                <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                                    @if( $conversation['message_type'] == 'sender')
                                        <div class="chat-message ml-60 ">
                                            <div class="flex items-end">
                                                <div
                                                    class="flex w-2/3 flex-col space-y-2 text-xs w-fit mx-2 order-2 items-start">
                                                    <div>
                                                        <span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">{!! $conversation['message'] !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if( $conversation['message_type'] == 'receiver')
                                        <div class="chat-message">
                                            <div class="flex items-end justify-end">
                                                <div
                                                    class="flex w-2/3 flex-col space-y-2 text-xs w-fit mx-2 order-2 items-end">
                                                    <div>
                                                        <span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">{!! $conversation['message'] !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if(!empty($conversationById))
                        <form id="form" class="bg-blue-100 text-3xl text-white text-center fixed inset-x-1/4 bottom-0" wire:submit.prevent="storeMessage(Object.fromEntries(new FormData($event.target)))">
                            <div class="mt-2">
                                <input type="hidden" name="message_id" value="{{$conversationById[0]['message_id']}}">
                                <div class="max-w-lg flex" x-data="{closeConversation : []}">
                                    <div class="ml-2">
                                        <input type="checkbox" wire:model="closeConversation" value="1"  x-model="closeConversation" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    </div>
                                    <div class="items-center text-black">
                                        <label for="restricted" class="ml-3 block text-small text-black justify-between mr-2">Unterhaltung beenden</label>
                                    </div>
                                </div>

                                <div id="textArea">
                                    <div id="tabs-1-panel-1" class="-m-0.5 rounded-lg p-0.5" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                                        <textarea rows="5" name="message" id="comment" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                      placeholder="Add your comment..."></textarea>
                                    </div>
                                    <div id="tabs-1-panel-2" class="-m-0.5 rounded-lg p-0.5" aria-labelledby="tabs-1-tab-2" role="tabpanel" tabindex="0">
                                        <div class="border-b">
                                            <button type="submit" class="rounded-md w-80 bg-indigo-500 px-10 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                                Senden
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



























