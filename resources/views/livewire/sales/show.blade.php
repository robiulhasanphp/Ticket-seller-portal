<div>
    <div id="loadingClass" class=""></div>
    <div  class="sm:block">
        <div class="mx-auto w-full px-4 sm:lg:px-8">
            <div class="block relative py-6">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
                <input placeholder="Search" type="text"  wire:model.debounce.800ms="searchTerm" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>


            @if (session()->has('message'))
                <div class="bg-gray-800  max-w-2xl h-12">
                    <div class=" w-70 px-4 sm:px-6 lg:px-8">
                        <div class="alert alert-success text-black w-70 pt-3 flex inline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
                            </svg>
                            <div class="px-6 text-white">{{ session('message') }}</div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-2 flex flex-col">
                <div class="min-w-full  align-middle sm:rounded-lg">
                    <div x-data="{ openNewMessage: false }">
                        <table  class="min-w-full">
                            <thead>
                            <tr class="bg-indigo-500 text-white">
                                <th class="py-3 text-center text-sm font-semibold">Name</th>
                                <th class="py-3 text-center text-sm font-semibold">Email</th>
                                <th class="py-3 text-center text-sm font-semibold">Telefon</th>
                                <th class="py-3 text-center text-sm font-semibold">TurboTB</th>
                                <th class="py-3 text-center text-sm font-semibold">Details</th>
                                <th class="py-3 text-center text-sm font-semibold">EMail</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">

                            @foreach($sellers as $seller)
                                <tr class="row-as-link bg-white">
                                    @if(($seller['lastname']  !='')||($seller['firstname']  !=''))
                                        <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"><a :href="'imitate-user/' + {{ $seller['id'] }}">
                                                <span class="text-sky-500">{{ $seller['lastname'] }},{{ $seller['firstname'] }}</span></a>
                                        </td>
                                    @else
                                        <td  class="whitespace-nowrap py-4"></td>
                                    @endif
                                    @if($seller['email'] !='')
                                        <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500">
                                            <span class="font-medium text-gray-900">{{ $seller['email'] }}</span>
                                        </td>
                                    @else
                                        <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500"></td>
                                    @endif
                                    @if($seller['address'] !=null)
                                        <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                            <span class="font-medium text-gray-900">{{ $seller['address']['USAD_phone'] }}</span>
                                        </td>
                                    @else
                                        <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                    @endif


                                    @if(($seller['rights'] !='') && ($seller['rights']['USAR_only_web_version'] !=''))
                                        <td  class="whitespace-nowrap py-4">
                                            @if($seller['rights']['USAR_only_web_version'] ==0)
                                                <span class="flex justify-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-emerald-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg></span>
                                            @else
                                                <span class="flex justify-center"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" w-6 h-6 stroke-red-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg></span>
                                            @endif
                                        </td>
                                    @else
                                        <td  class="whitespace-nowrap py-4"></td>
                                    @endif
                                        <td class="whitespace-nowrap py-4">
                                            <span class="flex justify-center">
                                                <button onclick="addLoadingClass()" wire:click="showSellerDetailDialog({{ $seller['id'] }})"  @click.prevent="menuOpen = true"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-700">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg></button>
                                            </span>
                                        </td>

                                        <td onclick="addLoadingClass()" class="whitespace-nowrap py-4 text-center">
                                            <button class="" @click="openNewMessage = ! openNewMessage" wire:click="showSellerData({{ $seller['id'] }})"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-amber-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                                </svg>
                                            </button>
                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="menuOpen" @click.outside="menuOpen = false" x-cloak>
                            @if (!empty($sellerdata))
                                <div class="relative z-10 border-gray-300" aria-labelledby="modal-title">
                                    <div class="fixed inset-0 z-10 overflow-y-auto">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                            <div class="sticky transform overflow-hidden rounded-lg bg-gray-400 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-1/2 sm:p-6">
                                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                                    <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
                                                        <button @click="menuOpen = ! menuOpen"  wire:click="closeSellerDetailDialog()" type="button" class="flex text-right text-white bg-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-700 dark:hover:text-white" data-modal-hide="staticModal">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                        <div class="mx-auto max-w-full  bg-white">
                                                            <div class="border-t border-gray-100 pb-4 text-center text-sm sm:px-14">
                                                                    <p class="mt-4 font-semibold text-gray-900">Verkäufer-Details</p>
                                                                </div>
                                                            <ul class="scroll-pt-11 scroll-pb-2 space-y-2  pb-2" id="options" role="listbox">
                                                                    <li>
                                                                        <h2 class="bg-gray-400 text-white py-2.5 px-4 text-xs font-semibold">Clients</h2>
                                                                        <ul class="mt-2 text-sm text-gray-800">
                                                                            <!-- Active: "bg-indigo-600 text-white" -->
                                                                            @if($sellerdata[0]['USER_lastname'] !='')
                                                                                <li class="cursor-default select-none px-4 py-2 font-bold border-bottom text-fuchsia-700">{{$sellerdata[0]['USER_name']}}, {{$sellerdata[0]['USER_lastname']}}</li>
                                                                            @endif

                                                                            @if($sellerdata[0]['address'] !='')
                                                                                @if($sellerdata[0]['address']['USAD_street'] !='')
                                                                                    <li  class="cursor-default select-none px-4 py-1">{{$sellerdata[0]['address']['USAD_street']}}</li>
                                                                                @endif
                                                                                @if($sellerdata[0]['address']['USAD_street2'] !='')
                                                                                    <li class="cursor-default select-none px-4 py-1">{{$sellerdata[0]['address']['USAD_street2']}}</li>
                                                                                @endif
                                                                                @if($sellerdata[0]['address']['USAD_street3'] !='')
                                                                                    <li  class="cursor-default select-none px-4 py-1">{{$sellerdata[0]['address']['USAD_street3']}}</li>
                                                                                @endif
                                                                                @if($sellerdata[0]['address']['USAD_zip'] !='') @elseif($sellerdata[0]['address']['USAD_city'] !='')
                                                                                    <li class="cursor-default select-none px-4 py-1">{{$sellerdata[0]['address']['USAD_zip']}}, {{$sellerdata[0]['address']['USAD_city']}}</li>
                                                                                @endif
                                                                            @endif
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <h2 class="bg-gray-400 text-white py-2.5 px-4 text-xs font-semibold">Bank</h2>
                                                                        @if($sellerdata[0]['bank_data'] !=null)
                                                                            <ul class="mt-2 text-sm text-gray-800">
                                                                                <!-- Active: "bg-indigo-600 text-white" -->
                                                                                @if($sellerdata[0]['bank_data']['account_holder'] !='')
                                                                                    <li  class="cursor-default select-none px-4 py-1"><strong>Kontoinhaber:</strong> {{$sellerdata[0]['bank_data']['account_holder']}}</li>
                                                                                @endif
                                                                                @if($sellerdata[0]['bank_data']['bank_name'] !='')
                                                                                    <li class="cursor-default select-none px-4 py-1"><strong>Bank:</strong>{{$sellerdata[0]['bank_data']['bank_name']}}</li>
                                                                                @endif
                                                                                @if($sellerdata[0]['bank_data']['iban'] !='')
                                                                                    <li class="cursor-default select-none px-4 py-1"><strong>IBAN:</strong>{{$sellerdata[0]['bank_data']['iban']}}</li>
                                                                                @endif
                                                                                @if($sellerdata[0]['bank_data']['bic'] !='')
                                                                                    <li class="cursor-default select-none px-4 py-1"><strong>BIC:</strong>{{$sellerdata[0]['bank_data']['bic']}}</li>
                                                                                @endif
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div x-show="openNewMessage" x-cloak>
                            {{--here is include newmessage search--}}
                            @if(!empty($sellerEmail))
                            @livewire('message.newmessage', ['sellerId' => $sellerId,'sellerEmail' => $sellerEmail])
                            @endif
                            {{--end include newmessage search--}}
                        </div>
                    </div>
                    <!-- Pagination -->
                    @if(($searchPagination ==''))
                    <nav class=" border-t border-gray-200 bg-white px-4 py-3 sm:px-6" aria-label="Pagination">
                        @if ($sellers->hasPages())
                            <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                                @if ($sellers->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                {!! __('früher') !!}
            </span>
                                @else
                                    <a href="{{ $sellers->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        {!! __('früher') !!}

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                                        </svg>

                                    </a>
                                @endif
                                {{ "Seite " . $sellers->currentPage() . "  von  " . $sellers->lastPage() }}
                                @if ($sellers->hasMorePages())
                                    <a href="{{ $sellers->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                        {!! __('nächste') !!}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                                        </svg>

                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                {!! __('nächste') !!}
            </span>
                                @endif
                            </nav>
                        @endif
                    </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>



