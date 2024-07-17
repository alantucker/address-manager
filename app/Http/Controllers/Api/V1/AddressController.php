<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = Http::get('api.getAddress.io/autocomplete/' . $request->postcode . '?api-key=' . config('address.address_api_key'));

        if (!$response->successful()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Something went wrong'
            ], 400);
        }

        $response = json_decode($response->body());

        if ($response->suggestions == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No search results'
            ], 404);
        }

        return response()->json([
            'data' => $response->suggestions
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $response = Http::get('api.getAddress.io/get/' . $request->id . '?api-key=' . config('address.address_api_key'));

        if (!$response->successful()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Something went wrong'
            ], 400);
        }

        $response = json_decode($response->body());

        if ($response == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'No search results'
            ], 404);
        }
        return response()->json([
            'data' => $response
        ], 200);
    }

    /**
     * Finds an address using the given request parameters.
     */
    public function find(Request $request)
    {
        $response = Http::get(config('app.url') . '/api/v1/lookup/find/' . $request->id);
        $response = json_decode($response->body());

        return response()->json([
            'data' => $response
        ], 200);
    }
}
