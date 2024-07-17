<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchAddressRequest;
use App\Http\Requests\SearchByIdRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AddressController extends Controller
{
    /**
     * Display the index page for searching addresses by postcode.
     *
     */
    public function byPostcodeIndex(Request $request)
    {
        return view('address.bypostcode.index');
    }

    /**
     * Display the page to show addresses by postcode.
     */
    public function byPostcodeShow(SearchAddressRequest $request)
    {
        $response = Http::get(config('app.url') . '/api/v1/lookup/' . $request->postcode);
        $response = $response->json('data');

        return view('address.bypostcode.show', ['addresses' => $response]);
    }

    /**
     * Store a new address obtained from external API.
     */
    public function byPostcodeStore(Request $request)
    {
        $response = Http::get(config('app.url') . '/api/v1/lookup/show/' . $request->id);
        $response = $response->json('data');

        $new_address = Address::create([
            'id' => Str::uuid(),
            'company_name' => $response['residential'] === false ? $response['line_1'] : "",
            'address_1' => $response['residential'] === false ? $response['line_2'] : $response['line_1'],
            'address_2' => $response['residential'] === false ? "" : $response['line_2'],
            'city' => $response['town_or_city'],
            'county' => $response['county'],
            'postcode' => $response['postcode'],
            'country' => $response['country'],
            'longitude' => $response['longitude'],
            'latitude' => $response['latitude'],
        ]);

        return view('address.bypostcode.index', ['stored_address' => $new_address]);
    }

    /**
     * Display the index page for searching addresses by ID.
     */
    public function byIdIndex(Request $request)
    {
        return view('address.byid.index');
    }

    /**
     * Display the address details page by ID.
     */
    public function byIdShow(SearchByIdRequest $request)
    {
        $response = Http::get(config('app.url') . '/api/v1/lookup/find/' . $request->id);
        $response = $response->json('data');

        return view('address.byid.show', ['address' => $response]);
    }
}
