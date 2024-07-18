<x-layout>
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow">
            <a href="{{ route('welcome') }}" class="group relative min-w-0 flex-1 overflow-hidden rounded-l-lg bg-white px-4 py-4 text-center text-sm font-medium text-gray-900 hover:bg-gray-50 focus:z-10" aria-current="page">
                <span>Home</span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5 bg-transparent"></span>
            </a>
            <a href="{{ route('bypostcode.index') }}" class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
                <span>By Postcode</span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5 bg-indigo-500"></span>
            </a>
            <a href="{{ route('byid.index') }}" class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
                <span>By ID</span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5 bg-transparent"></span>
            </a>
        </nav>

        <div class="mt-8 bg-white px-6 py-6 lg:px-4">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Address Search</h2>
                <p class="mt-3 text-lg leading-8 text-gray-600">A RESTful API using PHP and Laravel to manage UK addresses</p>
            </div>
        </div>

        @if(isset($status) && $status === "error")
            <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">{{ $message }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-6 shadow sm:overflow-hidden sm:rounded-md">
            <form action="{{ route('bypostcode.show') }}" method="post">
                @csrf
                <div class="bg-white px-4 py-6 sm:p-6">
                    <div>
                        <h2 id="payment-details-heading" class="text-lg font-medium leading-6 text-gray-900">Search by Postcode</h2>
                        <p class="mt-1 text-sm text-gray-500">Find addresses using a UK post code</p>
                    </div>
                    <div class="mt-6 grid grid-cols-4 gap-6">
                        <div class="col-span-4 sm:col-span-2">
                            <label for="postcode" class="block text-sm font-medium leading-6 text-gray-900">Post Code <span class="text-red-600">*</span></label>
                            <input type="text" name="postcode" id="postcode" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-900 sm:text-sm sm:leading-6" value="{{ old('postcode') }}">
                            @error('postcode')
                            <div class="mt-2 text-red-700 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-left sm:px-6 flex items-center">
                    <button type="submit" class="inline-flex justify-center rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Search</button>
                    <div class="ml-3 text-sm text-gray-600">* Required</div>
                </div>
            </form>
        </div>

        @if (isset($addresses))
            <ul role="list" class="my-6 divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                @foreach($addresses as $address)
                    <li class="px-4 py-5 hover:bg-gray-50 sm:px-6">
                        <form action="{{ route('bypostcode.store') }}" method="post" class="flex justify-between items-center">
                            @csrf
                            <div class="w-full max-w-96 text-sm">{{ $address['address'] }}</div>
                            <button type="submit" class="rounded-md bg-gray-900 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Save Address</button>
                            <input type="hidden" name="id" id="id" value="{{ $address['id'] }}">
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        @if (isset($stored_address))
            <div class="my-6 overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-6 sm:px-6">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Record Details</h3>
                </div>
                <div class="border-t border-gray-100">
                    <dl class="divide-y divide-gray-100">
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Record ID</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->id }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Company Name</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->company_name }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Address Line 1</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->address_1 }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Address Line 2</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->address_2 }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">City</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->city }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">County</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->county }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Postcode</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->postcode }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Country</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->country }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Longitude</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->longitude }}</dd>
                        </div>
                        <div class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-900">Latitude</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $stored_address->latitude }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        @elseif(!isset($stored_address) && !isset($status))
            <div class="mt-6 border-l-4 border-yellow-400 bg-yellow-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">No addresses found.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>
