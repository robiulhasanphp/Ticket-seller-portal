<div>
    <div id="loadingClass" class=""></div>
    <div class="sm:col-span-6 px-8">
        <div class="py-5">
            <div id="cards" class="flex border py-1  pr-10">
                <div><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Meine Aufträge - in Bearbeitung”</p>
            </div>
        </div>
    </div>
    <div class="sm:col-span-6 px-8">
        <div class=" block relative">
                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </span>
            <input placeholder="Suche nach ID, Event, Ticket ..." wire:model.debounce.500m="search" class="py-2 appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-1 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"/>
        </div>
    </div>
    <div class="hidden sm:block">
        <div class="mx-auto w-full px-4 sm:lg:px-8">
            <div class="mt-2 flex flex-col">
                <div class="min-w-full overflow-x-auto align-middle shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">ID</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Event</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Anzahl</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Ticket</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Preis</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($saleData as $underTest)
                            <tr class="bg-white">
                                @if($underTest->ORDR_id  !='')
                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                        <span class="text-sky-500">{{ $underTest->ORDR_id }}</span>
                                    </td>
                                @endif
                                @if($underTest->detail->ticket->event->name !='')
                                    <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500">
                                        <span class="font-medium text-gray-900">{!! $underTest->detail->ticket->event->name !!}</span>
                                    </td>
                                @else
                                    <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500"></td>
                                @endif
                                @if($underTest->detail->quantity !=null)
                                    <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                        <span class="font-medium text-gray-900">{{ $underTest->detail->quantity }}</span>
                                    </td>
                                @else
                                    <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                @endif
                                @if($underTest->detail->ticket->category  !=null)
                                    <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                        <span class="font-medium text-gray-900">{{ $underTest->detail->ticket->category }}</span>
                                    </td>
                                @else
                                    <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                @endif
                                @if($underTest['detail']['brokerTotal'] !=null)
                                    <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                        <span class="font-medium text-gray-900">{{ ($underTest->detail->brokerTotal != '0.00') ? $underTest->detail->brokerTotal : ($underTest->detail->brokerTotal - $underTest->detail->shippingPrice).toFixed(2) }} {{ $underTest->detail->currency }}</span>
                                    </td>
                                @else
                                    <td  class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                @endif
                                <td class="whitespace-nowrap py-4">
                                    <span class="flex justify-center"><button onclick="addLoadingClass()" wire:click="showSalesById({{ $underTest->ORDR_id}})"  @click.prevent="menuOpen = true"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                                        </button></span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="menuOpen" @click.outside="menuOpen = false">
                        @if (is_array($saleDataById))
                            <div class="relative z-10 border-gray-300" aria-labelledby="modal-title">
                                <div class="fixed inset-0 z-10 overflow-y-auto">
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <div class="sticky transform overflow-hidden rounded-lg bg-gray-400 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-1/2 sm:p-6">
                                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                                <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
                                                    <button @click="menuOpen = ! menuOpen"  wire:click="closeDetailDialog()"   type="button" class="flex text-right text-white bg-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-700 dark:hover:text-white" data-modal-hide="staticModal">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="mx-auto transform">
                                                        <div class="py-5">
                                                            <div id="cards" class="flex border py-2 pr-10">
                                                                <div><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                                                                    </svg>
                                                                </div>
                                                                <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Meine Aufträge - {{ $saleDataById[0]['id'] }}”</p>
                                                            </div>
                                                        </div>
                                                        <!-- Results, show/hide based on command palette state -->
                                                        <ul class="scroll-pt-11 scroll-pb-2 space-y-2  pb-2" id="options" role="listbox">
                                                            <li>
                                                                <h2 class=" py-1.5 px-4 bg-gray-400 text-white text-xs font-semibold text-gray-900">Details zu Auftrag underTest</h2>
                                                                <ul class="mt-2 text-sm text-gray-800">
                                                                    <!-- Active: "bg-indigo-600 text-white" -->
                                                                    @if($saleDataById[0]['event']['name'] !='')
                                                                        <li class="cursor-default select-none px-4 py-1 font-bold py-5 border-bottom text-fuchsia-700">{!! $saleDataById[0]['event']['name'] !!}</li>
                                                                    @endif
                                                                    @if($saleDataById[0]['detail']['quantity'] !='')
                                                                        <li  class="cursor-default select-none px-4 py-1"><span class="font-weight-500 width-120">Preis pro Ticket:</span> {{ $saleDataById[0]['detail']['quantity'] }} x {{  $saleDataById[0]['ticket']['category'] }}</li>
                                                                    @endif
                                                                    @if($saleDataById[0]['detail']['brokerTotal'] !='')
                                                                        <li class="cursor-default select-none px-4 py-1"><span class="font-weight-500 width-120">Gesamtpreis:</span>{{$saleDataById[0]['detail']['brokerTotal']}} EUR</li>
                                                                    @endif

                                                                </ul>
                                                            </li>
                                                            <li class="py-5">
                                                                <h2 class=" py-1.5 px-4 text-xs bg-gray-400 text-white font-semibold text-gray-900">Details</h2>
                                                                <ul class="mt-2 text-sm text-gray-800 py-5">
                                                                    <!-- Active: "bg-indigo-600 text-white" -->
                                                                    @if($saleDataById[0]['saleDate']  !='')
                                                                        <li  class="cursor-default select-none px-4 py-1"><strong>Verkauft am:</strong> {{$saleDataById[0]['saleDate']}}</li>
                                                                    @endif
                                                                    @if($saleDataById[0]['confirmationDate']  !='')
                                                                        <li  class="cursor-default select-none px-4 py-1"><strong>Bestätigt am:</strong> {{$saleDataById[0]['confirmationDate']}}</li>
                                                                    @endif
                                                                    @if($saleDataById[0]['payDate']  !='')
                                                                        <li  class="cursor-default select-none px-4 py-1"><strong>Bezahlt am:</strong> {{$saleDataById[0]['payDate']}}</li>
                                                                    @endif
                                                                    @if($saleDataById[0]['shippingDate']  !='')
                                                                        <li  class="cursor-default select-none px-4 py-1"><strong>Versendet am:</strong> {{$saleDataById[0]['shippingDate']}} {{$saleDataById[0]['detail']['trackingID']}}</li>
                                                                    @endif
                                                                    @if($saleDataById[0]['payOutDate']  !='')
                                                                        <li  class="cursor-default select-none px-4 py-1"><strong>Ausgezahlt am:</strong> {{$saleDataById[0]['payOutDate']}}</li>
                                                                    @endif
                                                                </ul>
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

                    @if($searchPagination =='yes')
                        <nav class=" border-t border-gray-200 bg-white px-4 py-3 sm:px-6" aria-label="Pagination">
                            {{ $saleData->links() }}
                        </nav>
                    @endif
                    <div class="text-right">
                        <button type="button" onclick="addLoadingClass()" x-on:click="$wire.exportSales()"
                                class="px-10 py-2 bg-blue-500  drop-shadow-lg text-xl text-white duration-300 hover:bg-blue-700">
                            <i class="fa-solid fa-download mr-3"></i>
                            CSV-Export
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
