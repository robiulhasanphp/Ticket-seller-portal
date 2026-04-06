<div>
    <div id="loadingClass" class=""></div>
    <div class="sm:col-span-6 px-8">
        <div class="py-5">
            <div id="cards" class="flex border py-2 pr-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/>
                </svg>
                <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Auszahlungenn”</p>
            </div>
        </div>
    </div>
    <div class="hidden sm:block">
        <div class="mx-auto w-full px-4 sm:lg:px-8">
            <div class="mt-2 flex flex-col">
                <div class="min-w-full  align-middle shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Zahlungs-ID</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Auszahlungs-Datum</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Auszahlungs-Betrag €</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Anzahl Aufträge</th>
                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Details</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($payoffs as $payoff)
                            <tr class="bg-white">
                                @if($payoff['id']  !='')
                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"><span class="text-sky-500">{{ $payoff['id'] }}</span></td>
                                @endif
                                @if($payoff['date'] !='')
                                    <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500"><span class="font-medium text-gray-900">{{ $payoff['date'] }}</span></td>
                                @else
                                    <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500"></td>
                                @endif
                                @if($payoff['amount'] !=null)
                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"><span class="font-medium text-gray-900">{{ $payoff['amount'] }}</span></td>
                                @else
                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                @endif
                                @if($payoff['sales_count']  !=null)
                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"><span class="font-medium text-gray-900">{{ $payoff['sales_count'] }}</span></td>
                                @else
                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                @endif


                                <td x-data="{ menuOpen : false}" class="whitespace-nowrap py-4">
                                    <span class="flex justify-center"><button onclick="addLoadingClass()" wire:click="getPayoffDetails({{ $payoff['id'] }})" @click.prevent="menuOpen = true"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg></button>
                                    </span>
                                    @if(!empty($getDetails))
                                        <div class=" relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="menuOpen" @click.outside="menuOpen = false">
                                            <div class="fixed inset-0 bg-gray-500 bg-opacity-80 transition-opacity"></div>
                                            <div class="fixed inset-0 z-10 overflow-y-auto">
                                                <div class="mx-auto max-w-full  min-h-full transform rounded-xl bg-gray-500 opacity-80 shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
                                                    <div class="hidden sm:block">
                                                        <div class="mx-auto w-full px-4 sm:lg:px-8">
                                                            <button @click="menuOpen = ! menuOpen"  wire:click="closeDetailDialog()" type="button" class="flex text-right text-gray-400 bg-gray-600 hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white" data-modal-hide="staticModal">
                                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                                </svg>
                                                            </button>

                                                            <div class="mt-2 flex flex-col">
                                                                <div class="min-w-full  overflow-x-auto align-middle shadow sm:rounded-lg">
                                                                    <table class="min-w-full divide-y divide-gray-200">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Auftrags-ID</th>
                                                                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Event</th>
                                                                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Event-Datum</th>
                                                                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Versand-Datum</th>
                                                                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Erlöse</th>
                                                                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">pdf</th>
                                                                            <th class="bg-gray-50 py-3 text-center text-sm font-semibold text-gray-900" scope="col">Details</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody class="divide-y divide-gray-200 bg-white">
                                                                        @foreach ($getDetails as $getDetail)
                                                                            <tr class="bg-white">
                                                                                @if($getDetail['id']  !='')
                                                                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                                                                        <span class="text-sky-500">{{ $getDetail['id'] }}</span>
                                                                                    </td>
                                                                                @endif
                                                                                @if($getDetail['detail']['ticket']['event']['name_formatted'] !='')
                                                                                    <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500">
                                                                                        <span class="font-medium text-gray-900">{!!  $getDetail['detail']['ticket']['event']['name_formatted'] !!}</span>
                                                                                    </td>
                                                                                @else
                                                                                    <td class="whitespace-nowrap py-4  text-center text-sm text-gray-500"></td>
                                                                                @endif
                                                                                @if($getDetail['detail']['ticket']['event']['date_formatted_plain'] !=null)
                                                                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                                                                        <span class="font-medium text-gray-900">{{ $getDetail['detail']['ticket']['event']['date_formatted_plain']}}</span>
                                                                                    </td>
                                                                                @else
                                                                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                                                                @endif

                                                                                @if($getDetail['shippingDate']  !=null)
                                                                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                                                                        <span class="font-medium text-gray-900">{{ $getDetail['shippingDate'] }}</span>
                                                                                    </td>
                                                                                @else
                                                                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                                                                @endif

                                                                                @if($getDetail['detail']['brokerTotal']  !=null)
                                                                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                                                                        <span class="font-medium text-gray-900">{{ $getDetail['detail']['brokerTotal'] }}</span>
                                                                                    </td>
                                                                                @else
                                                                                    <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500"></td>
                                                                                @endif

                                                                                <td class="whitespace-nowrap py-4 text-center text-sm text-gray-500">
                                                                                    <button type="button" onclick="addLoadingClass()" x-on:click="$wire.downloadBillingPDF({{ $getDetail['id'] }})" class="px-10 py-2 bg-blue-500  drop-shadow-lg text-xl text-white duration-300 hover:bg-blue-700">
                                                                                        <i class="fa-solid fa-download mr-3"></i>PDF herunterladen
                                                                                    </button>
                                                                                </td>
                                                                                <td  class="whitespace-nowrap py-4">
                                                                                    <span class="flex justify-center">
                                                                                        <button type="button" onclick="addLoadingClass()" wire:click="getSingleDetails({{ $getDetail['id'] }})"  @click.prevent="opendetails = true">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                                                                                        </button>
                                                                                    </span>

                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="opendetails">
                        @if (!empty($getSingleDetails))
                        <div class="relative z-10 border-gray-300" aria-labelledby="modal-title">
                            <div class="fixed inset-0 z-10 overflow-y-auto">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div class="sticky transform overflow-hidden rounded-lg bg-gray-400 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-1/2 sm:p-6">
                                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                            <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">

                                                <button @click="menuOpen = ! menuOpen"  wire:click="closeDetailDialog()"   type="button" class="flex text-right text-gray-400 bg-gray-600 hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white" data-modal-hide="staticModal">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>

                                                <div class="py-5">
                                                    <div id="cards" class="flex border py-2 pr-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/>
                                                        </svg>
                                                        <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Meine Aufträge Payoff - @if($getSingleDetails[0]['id'] !=''){{$getSingleDetails[0]['id']}}@endif”</p>
                                                    </div>
                                                </div>
                                                <!-- Results, show/hide based on command palette state -->
                                                <ul class="scroll-pt-11 scroll-pb-2 space-y-2 pb-2" id="options" role="listbox">
                                                    <li>
                                                        <h2 class="bg-gray-400 text-white py-2.5 px-4 text-xs font-semibold">Details</h2>
                                                        <ul class="mt-2 text-sm text-gray-800">
                                                            <!-- Active: "bg-indigo-600 text-white" -->
                                                            @if($getSingleDetails[0]['detail']['ticket']['event']['name'] !='')
                                                                <li class="cursor-default select-none px-4 py-1 font-bold py-5 border-bottom text-fuchsia-700" id="option-1" role="option" tabindex="-1">{!! $getSingleDetails[0]['detail']['ticket']['event']['name'] !!}</li>
                                                            @endif
                                                            @if($getSingleDetails[0]['detail']['quantity'] !='')
                                                                <li class="cursor-default select-none px-4 py-1" id="option-2" role="option" tabindex="-1">{{ $getSingleDetails[0]['detail']['quantity'] }}x {{  $getSingleDetails[0]['detail']['ticket']['category'] }}</li>
                                                            @endif
                                                            @if($getSingleDetails[0]['detail']['brokerTotal'] !='')
                                                                <li class="cursor-default select-none px-4 py-1" id="option-2" role="option" tabindex="-1">{{$getSingleDetails[0]['detail']['brokerTotal']}}EUR</li>
                                                            @endif

                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <h2 class="bg-gray-400 text-white py-2.5 px-4 text-xs font-semibold py-5">Details</h2>
                                                        <ul class="mt-2 text-sm text-gray-800">
                                                            <!-- Active: "bg-indigo-600 text-white" -->
                                                            @if($getSingleDetails[0]['saleDate']  !='')
                                                                <li class="cursor-default select-none px-4 py-1" id="option-3" role="option" tabindex="-1">
                                                                    <strong>Verkauft am:</strong> {{$getSingleDetails[0]['saleDate']}}
                                                                </li>
                                                            @endif
                                                            @if($getSingleDetails[0]['confirmationDate']  !='')
                                                                <li class="cursor-default select-none px-4 py-1" id="option-3" role="option" tabindex="-1">
                                                                    <strong>Bestätigt am:</strong> {{$getSingleDetails[0]['confirmationDate']}}
                                                                </li>
                                                            @endif
                                                            @if($getSingleDetails[0]['payDate']  !='')
                                                                <li class="cursor-default select-none px-4 py-1" id="option-3" role="option" tabindex="-1">
                                                                    <strong>Bezahlt am:</strong> {{$getSingleDetails[0]['payDate']}}
                                                                </li>
                                                            @endif
                                                            @if($getSingleDetails[0]['saleDate']  !='')
                                                                <li class="cursor-default select-none px-4 py-1" id="option-3" role="option" tabindex="-1">
                                                                    <strong>Versendet am:</strong> {{$getSingleDetails[0]['shippingDate']}} {{$getSingleDetails[0]['detail']['trackingID']}}
                                                                </li>
                                                            @endif
                                                            @if($getSingleDetails[0]['payOutDate']  !='')
                                                                <li class="cursor-default select-none px-4 py-1" id="option-3" role="option" tabindex="-1">
                                                                    <strong>Ausgezahlt am:</strong> {{$getSingleDetails[0]['payOutDate']}}
                                                                </li>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

