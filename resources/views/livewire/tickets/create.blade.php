<div>
    <div x-data="{ openAddEvent: false }" class="relative z-10 border-gray-300" aria-labelledby="modal-title"
         role="dialog" aria-modal="true">
        @if(isset($hasBrokerAccountData))
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-10 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="sticky transform overflow-hidden rounded-lg bg-gray-500 bg-opacity-75 transition-opacity px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full md:w-full sm:p-6">
                    @if(!$hasBrokerAccountData)
                    <div  class="mx-auto bg-blue-100 w-2/4 px-5 py-10">
                        {{--here is include user account settins--}}
                        <button onclick="window.location='{{ route("tickets.show") }}'"
                                class="flex text-right text-gray-400 bg-white hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white"
                                data-modal-hide="staticModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        @if(!$checkuserRight)
                            @livewire('auth.settings')
                        @endif
                        @if(!$checkUserAddress)
                            @livewire('auth.address')
                        @endif
                        @if(!$checkuserBankData)
                            @livewire('auth.accountinfo')
                        @endif
                        {{--end include settings--}}
                    </div>
                    @endif
                    @if($hasBrokerAccountData)
                    <div x-show="!openAddEvent" class="relative shadow-md sm:rounded-lg" x-cloak>
                        <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <button @click="openEventModel = ! openEventModel" onclick="window.location='{{ route("tickets.show") }}'" type="button"
                                    class="flex text-right text-gray-400 bg-white hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white"
                                    data-modal-hide="staticModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div class="flex justify-center items-center bg-gray-400 p-6">
                                <div class="lg:col-start-3 w-full lg:row-end-1">
                                    <h2 class="sr-only">SuSearch Ticketmmary</h2>
                                    <div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5">
                                        <dl class="flex flex-wrap flex mx-auto justify-center py-10">
                                            <div class="py-10 px-10 md:w-3/5 w-3/4 min-h-600  flex flex-col gap-2 bg-white text-white border-2 border-gray-400 ">
                                                <div class="sm:col-span-6 px-8">
                                                    <div class=" block relative">
                                                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                                                <path
                                                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    <input placeholder="Nach Veranstaltung suchen" wire:model.debounce.500m="searchTerm" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"/>
                                                    </div>
                                                </div>

                                                <div class="mt-6 flex w-full  border-t border-gray-300 pt-6">
                                                    <div class="flex w-full flex-col gap-4 p-4">
                                                        <table class="w-full text-sm text-left text-gray-500 text-white">
                                                            <tbody>
                                                            @if(!empty($events))
                                                                @foreach ($events as $event)
                                                                    @php
                                                                        if($event->venue_map_default_categories == ''){
                                                                            $venue_map_default_categories = 0;
                                                                        }else{
                                                                            $venue_map_default_categories = $event->venue_map_default_categories;
                                                                        }
                                                                    @endphp
                                                                    <tr @click="openAddEvent = ! openAddEvent" x-on:click="$wire.chooseEvent({{ $event->event_id }}, '', {{ $event->venue_map_id }}, {{ $venue_map_default_categories }})" class="row-as-link border-b text-black dark:border-gray-700">
                                                                        <td class="px-6 py-4">{!! $event->date_formatted !!} </td>
                                                                        <td class="px-6 py-4">{!! $event->name_formatted !!}</td>
                                                                        <td>
                                                                            <button>
                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/>
                                                                                </svg>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="openAddEvent" class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 pt-6" x-cloak>
                        @if(!empty($chosenEventData['defaultCategories']))

                            <button @click="openAddEvent = ! openAddEvent"  wire:click="closeDetailDialog()"   type="button"
                                    class="flex text-right text-gray-400 bg-white hover:bg-red-600 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-red-600 dark:hover:text-white"
                                    data-modal-hide="staticModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <form id="form" class="mx-auto max-w-4xl  space-y-8 divide-y divide-gray-200 bg-white rounded-t-md border-2 my-8"
                                wire:submit.prevent="store(Object.fromEntries(new FormData($event.target)))">
                                @if (session()->has('message'))
                                    <div class="bg-gray-800  max-w-2xl h-12">
                                        <div class=" w-70 px-4 sm:px-6 lg:px-8">
                                            <div class="alert alert-success text-white w-70 pt-3 flex inline">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
                                                </svg>
                                                <div class="px-6">{{ session('message') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="space-y-8 divide-y divide-gray-200 px-6">
                                    <div class="py-2 flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-10 h-10 text-red-700 -ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"/>
                                        </svg>
                                        <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Einstellungen - Events- {{$chosenEventData['eventID']}}</p>
                                    </div>

                                    <div class="sm:col-span-12">
                                        <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Ticketart</label>
                                        <select id="location"
                                                class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                wire:model="ticketart"
                                                >
                                            <option selected>-- Bitte wählen --</option>
                                            <option value="pt">Paper-Tickets</option>
                                            <option value="ot">Online-Tickets</option>
                                            <option value="mt">Mobile-Tickets</option>
                                        </select>
                                        @error('ticketart')
                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                            <p class="text-white">{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-span-12 pt-5">
                                        <div class="col-span-12">
                                            @if($ticketart === 'ot')
                                                <div class="sm:col-span-6">
                                                    {{--file upload--}}
                                                    <div x-data="fileUpload()">
                                                        <div class="relative flex flex-col items-center justify-center h-50 bg-slate-200"
                                                             x-on:drop="isDropping = false"
                                                             x-on:drop.prevent="handleFileDrop($event)"
                                                             x-on:dragover.prevent="isDropping = true"
                                                             x-on:dragleave.prevent="isDropping = false">
                                                            <div class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-blue-500 opacity-90" x-show="isDropping">
                                                                <span class="text-3xl text-white">Release file to upload!</span>
                                                            </div>

                                                            <label class="flex flex-col items-center justify-center w-full bg-white border  cursor-pointer select-none h-1/2 rounded-xl hover:bg-slate-50" for="file-upload">
                                                                <em class="italic text-slate-400">(drag files to the page)</em>
                                                                <div class="bg-gray-200  w-1/2 mt-3">
                                                                    <div
                                                                        class="bg-blue-500 h-[2px]"
                                                                        style="transition: width 1s"
                                                                        :style="`width: ${progress}%;`"
                                                                        x-show="isUploading">
                                                                    </div>
                                                                </div>

                                                            </label>
                                                            <input type="file" id="file-upload" name="filename[]" multiple @change="handleFileSelect" class="hidden" />

                                                            @if(count($files))
                                                                <ul class="mt-5 list-disc">
                                                                    @foreach($files as $file)
                                                                        <li>
                                                                            {{$file->getClientOriginalName()}}
                                                                            <button class="text-red-500" @click="removeUpload('{{$file->getFilename()}}')">X</button>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{--end file upload--}}
                                                </div>
                                            @endif

                                            <div class="sm:col-span-12 flex relative pt-2">

                                            @if(!empty($chosenEventData['defaultCategories']))
                                                <div class="col-span-6">
                                                    <label class="block text-sm font-medium leading-6 text-gray-900">Kategorie</label>
                                                    <div class="mt-2">
                                                        <select id="categoryID" name="categoryID" class="block min-w-375 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                            <option selected>-- Bitte wählen --</option>
                                                            @foreach($chosenEventData['defaultCategories'] as $category)
                                                                <option value="{{ $category['id'] }}">
                                                                    {{ $category['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($chosenEventData['venueMapSections']))
                                                <div class="col-span-6 ml-3">
                                                    <label class="block text-sm font-medium leading-6 text-gray-900">Block</label>
                                                    <div class="mt-2">
                                                        <select id="sectionID" name="sectionID"
                                                                class="block min-w-375 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                            <option selected>-- Bitte wählen --</option>
                                                            @foreach($chosenEventData['venueMapSections'] as $section)
                                                                <option value="{{ $section['id'] }}">
                                                                    {{ $section['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        </div>
                                        @if(!empty($chosenEventData))
                                            <div class="sm:col-span-12 flex relative pt-2">
                                                <input type="hidden" name="eventID" class="text-black" value="{{$chosenEventData['eventID']}}">
                                                <div class="sm:col-span-6">
                                                    <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Verfügbare Anzahl</label>
                                                    <div class="mt-2">
                                                        <input type="text" wire:model="quantity" placeholder="Verfügbare Anzahl" class="block min-w-375 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                                                    </div>
                                                    @error('quantity')
                                                    <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                                        </svg>
                                                        <p class="text-white">{{ $message }}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="sm:col-span-6 ml-3">
                                                    <label class="block text-sm font-medium leading-6 text-gray-900">Aufteilung</label>
                                                    <div class="mt-2">
                                                        <select id="split" name="split" class="block min-w-375 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                                                            <option value="0">Beliebig</option>
                                                            <option value="1">Alle Tickets zusammen anbieten</option>
                                                            <option value="2">Vermeide 1 Restticket</option>
                                                            <option value="3">Vermeide 1 und 3 Resttickets</option>
                                                            <option value="4">Vermeide ungerade Zahlen</option>
                                                        </select>
                                                        @error('split')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                                            </svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div x-data="{ originalpreis: 0, brokerPrice: 0, websitePrice: 0}" class="col-span-full pt-2" x-effect="websitePrice = (Math.round((brokerPrice.split(',').join('.') /(100 - {{$chosenEventData['USAR_broker_provision']}}))*100)+1).toFixed(2)">
                                                <div class="flex relative">
                                                    <div class="col-span-4">
                                                        <label for="email" class="pr-2 pt-3 block text-sm font-medium leading-6 text-gray-900">Originalpreis</label>
                                                        <div class="mt-2">
                                                            <input type="text" id="faceValue"  wire:model.defer="faceValue"   onchange="(function(el){el.value=(el.value.split(',').join('.'))})(this)"  placeholder="Originalpreis" class="block  w-32 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                                                        </div>
                                                        @error('faceValue')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                                            </svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-span-4 px-6">
                                                        <label for="street-address" class="px-1 pt-3 block text-sm font-medium leading-6 text-gray-900">Ihre Auszahlung</label>
                                                        <div class="mt-2">
                                                            <input type="text" id="brokerPrice" wire:model.defer="brokerPrice"   x-model.defer="brokerPrice"   onchange="(function(el){el.value=(el.value.split(',').join('.'))})(this)" placeholder="Ihre Auszahlung" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                        </div>
                                                        @error('brokerPrice')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                                            </svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-span-4">
                                                        <label for="city" class="px-1 pt-3 block text-sm font-medium leading-6 text-gray-900">Ticket-Gesamtpreis</label>
                                                        <div class="mt-2">
                                                            <input   type="text" id="websitePrice" wire:model.defer="websitePrice" x-model.defer="websitePrice" onchange="(function(el){el.value=(el.value.split(',').join('.'))})(this)"   placeholder="Ticket-Gesamtpreis" class="block bg-indigo-300  w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"  readonly>
                                                        </div>


                                                        @error('websitePrice')
                                                        <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/>
                                                            </svg>
                                                            <p class="text-white">{{ $message }}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="sm:col-span-6 hidden">
                                                <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">Zusatzinformationen</label>
                                                <div class="mt-2">
                                                    <textarea type="hidden" name="ticketNotes" placeholder="Zusatzinformationenr" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                                </div>
                                            </div>

                                           {{-- <div class="col-span-full relative flex relative pt-5" x-data="{fastDelivery : false}">
                                                <div class="flex h-6 items-center">
                                                    <input id="offers" wire:model="fastDelivery" value="1" type="checkbox" x-model="fastDelivery" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                </div>
                                                <div class="pl-2 text-sm leading-6">
                                                    <label for="offers" class="font-medium text-gray-900">Tickets können direkt nach Zahlungseingang versendet werden</label>
                                                </div>
                                            </div>
                                            <div class="flex h-6 items-center hidden">
                                                <input id="offers" wire:model="fastDelivery" value="0" type="hidden" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                            </div>
--}}

                                            <div class="col-span-full relative flex relative pt-5" x-data="{fastDelivery : []}">
                                                <div class="flex h-6 items-center">
                                                    <input type="checkbox" wire:model="fastDelivery" value="1"  x-model="fastDelivery" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                </div>
                                                <div class="pl-2 text-sm leading-6">
                                                    <label for="offers" class="font-medium text-gray-900">Tickets können direkt nach Zahlungseingang versendet werden</label>
                                                </div>
                                            </div>


                                            <div class="col-span-full relative flex relative pt-5" x-data="{impaired : []}">
                                                <?php
                                                $array=array("Eventuell sichtbehindert"=>"1","Sicht eingeschränkt"=>"0");
                                                foreach($array as $x=>$x_value)
                                                {?><input type="radio" class="block text-sm font-medium leading-6 text-black justify-between mr-2" wire:model="choice"  value="<?php echo $x_value ?>" ><?php echo $x ?><br /><?php }?>
                                                @error('choice')
                                                <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                                    <p class="text-white">{{ $message }}</p>
                                                </div>
                                                @enderror
                                            </div>

                                        @endif
                                    </div>
                                </div>
                                <div class="pt-5">
                                    <div class="py-6 text-right">
                                        <button type="submit" class="mr-6 inline-flex items-center gap-x-2 rounded-md  bg-emerald-600 py-2.5 px-6 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                                            </svg>Speichern</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>



    <script>

        function fileUpload() {
            return {
                isDropping: false,
                isUploading: false,
                progress: 0,
                handleFileSelect(event) {
                    if (event.target.files.length) {
                        this.uploadFiles(event.target.files)
                    }
                },
                handleFileDrop(event) {
                    if (event.dataTransfer.files.length > 0) {
                        this.uploadFiles(event.dataTransfer.files)
                    }
                },
                uploadFiles(files) {
                    const $this = this;
                    this.isUploading = true
                @this.uploadMultiple('files', files,
                    function (success) {
                        $this.isUploading = false
                        $this.progress = 0
                    },
                    function(error) {
                        console.log('error', error)
                    },
                    function (event) {
                        $this.progress = event.detail.progress
                    }
                )
                },
                removeUpload(filename) {
                @this.removeUpload('files', filename)
                },
            }
        }
    </script>


</div>
