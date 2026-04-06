<div>
    <div class="relative z-10 border-gray-300" aria-labelledby="modal-title">
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="sticky transform overflow-hidden rounded-lg bg-gray-400 px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-1/2 sm:p-6">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400 bg-white">
                            <button @click="openNewMessage = ! openNewMessage" wire:click="closeMessageDialog()"  type="button" class="flex text-right text-white bg-gray-700 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-700 dark:hover:text-white" data-modal-hide="staticModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>

                            <div>
                                <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8 bg-white">
                                    <div class="py-5">
                                        <div id="cards" class="flex border-b py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="w-10 h-10 text-red-700 -ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/>
                                            </svg>
                                            <p class="pl-4 md:pl-12 text-base text-black pt-1 font-semibold md:text-xl">
                                                “Neue Nachricht schreiben”</p>
                                        </div>
                                    </div>


                                    <form id="form" class="mx-auto max-w-full bg-white"
                                          wire:submit.prevent="storeConversation(Object.fromEntries(new FormData($event.target)))">
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
                                        <div class="px-6" x-data="{ newMessageRequest: '' }">
                                            <div class="py-6">
                                                <div class="ml-12">
                                                    <label class="text-black">Ihr Anliegen</label>
                                                    <select id="newMessageRequest" name="subjectType" class="flex-1 border-gray-300 rounded-md  py-1.5 pl-1 text-black focus:ring-0 sm:text-sm sm:leading-6"
                                                            x-model="newMessageRequest">
                                                        <option value="0" selected>Bitte Anliegen wählen</option>
                                                        <option value="sale">Frage zu einem Auftrag</option>
                                                        <option value="ticket">Frage zu einem Listing</option>
                                                        <option value="other">Allgemeine Frage</option>
                                                    </select>
                                                </div>
                                                <div x-show="newMessageRequest == 'sale' || newMessageRequest == 'ticket' || newMessageRequest == 'other' "
                                                    x-cloak>
                                                    <div class="p-6">
                                                        <div class="w-full rounded-b-md border-2 ">
                                                            <div class="space-y-12 p-6">
                                                                <div class="border-b border-white/10">
                                                                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                                                        <input type="hidden" name="email" value="@if(!empty($email)){{$email}}@endif" placeholder="email">
                                                                        <input type="hidden" name="sellerID" value="@if(!empty($sellerID)){{$sellerID}}@endif" placeholder="sellerID">

                                                                        <div x-show="newMessageRequest == 'sale'" class="col-span-full">
                                                                            <div class="flex relative">
                                                                                <div class="w-25">
                                                                                    <label class="block text-sm font-medium leading-6 rounded-md  text-black">Auftrags-ID</label>
                                                                                </div>
                                                                                <div class="-mt-2 ml-3">
                                                                                    <div class="flex ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                                                        <input type="text" name="sale_id" class="flex-1 border-gray-300 rounded-md  py-1.5 pl-1 text-black focus:ring-0 sm:text-sm sm:leading-6" placeholder="Auftrags-ID">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div x-show="newMessageRequest == 'ticket'"
                                                                             class="col-span-full" x-cloak>
                                                                            <div class="flex relative">
                                                                                <div class="w-25">
                                                                                <label class="block text-sm font-medium leading-6 rounded-md  text-black">Ticket-ID</label>
                                                                                </div>
                                                                                <div class="-mt-2  ml-3">
                                                                                    <div class="flex ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                                                        <input type="text" name="ticket_id" class="flex-1 border-gray-300 rounded-md   py-1.5 pl-1 text-black focus:ring-0 sm:text-sm sm:leading-6" placeholder="Ticket-ID">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            x-show="newMessageRequest != 'sale' && newMessageRequest != 'ticket'" x-cloak>
                                                                            <div class="sm:col-span-4">
                                                                                <label class="block text-sm font-medium leading-6 text-black">Subject</label>
                                                                                <div class="mt-2">
                                                                                    <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                                                        <input type="text" name="subject" class="flex-1 py-1.5 pl-1 border-gray-300  text-black focus:ring-0 sm:text-sm sm:leading-6" placeholder="subject">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-span-full">
                                                                            <label class="block text-sm font-medium leading-6 text-black">Nachricht</label>
                                                                            <div class="mt-2">
                                                                                <textarea id="about" name="message" rows="3" class="block w-full rounded-md border-gray-300  py-1.5 text-black shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                                                    <button x-on:click="openNewMessage = ! openNewMessage" type="button" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500ck">Abbrechen</button>
                                                                    <button onclick="addLoadingClass()"  type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Speichern</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
