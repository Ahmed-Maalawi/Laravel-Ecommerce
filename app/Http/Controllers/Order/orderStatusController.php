<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\StoreOrderStatusRequest;
use App\Models\orderStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class orderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $orderStatus = orderStatus::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all order status',
            'data' => $orderStatus,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderStatusRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderStatusRequest $request)
    {
        $request->validated();

        $orderStatus = orderStatus::create([
            'status' => $request['order_status'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'order status added successfully',
            'data' => $orderStatus,
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
        $orderStatus = orderStatus::first($id);

        if (! $orderStatus) {
//            abort(400, 'order status not found');
            return response()->json([
                'status' => 'error',
                'message' => 'order status not found',
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'status order all info',
            'data' => $orderStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrderStatusRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(StoreOrderStatusRequest $request, $id)
    {
        $orderStatus = orderStatus::first($id);

        if (! $orderStatus) {
//            abort(400, 'order status not found');
            return response()->json([
                'status' => 'error',
                'message' => 'order status not found',
            ], 400);
        }

        $orderStatus->update([
            'status' => $request['order_status'],
        ])->update();

        return response()->json([
            'status' => 'success',
            'message' => 'status order updated successfully',
            'data' => $orderStatus,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $orderStatus = orderStatus::first($id);

        if (! $orderStatus) {
//            abort(400, 'order status not found');
            return response()->json([
                'status' => 'error',
                'message' => 'order status not found',
            ], 400);
        }

        $orderStatus->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'status order deleted successfully',
        ]);
    }
}
