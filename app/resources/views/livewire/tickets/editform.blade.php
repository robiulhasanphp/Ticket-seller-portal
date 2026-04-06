<div>
    @if(!empty($ticketsBySelectedIdsEdit))
        <div class="relative z-10 border-gray-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-400 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 sm:items-center sm:p-0">
                    <div class="mx-auto max-w-4xl px-4 sm:px-6 bg-gray-200 lg:px-8 pt-6">
                        <button  onclick="window.location='{{ route("tickets.show") }}'" type="button" class="flex text-right text-gray-400 bg-gray-600 hover:bg-red-600 hover:text-white rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white" data-modal-hide="staticModal">
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

                        <div class="sm:col-span-6">
                            <div class="py-5">
                                <div id="cards" class="flex border-b-4 border-b-gray-400 py-2 text-black pr-10">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width={1.5} stroke="currentColor" class="w-10 h-10 text-red-600 -ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                        </svg>
                                    </div>
                                    <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">Einstellungen - Ticket- {!! $ticketsBySelectedIdsEdit[0]['id'] !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-6 text-left bg-indigo-500 px-3 py-5">
                           <span class="text-white">
                               {!! $ticketsBySelectedIdsEdit[0]['event']['name'] !!}
                           </span>
                        </div>

                        <div class="row py-5"  x-data="handler()">
                            <div class="sm:col-span-6 bg-emerald-500" id="ready_to_add_ticket">
                                <div id="cards" class="flex border py-1  pr-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    <p class="px-4 text-base text-white pt-2 font-semibold md:text-xl">“Sie können jetzt ein neues Ticket hinzufügen.”</p>
                                </div>
                            </div>

                            <template  x-for="(form, index) in forms" :key="index">
                                <div>
                                    <button id="formRemoveButton" @click="removeField(index)" type="button" class="flex text-right text-gray-400 bg-gray-600 hover:bg-red-600 hover:text-white rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>

                                    <form method="POST" action="/insertUpdateForm"   id="ticketInsetUpdateForm"  class="px-6 py-10 form-control specify-ticket-form space-y-8 divide-y bg-gray-400 divide-gray-200 rounded-t-md border-2">
                                        <div class="space-y-8 divide-y divide-gray-200">
                                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:col-span-6">
                                                    @if(!empty($ticketCategories))
                                                        <div class="sm:col-span-3">
                                                            <label class="block text-sm font-medium leading-6 text-white text-left ">Kategorie</label>
                                                            <div class="mt-2">
                                                                <select name="categoryID" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                                    @foreach($ticketCategories as $category)
                                                                        <option value="{{ $category['id'] }}" {{ $ticketsBySelectedIdsEdit[0]['category_default']['TICD_id']  == $category['id'] ? 'selected="selected"' : '' }}>{{ $category['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(!empty($createTicketSections))
                                                        <div class="sm:col-span-3">
                                                            <label class="block text-sm font-medium leading-6 text-white text-left">Block</label>
                                                            <div class="mt-2">
                                                                <select name="sectionID" class="block w-full  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                                    @foreach($createTicketSections['sectionNames'] as $section)
                                                                        <option value="{{ $section['id'] }}" {{ $ticketsBySelectedIdsEdit[0]['section']['HPBN_id']  == $section['id'] ? 'selected="selected"' : '' }}>{{ $section['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <input type="hidden"  name="eventID"  class="text-black" value="{{$ticketsBySelectedIdsEdit[0]['EVEN_id']}}">
                                                    <input type="hidden" id="TICK_id_changes" name="TICK_id"  class="text-black" value="{{$ticketsBySelectedIdsEdit[0]['TICK_id']}}">

                                                    <div class="sm:col-span-3">
                                                        <label for="last-name"  class="block text-sm font-medium leading-6 text-white text-left">Verfügbare Anzahl</label>
                                                        <div class="mt-2">
                                                            <input type="text"  name="quantity"  value="{{$ticketsBySelectedIdsEdit[0]['quantity']}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="{{$ticketsBySelectedIdsEdit[0]['quantity']}}">
                                                        </div>
                                                        @error('quantity')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="sm:col-span-3">
                                                        <label class="block text-sm font-medium leading-6 text-white text-left">Aufteilung</label>
                                                        <div class="mt-2">
                                                            <select  name="split" class="block w-full rounded-md border-0 py-1.5 text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                                                <option value="0">Beliebig</option>
                                                                <option value="1">Alle Tickets zusammen anbieten</option>
                                                                <option value="2">Vermeide 1 Restticket</option>
                                                                <option value="3">Vermeide 1 und 3 Resttickets</option>
                                                                <option value="4">Vermeide ungerade Zahlen</option>
                                                            </select>
                                                            @error('split')
                                                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                                                <p class="text-white">{{ $message }}</p>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                <div x-data="{ originalpreis: 0, brokerPrice: 0, websitePrice: 0}"
                                                     class="col-span-full flex"
                                                     x-effect="websitePrice = Math.round((brokerPrice)/(brokerPrice - 25)*100)">
                                                    <div class="col-span-4">
                                                        <label for="email" class="block text-sm font-medium leading-6 text-white text-left">Originalpreis</label>
                                                        <div class="mt-2">
                                                            <input value="{{$ticketsBySelectedIdsEdit[0]['faceValue']}}" name="faceValue" type="text" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" placeholder="Originalpreis" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                                        </div>
                                                        @error('faceValue')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror
                                                    </div>



                                                    <div class="col-span-4 px-6">
                                                        <label for="street-address" class="block text-sm font-medium leading-6 text-white text-left">Ihre
                                                            Auszahlung</label>
                                                        <div class="mt-2">
                                                            <input x-model.number="brokerPrice" name="brokerPrice"  type="text" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" placeholder="Ihre Auszahlung" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                                        </div>
                                                        @error('brokerPrice')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror

                                                    </div>
                                                    <div class="col-span-4">
                                                        <label for="city" class="block text-sm font-medium leading-6 text-white text-left">Ticket-Gesamtpreis</label>
                                                        <div class="mt-2">
                                                            <input x-model.number="websitePrice" name="websitePrice" value="" type="text" onchange="(function(el){el.value=parseFloat(el.value).toFixed(2);})(this)" placeholder="Ticket-Gesamtpreis" class="block bg-indigo-300  w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required readonly>
                                                        </div>
                                                        @error('websitePrice')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-6 hidden">
                                                    <label for="postal-code" class="block text-sm font-medium leading-6 text-white text-left">Zusatzinformationen</label>
                                                    <div class="mt-2">
                                                        <textarea type="hidden" name="ticketNotes" value="" placeholder="Zusatzinformationenr" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-4 relative flex gap-x-3" >
                                                    <div class="flex h-6 items-center">
                                                        <input name="fastDelivery"  id="check" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                    </div>
                                                    <div class="text-sm leading-6">
                                                        <label for="offers" class="font-medium text-white text-left">Tickets können
                                                            direkt nach Zahlungseingang versendet werden</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </template>



                            <hr class="mt-4">
                            <div class="flex mx-6">
                                <div class="flex p-3 flex-initial">
                                    <div class="flex-initial">
                                        <button @click="addNewField()"  type="button" class="flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize bg-green-500 rounded-md hover:bg-gray-800  focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg"  height="24px" width="24px" fill="#FFFFFF" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                            </svg>
                                            <span class="pl-2 mx-1" > Kopieren</span>
                                        </button>
                                    </div>
                                    <div class="flex-initial flex-row-reverse pl-3">
                                        <button type="button" x-on:click="$wire.deleteTicket({{$ticketsBySelectedIdsEdit[0]['TICK_id']}})"  class="flex items-center px-5 py-2.5 font-medium tracking-wide text-black capitalize rounded-md  bg-red-600 hover:bg-red-200 hover:fill-current hover:text-red-600  focus:outline-none  transition duration-300 transform active:scale-95 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px">
                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                <path d="M8 9h8v10H8z" opacity=".3"></path>
                                                <path d="M15.5 4l-1-1h-5l-1 1H5v2h14V4zM6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9z"></path>
                                            </svg>
                                            <span class="pl-2 mx-1">Delete</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="flex flex-row-reverse p-3">
                                    <div class="flex-initial pl-3">
                                        <button type="button"  @click="submit_forms()" class="flex items-center px-5 py-2.5 font-medium tracking-wide text-white capitalize  bg-blue-600  rounded-md hover:bg-gray-800  focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                            </svg>
                                            <span class="pl-2 mx-1">Speichern</span>
                                        </button>
                                    </div>
                                    <div class="flex-initial">
                                        <button type="button"  onclick="window.location='{{ route("tickets.show") }}'"  class="flex items-center px-5 py-2.5 font-medium tracking-wide text-black capitalize rounded-md bg-amber-600 hover:bg-red-200 hover:fill-current hover:text-red-600  focus:outline-none  transition duration-300 transform active:scale-95 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            <span class="pl-2 mx-1"> Abbrechen</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
