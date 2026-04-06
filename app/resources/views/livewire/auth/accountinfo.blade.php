<div>
    <div class="sm:col-span-6">
        <div class="py-5">
            <div id="cards" class="flex border py-2 text-black pr-10">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700 -ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <p class="px-4 text-base text-black pt-2 font-semibold md:text-xl">“Einstellungen - Kontoverbindung”</p>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-4xl  p-6 bg-gray-400">
        <form id="form" class="space-y-8 divide-y divide-gray-200  rounded-t-md border-2 py-4 bg-white" wire:submit.prevent="saveBrokerDataAccountInfo(Object.fromEntries(new FormData($event.target)))">
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
            <div class="space-y-8 divide-y divide-gray-200 px-6">

                <div class="sm:col-span-12">
                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Account Type</label>
                    <select id="acOption" name="account_type"   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" onchange="showDiv('s_iban', this)">
                        <option selected>-- Bitte wählen --</option>
                        <option value="bc">Bank Konto</option>
                        <option value="cc">Credit Konto</option>
                    </select>
                </div>
                {{--for bak konto infor--}}
                <div class="pt-8 hidden_div" id="s_iban">
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Kontoinhaber</label>
                            <div class="mt-2">
                                <input type="text" name="account_holder"  value="@if(!empty($brokerData['account_holder'])){{$brokerData['account_holder']}}@endif"  placeholder="Account holder" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('account_holder')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Name der Bank</label>
                            <div class="mt-2">
                                <input type="text" name="bank_name"   value="@if(!empty($brokerData['bank_name'])){{$brokerData['bank_name']}}@endif"  placeholder="Name der Bank" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('bank_name')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">IBAN</label>
                            <div class="mt-2">
                                <input type="text" id="iban" size="35"  name="iban" value="@if(!empty($brokerData['iban'])){{$brokerData['iban']}}@endif"  placeholder="IBAN" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('iban')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">BIC</label>
                            <div class="mt-2">
                                <input type="text" name="bic"  value="@if(!empty($brokerData['bic'])){{$brokerData['bic']}}@endif"   placeholder="BIC" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('bic')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{--end for bank koto--}}

                {{--start for the credit konto--}}
                <div class="pt-8 hidden_div" id="s_credit">
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Kontoinhaber</label>
                            <div class="mt-2">
                                <input type="text" name="account_holder"  value="@if(!empty($brokerData['account_holder'])){{$brokerData['account_holder']}}@endif"  placeholder="Account holder" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('account_holder')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Card Nummmer</label>
                            <div class="mt-2">
                                <input type="text" size="35" name="credit_c"    id="txtCardNumber"  placeholder="xxxx-xxxx-xxxx-xxxx"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('iban')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Valid Till</label>
                            <div class="mt-2">
                                <input type="text" name="bic"  value="@if(!empty($brokerData['bic'])){{$brokerData['bic']}}@endif"   placeholder="05/2030" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('bic')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Security code</label>
                            <div class="mt-2">
                                <input type="text" name="bic"  value="@if(!empty($brokerData['bic'])){{$brokerData['bic']}}@endif"   placeholder="569" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            @error('bic')
                            <div class="my-2 flex items-center bg-red-700 text-white text-sm font-bold px-4 py-3" role="alert">
                                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                <p class="text-white">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
                {{--end of credit konto--}}

            <div class="pt-5">
                <div class="py-6 text-right">
                    <button type="submit" class="mr-6 inline-flex items-center gap-x-2 rounded-md  bg-emerald-600 py-2.5 px-6 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="-ml-0.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        Speichern
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>

        /*for select option bank and credit car*/
        function showDiv(divId, element)
        {
            let s_iban= document.getElementById('s_iban');
            let s_credit= document.getElementById('s_credit');

            if(document.getElementById(divId).style.display = element.value == 'bc'){

                s_iban.style.display = 'block';
                s_credit.style.display = 'none';
            }else if(document.getElementById(divId).style.display = element.value == 'cc'){
                s_credit.style.display = 'block';
                s_iban.style.display = 'none';
            }else{
                s_iban.style.display = 'none';
                s_credit.style.display = 'none';
            }
        }
        /*end of select option*/


        /*for credit card format*/
        var txtCardNumber = document.querySelector("#txtCardNumber");
        txtCardNumber.addEventListener("input", onChangeTxtCardNumber);

        function onChangeTxtCardNumber(e) {
            var cardNumber = txtCardNumber.value;

            // Do not allow users to write invalid characters
            var formattedCardNumber = cardNumber.replace(/[^\d]/g, "");
            formattedCardNumber = formattedCardNumber.substring(0, 16);

            // Split the card number is groups of 4
            var cardNumberSections = formattedCardNumber.match(/\d{1,4}/g);
            if (cardNumberSections !== null) {
                formattedCardNumber = cardNumberSections.join('-');
            }
            console.log("'"+ cardNumber + "' to '" + formattedCardNumber + "'");
            if (cardNumber !== formattedCardNumber) {
                txtCardNumber.value = formattedCardNumber;
            }
        }
        /*end of credit card format*/



        /*iban number format*/

        let isAndroid = navigator.userAgent.indexOf("android") > -1;
        let element = document.getElementById('iban');

        element.addEventListener('input', function () {
            if (isAndroid) {

                setTimeout(reformatInputField);
                return;
            }
            reformatInputField();
        });

        function reformatInputField() {
            function format(value) {
                return value.replace(/[^\dA-Z]/gi, '')
                    .toUpperCase()
                    .replace(/(.{4})/g, '$1 ')
                    .trim();
            }
            function countSpaces(text) {
                let spaces = text.match(/(\s+)/g);
                return spaces ? spaces.length : 0;
            }

            let position = element.selectionEnd;
            let previousValue = element.value;
            element.value = format(element.value);

            if (position !== element.value.length) {
                let beforeCaret = previousValue.substr(0, position);
                let countPrevious = countSpaces(beforeCaret);
                let countCurrent = countSpaces(format(beforeCaret));
                element.selectionEnd = position + (countCurrent - countPrevious);
            }
        }
        /*end iban number format*/
    </script>

</div>
