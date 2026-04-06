<div>


    <div class="sm:col-span-6">
        <div class="py-5">
            <div id="cards" class="flex border py-2 pr-10">
                <div><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Einstellungen”</p>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-4xl pt-6">
        @if (session()->has('message'))
            <div class="bg-gray-800  max-w-2xl h-12">
                <div class=" w-70 px-4 sm:px-6 lg:px-8">
                    <div class="alert alert-success text-white w-70 pt-3 flex inline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg> <div class="px-6">{{ session('message') }}</div>
                    </div>
                </div>
            </div>
        @endif


        <div class="mx-auto max-w-4xl  p-6 bg-gray-400">
            <form id="form" class="space-y-8 divide-y divide-gray-200 rounded-t-md border-2 py-4 bg-white" wire:submit.prevent="saveBrokerData(Object.fromEntries(new FormData($event.target)))">
                <div class="space-y-8 divide-y divide-gray-200 px-6">
                    <div class="pt-8">
                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label  class="block text-sm font-medium leading-6 text-gray-900">Art des Verkäuferkontos</label>
                                <select  id ="onchange"  onchange="ShowHideDiv()" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" name="accountType" >
                                    <?php
                                    $array=array("Bitte wählen"=>"0","Ich bin privater Verkäufer"=>"private","Ich bin gewerblicher Verkäufer"=>"commercial");
                                    foreach($array as $selelr_type=>$x_value)
                                    {?><option  value="<?php echo $x_value ?>" {{ $accountType  == $x_value ? 'selected="selected"' : '' }}><?php echo $selelr_type ?><br /><?php }?></option>
                                </select>

                                @error('accountType')
                                <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                    <p class="text-white">{{ $message }}</p>
                                </div>
                                @enderror
                            </div>


                            @if($sellerTerms =='')

                            <div id="private" class="sm:col-span-6" x-cloak>
                                <div  class="sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="Username" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Username">
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    {{--file upload--}}
                                    <div x-data="fileUpload()">
                                        <div class="relative flex flex-col items-center justify-center h-50 bg-slate-200"
                                             x-on:drop="isDropping = false"
                                             x-on:drop.prevent="handleFileDrop($event)"
                                             x-on:dragover.prevent="isDropping = true"
                                             x-on:dragleave.prevent="isDropping = false"
                                        >
                                            <div class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-blue-500 opacity-90"
                                                 x-show="isDropping"
                                            >
                                                <span class="text-3xl text-white">Release file to upload!</span>
                                            </div>

                                            <label class="flex flex-col items-center justify-center w-full bg-white border  cursor-pointer select-none h-1/2 rounded-xl hover:bg-slate-50"
                                                   for="file-upload"
                                            >
                                                <em class="italic text-slate-400">(drag files to the page)</em>
                                                <div class="bg-gray-200  w-1/2 mt-3">
                                                    <div
                                                        class="bg-blue-500 h-[2px]"
                                                        style="transition: width 1s"
                                                        :style="`width: ${progress}%;`"
                                                        x-show="isUploading"
                                                    >
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
                            </div>

                            @endif

                            <div id="commercial" class="sm:col-span-6" x-cloak>
                                <div class="sm:col-span-3" >
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Umsatzsteuer-Identifikationsnummer</label>
                                    <div class="mt-2">
                                        <input type="text" name="vat_id" value="@if(!empty($vat_id)){{$vat_id}}@endif"  class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Identifikationsnummer" >
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Firma (optional)</label>
                                    <div class="mt-2">
                                        <input type="text" name="company" value="@if(!empty($company)){{$company}}@endif" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Firma">
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label class="block text-sm font-medium leading-6 text-black">AGB</label>
                                    <div class="mt-2">
                                    <textarea  name="agb_seller_message" rows="6" class="text-left text-sm font-medium leading-6 block w-full rounded-md border-gray-300  text-black shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6" >
                                        @if(!empty($sellerTerms)){{$sellerTerms}}@endif</textarea>
                                    </div>
                                </div>


                                <button  wire:click="@if(!empty($sellerTerms))closeDefaultSellerTerms()@else getDefaultSellerTerms()@endif"  type="button"  class="py-3 inline-flex w-full justify-center rounded-md @if(!empty($sellerTerms)) bg-red-600 @else bg-green-500 @endif px-2 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-blue-600 sm:col-start-1 sm:mt-0">
                                    <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                    AGB laden
                                </button>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-60 border-none px-8">
                    <button type="submit" class="py-3 inline-flex w-50 justify-center rounded-md bg-indigo-600 px-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">
                        <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        Speichern
                    </button>
                </div>
            </form>
        </div>

    </div>




    <script>
        window.onload = function () {
            var onchangeSellerType = document.getElementById("onchange");
            private.style.display = onchangeSellerType.value == "private" ? "block" : "none";
            commercial.style.display = onchangeSellerType.value == "commercial" ? "block" : "none";
        };

        function ShowHideDiv() {
            var onchangeSellerType = document.getElementById("onchange");
            private.style.display = onchangeSellerType.value == "private" ? "block" : "none";
            commercial.style.display = onchangeSellerType.value == "commercial" ? "block" : "none";
        }


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

