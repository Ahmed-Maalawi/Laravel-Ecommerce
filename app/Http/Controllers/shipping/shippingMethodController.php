<?php

namespace App\Http\Controllers\shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\shipping\storeShippingMethodRequest;
use App\Models\shippingMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class shippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $shippingMethods = shippingMethod::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all shipping Methods',
            'data' => $shippingMethods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storeShippingMethodRequest $request
     * @return JsonResponse
     */
    public function store(storeShippingMethodRequest $request)
    {
        $request->validated();

        $shippingMethod = shippingMethod::create([
            'name' => $request['shipping_name'],
            'price' => $request['shipping_price'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'shipping Methods added successfully',
            'data' => $shippingMethod,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $shippingMethod = shippingMethod::first($id);

        if (! $shippingMethod) {
//            abort(400, 'order status not found');
            return response()->json([
                'status' => 'error',
                'message' => 'shipping Methods not found',
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'shipping Methods all info',
            'data' => $shippingMethod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param storeShippingMethodRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(storeShippingMethodRequest $request, int $id)
    {
        $shippingMethod = shippingMethod::first($id);

        $request->validated();

        if (! $shippingMethod) {
//            abort(400, 'order status not found');
            return response()->json([
                'status' => 'error',
                'message' => 'shipping Method not found',
            ], 400);
        }

        $shippingMethod->update([
            'name' => $request['shipping_name'],
            'price' => $request['shipping_price'],
        ])->update();

        return response()->json([
            'status' => 'success',
            'message' => 'shipping Method updated successfully',
            'data' => $shippingMethod,
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
        $shippingMethod = shippingMethod::first($id);

        if (! $shippingMethod) {
//            abort(400, 'order status not found');
            return response()->json([
                'status' => 'error',
                'message' => '$shipping Method not found',
            ], 400);
        }

        $shippingMethod->delete();

        return response()->json([
            'status' => 'success',
            'message' => '$shipping Method deleted successfully',
        ]);
    }
}
