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

        $response = Http::post(config('app.url') . '/api/v1/address/store/' . $request->id);
        $response = json_decode($response->body());

        if (isset($response->status) && $response->status == "error") {
            return view('address.bypostcode.show', [
                'status' => $response->status,
                'message' => $response->message
            ]);
        }

        return view('address.bypostcode.show',[
            'status' => 'success',
            'stored_address' => $response->data
        ]);
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
