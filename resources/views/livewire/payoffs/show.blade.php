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


                                <td class="whitespace-nowrap py-4">
                                    <span class="flex justify-center"><button onclick="addLoadingClass()" wire:click="getPayoffDetails({{ $payoff['id'] }})" @click.prevent="open = true"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg></button>
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

    @if(($getDetails!=null))
        <div class=" relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="open" @click.outside="open = false">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-80 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="mx-auto max-w-full  min-h-full transform rounded-xl bg-gray-500 opacity-80 shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
                    <div class="hidden sm:block">
                        <div class="mx-auto w-full px-4 sm:lg:px-8">
                            <button @click="open = ! open"  onclick="window.location='{{ route("payoffs.show") }}'" type="button" class="flex text-right text-gray-400 bg-gray-600 hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white" data-modal-hide="staticModal">
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
                                            <?php
                                            foreach($getDetails[0]['payoffdetals'] as $key => $getDetail) {
                                                $email =  $getDetails[0]['downloadlink'] [$key];
                                            ?>
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
                                                        <button type="button"  class="px-10 py-2 bg-blue-500  drop-shadow-lg text-xl text-white duration-300 hover:bg-blue-700">
                                                            <i class="fa-solid fa-download mr-3"></i><a href="{{$email}}" target="_blank"> PDF herunterladen</a>
                                                        </button>
                                                    </td>

                                                    <td  class="whitespace-nowrap py-4">
                                                        <span class="flex justify-center">
                                                            <button type="button" onclick="addLoadingClass()" wire:click="getSingleDetails({{ $getDetail['id'] }})"  @click.prevent="menuOpen = menuOpen">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                                                            </button>
                                                        </span>
                                                    </td>
                                            </tr>
                                        <?php }?>
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


    <div x-show="menuOpen" x-cloak>
        {{--here is include payoffs search--}}
        @if(!empty($passSingleDetailsId))
            @livewire('payoffs.detail', ['id' => $passSingleDetailsId])
        @endif
        {{--end include payoffs search--}}
    </div>


</div>

