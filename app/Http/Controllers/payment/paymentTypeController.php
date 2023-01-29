<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Models\paymentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class paymentTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $paymentTypes = paymentType::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all payment types',
            'data' => $paymentTypes,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_type' => 'required | min:3'
        ]);

        $paymentType = paymentType::create([
            'value' => $request['payment_type']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'payment types added successfully',
            'data' => $paymentType,
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
        $paymentType = paymentType::find($id);

        if (! $paymentType) {
            return response()->json([
                'status' => 'error',
                'message' => 'payment Type not found',
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'payment types info',
            'data' => $paymentType,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'payment_type' => 'required | min:3'
        ]);

        $paymentType = paymentType::find($id);

        if (! $paymentType) {
            return response()->json([
                'status' => 'error',
                'message' => 'payment Type not found',
            ], 400);
        }

        $paymentType->update([
            'value' => $request['payment_type']
        ]);

        $paymentType->save();
        return response()->json([
            'status' => 'success',
            'message' => 'payment types updated successfully',
            'data' => $paymentType,
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
        $paymentType = paymentType::find($id);

        if (! $paymentType) {
            return response()->json([
                'status' => 'error',
                'message' => 'payment Type not found',
            ], 400);
        }

        $paymentType->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'payment Type deleted successfully',
        ]);
    }
}
