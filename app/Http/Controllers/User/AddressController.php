<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAddressRequest;
use App\Models\Address;
use App\Models\UserAddress;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $user_id = auth()->id();

        $addresses = Address::where('id', $user_id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'get user addresses',
            'data' => $addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return JsonResponse
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddressRequest $request
     * @return JsonResponse
     */
    public function store(StoreAddressRequest $request)
    {
        $validated = $request->validated();
        $user_id = auth()->id();

        $address = Address::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);

        UserAddress::create([
            'user_id' => $user_id,
            'address_id' => $address['id']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'address created successfully',
            'data' => $address
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $address = Address::where('id', $id)->first();

        if (! $address) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'Address not found'
            ], 400));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get address details'
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  int  $id
//     * @return Response
     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAddressRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(StoreAddressRequest $request, int $id)
    {
        $address = Address::where('id', $id)->first();

        if (! $address) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'Address not found'
            ], 400));
        }

        $address->update([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);

        $address->save();

        return response()->json([
            'status' => 'success',
            'message' => 'address updated successfully',
            'data' => $address
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $address = UserAddress::where('id', $id)->first();

        if (! $address) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'Address not found'
            ], 400));
        }

        $address->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'address deleted successfully'
        ]);
    }
}
