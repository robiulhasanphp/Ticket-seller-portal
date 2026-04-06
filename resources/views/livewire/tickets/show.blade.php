<div>
    <div id="loadingClass" class=""></div>
    <div class="mt-6 px-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="sm:col-span-6">
            <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input type="text" placeholder="Search" wire:model.debounce.800m="search" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"/>
            </div>
        </div>
        <div class="sm:col-span-6">
            <select name="role" onchange="addLoadingClass()"
                    wire:change="getTicketByStatus($event.target.value)"
                    class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10  ring-slate-200 shadow-sm">
                <option value="active">Nur aktive Listings anzeigen</option>
                <option value="inactive">Nur inaktive Listings anzeigen</option>
                <option value="all" selected>Alle Listings anzeigen</option>
            </select>
        </div>
        <div x-data="{ openEventModel: false }" class="sm:col-span-12">
            <div class="space-y-6 divide-y divide-gray-200 sm:space-y-5">
                <button @click="openEventModel = ! openEventModel"
                        class="flex float-right mr-6  gap-x-2 rounded-md  bg-emerald-600 py-2.5 px-6 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                              clip-rule="evenodd"/>
                    </svg>
                    &nbsp;Tickets verkaufen
                </button>
            </div>

            <div class="w-2/4 bg-emerald-500 hidden_div" id="show_message_add_ticket">
                <div class="loading">
                    <p>Please wait</p>
                    <span><i></i><i></i></span>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="bg-gray-800  max-w-2xl  h-16">
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

            <div x-show="openEventModel">
                @livewire('tickets.create')
            </div>
        </div>
    </div>


    <div x-data="{
                open: false,
                selectAll : false,
                selectedIds: [],
                unselectAll() { this.selectedIds = []},
                toggleAllCheckboxes() {
                this.selectAll = !this.selectAll
                this.selectedIds = [];

                checkboxes = document.querySelectorAll('input[name=ids]');
                [...checkboxes].map((el) => {
                el.checked = this.selectAll;
                (this.selectAll) ? this.selectedIds.push(el.value) : this.selectedIds = [];
                })
                },
                get showselectedIds(){
                return (this.selectedIds.length > 0);
            }
            }">


        <div class="isolate inline-flex px-6">
            <div class="bg-green-500">
                <button x-on:click="unselectAll" type="button"
                        class="ticketIcon border-r-2 relative  inline-flex items-center px-3 py-2 text-sm font-semibold text-gray-900  hover:bg-gray-500 focus:z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                    </svg>
                    <span class="ticketIconText">Aktualisieren</span>
                </button>
                <button onclick="addLoadingClass()"  type="button"  x-on:click="$wire.render(selectedIds)"
                        class="ticketIcon border-r-2 -ml-2 relative  inline-flex items-center  px-3 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-500 focus:z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="ticketIconText">Auswahl anzeigen</span>
                </button>


                <button  onclick="toggleShowPopUp()" type="button" for="open-modal"
                        class="ticketIcon border-r-2 -ml-2 relative  inline-flex items-center  px-3 py-2 text-sm font-semibold text-gray-900  ring-inset hover:bg-gray-500 focus:z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/>
                    </svg>
                    <span class="ticketIconText">Für Auswahl Schnellversand aktivieren / deaktivieren</span>
                </button>

                <div id="toggleShowPopUp">
                    <div class="rounded-md bg-gray-700 p-4 -mt-96">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-white">Bestätigung</h3>
                                <div class="mt-2 text-sm text-white">
                                    <p>Sie sind sich sicher, dass Sie etwas verändern wollen.</p>
                                </div>
                                <div class="mt-4">
                                    <div class="-mx-2 -my-1.5 flex">
                                        <button type="button" onclick="addLoadingClass()" x-on:click="$wire.toggleInHand(selectedIds)"  class="rounded-md bg-green-500 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Save</button>
                                        <button onclick="toggleClosePopUp()" type="button" class="ml-3 rounded-md bg-red-600 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button  onclick="activeShowPopUp()" type="button" for="open-modal"
                         class="ticketIcon border-r-2 -ml-2 relative  inline-flex items-center  px-3 py-2 text-sm font-semibold text-gray-900  ring-inset hover:bg-gray-500 focus:z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                    </svg>
                    <span class="ticketIconText">Auswahl aktivieren</span>
                </button>

                <div id="activeMessageShowPopUp">
                    <div class="rounded-md bg-gray-700 p-4 -mt-96">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-white">Bestätigung</h3>
                                <div class="mt-2 text-sm text-white">
                                    <p>Sie sind sich sicher, dass Sie etwas verändern wollen.</p>
                                </div>
                                <div class="mt-4">
                                    <div class="-mx-2 -my-1.5 flex">
                                        <button type="button" onclick="addLoadingClass()" x-on:click="$wire.activeLiveDialog(selectedIds)"  class="rounded-md bg-green-500 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Save</button>
                                        <button onclick="activeClosePopUp()" type="button" class="ml-3 rounded-md bg-red-600 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button  onclick="deActiveShowPopUp()" type="button" for="open-modal"
                         class="ticketIcon border-r-2 -ml-2 relative  inline-flex items-center  px-3 py-2 text-sm font-semibold text-gray-900  ring-inset hover:bg-gray-500 focus:z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5"/>
                    </svg>
                    <span class="ticketIconText">Auswahl deaktivieren</span>
                </button>

                <div id="deActiveMessageShowPopUp">
                    <div class="rounded-md bg-gray-700 p-4 -mt-96">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-white">Bestätigung</h3>
                                <div class="mt-2 text-sm text-white">
                                    <p>Sie sind sich sicher, dass Sie etwas verändern wollen.</p>
                                </div>
                                <div class="mt-4">
                                    <div class="-mx-2 -my-1.5 flex">
                                        <button type="button" onclick="addLoadingClass()" x-on:click="$wire.deActiveLiveDialog(selectedIds)"  class="rounded-md bg-green-500 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Save</button>
                                        <button onclick="deActiveClosePopUp()" type="button" class="ml-3 rounded-md bg-red-600 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" onclick="deleteShowPopUp()"
                        class="ticketIcon -ml-2 relative  inline-flex items-center  px-3 py-2 text-sm font-semibold text-gray-900  ring-inset hover:bg-gray-500 focus:z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                    <span class="ticketIconText">Auswahl löschen</span>
                </button>


                <div id="deleteShowPopUp">
                    <div class="rounded-md bg-gray-700 p-4 -mt-96">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-white">Bestätigung</h3>
                                <div class="mt-2 text-sm text-white">
                                    <p>Sie sind sich sicher, dass Sie etwas verändern wollen.</p>
                                </div>
                                <div class="mt-4">
                                    <div class="-mx-2 -my-1.5 flex">
                                        <button type="button" onclick="addLoadingClass()"  x-on:click="$wire.delete(selectedIds)"  class="rounded-md bg-green-500 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Save</button>
                                        <button onclick="deleteClosePopUp()" type="button" class="ml-3 rounded-md bg-red-600 px-2 py-1.5 text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div x-show="open">
                    @if(!empty($ticketsBySelectedIds))
                    <div class="relative z-10 border-gray-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                        <div class="fixed inset-0 z-10 overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div class="sticky transform  rounded-lg  px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-full sm:p-6 h-screen">

                                    <button  onclick="window.location='{{ route("tickets.show") }}'" type="button"
                                            class="flex text-right text-gray-400 bg-gray-600 hover:bg-gray-500 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-gray-500 dark:hover:text-white"
                                            data-modal-hide="staticModal">
                                        <svg class="w-5 h-5 " fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </button>

                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm  text-gray-500 dark:text-gray-400">
                                            <thead class="text-xs text-gray-700 bg-blue-50 uppercase text-black">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-center">id</th>
                                                <th scope="col" class="px-6 py-3 text-center">Event</th>
                                                <th scope="col" class="px-6 py-3 text-center">Kategorie</th>
                                                <th scope="col" class="px-6 py-3 text-center">Anzahl</th>
                                                <th scope="col" class="px-6 py-3 text-center">Preis pro Ticket</th>
                                                <th scope="col" class="px-6 py-3 text-center">Verkauft</th>
                                                <th scope="col" class="px-6 py-3 text-center">Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ticketsBySelectedIds as $ticket)
                                                    <tr class="row-as-link bg-white text-black border-b  dark:border-gray-700">
                                                        <td class="px-6 py-4 text-center">{{ $ticket->id }}</td>
                                                        <td class="px-6 py-4 text-center">{!! $ticket->event->name !!}</td>
                                                        <td class="px-6 py-4 text-center">
                                                            @if($ticket->fastDelivery == 1)
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex mx-auto justify-center text-center items-center">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/>
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/>
                                                                </svg>
                                                            @endif

                                                            {!! $ticket->categoryFormatted !!}
                                                        </td>
                                                        <td class="px-6 py-4 text-center">{{ $ticket->quantity }}</td>
                                                        <td class="px-6 py-4 text-center">{{$ticket->quantitySold}}</td>
                                                        <td class="px-6 py-4 text-center">{{$ticket->pricePerTicket }} EUR</td>
                                                        <td x-data="{ open: false }"
                                                            class="whitespace-nowrap py-4  text-sm font-medium  text-center">
                                                            <a @click="open = ! open" type="button"
                                                               onclick="addLoadingClass()" x-on:click="$wire.getTicketsByIDsEdit({{$ticket->id }})"
                                                               class="text-indigo-600 hover:text-indigo-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                                </svg>
                                                            </a>
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
                    @endif
                </div>
            </div>
        </div>


        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="-my-2 -mx-4  sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="">
                            <table class="w-full min-w-full divide-y divide-gray-200">
                                <thead class="text-xs bg-blue-50 text-gray-700 uppercase text-black">
                                <tr>
                                    <th scope="col" class=" bg-gray-400 px-7 sm:w-12 sm:px-6">
                                        <input type="checkbox" name="selectAll" x-on:click="toggleAllCheckboxes()" class=" static left-4 top-1/2  h-4 w-4  text-indigo-600 focus:ring-indigo-600">
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">Ticket-Id</th>
                                    <th scope="col" class="px-6 py-3 text-center">Event</th>
                                    <th scope="col" class="px-6 py-3 text-center">Kategorie</th>
                                    <th scope="col" class="px-6 py-3 text-center">Anzahl</th>
                                    <th scope="col" class="px-6 py-3 text-center">Preis pro Ticket</th>
                                    <th scope="col" class="px-6 py-3 text-center">Verkauft</th>
                                    <th scope="col" class="px-6 py-3 text-center">Live</th>
                                    <th scope="col" class="px-6 py-3 text-center">Edit</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                if(isset($ticketsByStatus)&&($ticketsByStatus != '')){
                                    $tickets = $ticketsByStatus;
                                }
                                elseif($selectdata =='yes'){
                                    $tickets = $ticketsselectdata;
                                    $searchPagination='no';
                                }
                                elseif($selectdata ==''){
                                    $tickets = $tickets;
                                }?>

                                @foreach ($tickets as $ticket)
                                    <tr class="row-as-link bg-white border-b text-black dark:border-gray-200">
                                        <td class=" px-7 sm:w-12 sm:px-6 text-center">
                                            <input type="checkbox" name="ids" value="{{$ticket->id }}" x-model="selectedIds" class=" static left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {{$ticket->id }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            {!! $ticket->event->name !!}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($ticket->fastDelivery == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex mx-auto justify-center text-center items-center">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/>
                                                </svg>
                                            @endif
                                                {!! $ticket->categoryFormatted !!}
                                        </td>
                                        <td class="px-6 py-4 text-center">{{ $ticket->quantity }}</td>
                                        <td class="px-6 py-4 text-center">{{$ticket->pricePerTicket }} EUR</td>
                                        <td class="px-6 py-4 text-center">{{$ticket->quantitySold}}</td>
                                        <td class="px-6 py-4 text-center">
                                            <label class="relative inline-flex  cursor-pointer flex mx-auto justify-center text-center items-center">
                                                <input
                                                    class="sr-only peer text-center"
                                                    type="checkbox"
                                                    role="switch"
                                                    id="flexSwitchChecked"
                                                    value="{{$ticket->id }}"
                                                    onclick="addLoadingClass()"
                                                    x-on:click="$wire.toggleLive({{$ticket->id}},{{$ticket->live}})"
                                                    @if($ticket->live=='true')checked @endif/>
                                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700
                                                peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px]
                                                after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                                            </label>
                                        </td>

                                        <td class="whitespace-nowrap py-4 text-sm font-medium sm:pr-3 text-center">
                                            <a onclick="addLoadingClass()" @click="open = !open" :aria-expanded="open ? 'true' : 'false'" type="button"  x-on:click="$wire.getTicketsByIDsEdit({{$ticket->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div x-show="open" id="displayNone">
                                @if((!empty($responsedata)))
                                    @livewire('tickets.editform', ['id' => $responsedata])
                                @elseif($responsedata=='')
                                    @livewire('tickets.editform')

                                @endif
                            </div>
                            @if(isset($ticketsByStatus)&&($ticketsByStatus != null))
                            @else
                                @if($searchPagination =='yes')
                                    <nav class=" border-t border-gray-200 bg-white px-4 py-3 sm:px-6" aria-label="Pagination">
                                        {{ $tickets->links() }}
                                    </nav>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">



            function redirectLocation() {
                window.location.href = "/meine-tickets";
            }

            function handleClick(cb) {
                cb.value = cb.checked ? 1 : 0;
                console.log(cb.value);
            }

            function toggleShowPopUp(){
                var popup_box = document.getElementById('toggleShowPopUp');
                popup_box.style.display="block";
            }
            function toggleClosePopUp(){
                var popup_box = document.getElementById('toggleShowPopUp');
                popup_box.style.display="none";
            }
            function activeShowPopUp(){
                var popup_box = document.getElementById('activeMessageShowPopUp');
                popup_box.style.display="block";
            }
            function activeClosePopUp(){
                var popup_box = document.getElementById('activeMessageShowPopUp');
                popup_box.style.display="none";
            }
            function deActiveShowPopUp(){
                var popup_box = document.getElementById('deActiveMessageShowPopUp');
                popup_box.style.display="block";
            }
            function deActiveClosePopUp(){
                var popup_box = document.getElementById('deActiveMessageShowPopUp');
                popup_box.style.display="none";
            }
            function deleteShowPopUp(){
                var popup_box = document.getElementById('deleteShowPopUp');
                popup_box.style.display="block";
            }
            function deleteClosePopUp(){
                var popup_box = document.getElementById('deleteShowPopUp');
                popup_box.style.display="none";
            }

            function handler() {
                document.getElementById('ready_to_add_ticket').style.display='none';
                return {
                    newform:false,
                    forms: [true],
                    addNewField(index) {
                        let length = this.forms.length;

                        if(length == '1'){
                            document.getElementById('ticketInsetUpdateForm').remove();
                            document.getElementById('formRemoveButton').remove();
                            document.getElementById('ready_to_add_ticket').style.display='block';
                        }
                        this.forms.push({
                            form: '',
                        });

                        this.newform =true;
                    },

                    redirectLocation() {
                        window.location.href = "/meine-tickets";
                    },

                    removeField(index) {
                        this.forms.splice(index, 1);
                    },
                    submit_forms() {

                            let ticketInsetUpdateForm = document.querySelector("#ticketInsetUpdateForm");
                            let quantity = document.querySelector("#quantity");
                            let faceValue = document.querySelector("#faceValue");
                            let brokerPrice = document.querySelector("#brokerPrice");
                            handleInput();
                            function handleInput() {
                                let quantityValue = quantity.value.trim();
                                let faceValueValue  = faceValue.value.trim();
                                let brokerPriceValue  = brokerPrice.value.trim();


                                if (quantityValue === "") {
                                setErrorFor(quantity, "quantity cannot be blank");
                                } else {
                                setSuccessFor(quantity);}

                                if (faceValueValue === "") {
                                    setErrorFor(faceValue, "faceValue cannot be blank");
                                } else {setSuccessFor(faceValue);}

                                if (brokerPriceValue === "") {
                                    setErrorFor(brokerPrice, "brokerPrice cannot be blank");
                                }
                            }

                            function setErrorFor(input, message) {
                            let ticketInsetUpdateFormControl = input.parentElement;
                                ticketInsetUpdateFormControl.id = "#ticketInsetUpdateForm-control error";
                            let small =ticketInsetUpdateFormControl.querySelector("small");
                            small.innerText = message;
                            throw TypeError("Wrong type found, expected character")

                        }
                            function setSuccessFor(input) {
                            let ticketInsetUpdateFormControl = input.parentElement;
                            ticketInsetUpdateFormControl.id = "ticketInsetUpdateFormcontrol success";
                        }


                        document.getElementById('ready_to_add_ticket').style.display='none';
                        document.getElementById('show_message_add_ticket').style.display='block';
                        document.getElementById('displayNone').style.display='none';


                        const XHR = new XMLHttpRequest();
                        let data = [];
                        subforms = document.querySelectorAll("#ticketInsetUpdateForm");

                        const form = document.getElementById('ticketInsetUpdateForm');
                        form.addEventListener('keypress', function(e) {
                            if (e.keyCode === 13) {
                                e.preventDefault();}
                        });


                        if(this.newform == false){

                            for (x = 0 ; x < subforms.length; x++) {
                                let elements = subforms[x].elements;
                                let subdata=[];

                                for (e = 0; e < elements.length; e++) {
                                    if (elements[e].name.length) {

                                        let entry=  {};

                                        if((x < '0')  && (elements[e].name=='TICK_id')){
                                            entry.name=elements[e].name
                                            entry.value='null'}


                                        else if(elements[e].name=='fastDelivery'){

                                            if (elements[e].checked == true){
                                                entry.name=elements[e].name
                                                entry.value='1'
                                            }
                                            else {
                                                entry.name=elements[e].name
                                                entry.value='0'
                                            }
                                        }
                                        else{
                                            entry.name=elements[e].name
                                            entry.value=elements[e].value}

                                        subdata.push(entry);
                                        //subdata.push({ [entry.name]: entry.value });
                                    }
                                }
                                data.push(subdata);
                            }
                        }else {

                            for (x = 0 ; x < subforms.length; x++) {
                                let elements = subforms[x].elements;
                                let subdata=[];

                                for (e = 0; e < elements.length; e++) {
                                    if (elements[e].name.length) {

                                        let entry=  {};

                                        if((x >= '0') && (elements[e].name=='TICK_id')){
                                            entry.name=elements[e].name
                                            entry.value='null'}

                                        else if(elements[e].name=='fastDelivery'){

                                            if (elements[e].checked == true){
                                                entry.name=elements[e].name
                                                entry.value='1'
                                            }
                                            else {
                                                entry.name=elements[e].name
                                                entry.value='0'
                                            }
                                        }
                                        else{
                                            entry.name=elements[e].name
                                            entry.value=elements[e].value}

                                        subdata.push(entry);
                                        //subdata.push({ [entry.name]: entry.value });
                                    }
                                }
                                data.push(subdata);
                            }
                        }
                        Livewire.emit('ticketInsetUpdateForm', data);
                    }
                }
            }
        </script>
    @endpush
</div>

