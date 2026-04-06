<div>
    @if (isset($getSingleDetails)&&($getSingleDetails !=''))
        <div class="relative z-10 border-gray-300" aria-labelledby="modal-title">
                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div class="sticky transform overflow-hidden rounded-lg bg-gray-400 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-1/2 sm:p-6">
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
                                        <button  @click="menuOpen = ! menuOpen"  wire:click="closeDetailDialogPayoff()"    type="button" class="flex text-right text-gray-400 bg-gray-600 hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white" data-modal-hide="staticModal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>

                                        @if (session()->has('message'))
                                            <div class="bg-gray-800  max-w-2xl h-12">
                                                <div class=" w-70 px-4 sm:px-6 lg:px-8">
                                                    <div class="alert alert-success text-white w-70 pt-3 flex inline">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
                                                        </svg>
                                                        <div class="px-6">{{ session('message') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif



                                        <div class="mx-auto transform">
                                            <div id="cards" class="flex border py-2 pr-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/>
                                                </svg>
                                                <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Meine Aufträge Payoff - @if($getSingleDetails[0]['id'] !=''){{$getSingleDetails[0]['id']}}@endif”</p>
                                            </div>
                                            <ul class="scroll-pt-11 scroll-pb-2 space-y-2 pb-2" id="options" role="listbox">
                                                <li>
                                                    <ul class="mt-2 text-sm text-gray-800">
                                                        @if($getSingleDetails[0]['detail']['ticket']['event']['name'] !='')
                                                            <li class="cursor-default select-none px-4 py-1 font-bold py-5 border-bottom text-fuchsia-700 bg-green-300 rounded-md" id="option-1" role="option" tabindex="-1">{!! $getSingleDetails[0]['detail']['ticket']['event']['name'] !!}</li>
                                                        @endif
                                                        <div class="my-5 py-2 bg-gray-400">
                                                            <span class="px-4 mb-4 text-white">{{ $getSingleDetails[0]['detail']['quantity'] }}x {{  $getSingleDetails[0]['detail']['ticket']['category'] }}</span>

                                                            <div class="py-5">
                                                                @if($getSingleDetails[0]['detail']['brokerPricePerTicket'] !='')
                                                                    <li class="cursor-default select-none px-4 text-white"><span class="font-weight-500 width-120">Preis pro Ticket:</span> {{  $getSingleDetails[0]['detail']['brokerPricePerTicket'] }}EUR</li>
                                                                @endif
                                                                @if($getSingleDetails[0]['detail']['brokerTotal'] !='')
                                                                    <li class="cursor-default select-none px-4 text-white"><span class="font-weight-500 width-120">Gesamtpreis:</span>{{$getSingleDetails[0]['detail']['brokerTotal']}}EUR</li>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul class="my-5 py-2 bg-gray-400 text-sm text-gray-800">
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
                </div>
    @endif
    @if (isset($getSingleDetails)&&($getSingleDetails =='notfound'))
        <div class="relative z-10 border-gray-300" aria-labelledby="modal-title">
            <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="sticky transform overflow-hidden rounded-lg bg-gray-400 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-1/2 sm:p-6">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
                                    <button  @click="menuOpen = ! menuOpen"  wire:click="closeDetailDialog()"    type="button" class="flex text-right text-gray-400 bg-gray-600 hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white" data-modal-hide="staticModal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>

                                    @if (session()->has('message'))
                                        <div class="bg-gray-800  max-w-2xl h-12">
                                            <div class=" w-70 px-4 sm:px-6 lg:px-8">
                                                <div class="alert alert-success text-white w-70 pt-3 flex inline">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
                                                    </svg>
                                                    <div class="px-6">{{ session('message') }}</div>
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
    @endif
</div>


