<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
        <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow">
            <a href="{{ route('welcome') }}" class="group relative min-w-0 flex-1 overflow-hidden rounded-l-lg bg-white px-4 py-4 text-center text-sm font-medium text-gray-900 hover:bg-gray-50 focus:z-10" aria-current="page">
                <span>Home</span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5 bg-transparent"></span>
            </a>
            <a href="{{ route('bypostcode.index') }}" class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
                <span>By Postcode</span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5 bg-transparent"></span>
            </a>
            <a href="{{ route('byid.index') }}" class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
                <span>By ID</span>
                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-0.5 bg-indigo-500"></span>
            </a>
        </nav>

        <div class="mt-8 bg-white px-6 py-6 lg:px-4">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Address Search</h2>
                <p class="mt-3 text-lg leading-8 text-gray-600">A RESTful API using PHP and Laravel to manage UK addresses</p>
            </div>
        </div>

        <div class="mt-6 shadow sm:overflow-hidden sm:rounded-md">
            <form action="{{ route('byid.show') }}" method="post">
                @csrf
                <div class="bg-white px-4 py-6 sm:p-6">
                    <div>
                        <h2 id="payment-details-heading" class="text-lg font-medium leading-6 text-gray-900">Search by ID</h2>
                        <p class="mt-1 text-sm text-gray-500">Find address details via its record ID</p>
                    </div>
                    <div class="mt-6 grid grid-cols-4 gap-6">
                        <div class="col-span-4 sm:col-span-2">
                            <label for="id" class="block text-sm font-medium leading-6 text-gray-900">Record ID <span class="text-red-600">*</span></label>
                            <input type="text" name="id" id="id" class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-900 sm:text-sm sm:leading-6" value="{{ old('id') }}">
                            @error('id')
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

    </div>
</body>
</html>
