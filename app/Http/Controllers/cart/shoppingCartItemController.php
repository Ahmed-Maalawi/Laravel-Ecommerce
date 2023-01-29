<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\cart\storShoppingCartItemRequest;
use App\Models\shoppingCartItem;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\shoppingCart;
use Illuminate\Http\Response;

class shoppingCartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $cart = shoppingCart::where('user_id', auth()->id())->first();

        if (! $cart) {
            $cart = shoppingCart::create([
                'user_id' => auth()->id(),
            ]);
        }

        $items = $cart->shoppingItems();

        return response()->json([
            'status' => 'success',
            'message' => 'get cart items',
            'data' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param storShoppingCartItemRequest $request
     * @return JsonResponse
     */
    public function store(storShoppingCartItemRequest $request)
    {
        $validated = $request->validated();

        $cart = shoppingCart::where('user_id', auth()->id())->first();

        if (! $cart) {
            $cart = shoppingCart::create([
                'user_id' => auth()->id(),
            ]);
        }

        $item = shoppingCartItem::create([
            'user_id' => $cart->id,
            'product_id' => $validated['product_id'],
            'qty' => $validated['qty'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'item added successfully',
            'data' => $item,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
//     * @param  int  $id
//     * @return Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
//     * @param Request $request
//     * @param  int  $id
//     * @return Response
     */
//    public function update(Request $request, $id)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $item = shoppingCartItem::find($id);

        if (! $item) {
            return response()->json([
                'status' => 'error',
                'message' => 'item not found',
            ], 400);
        }

        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'item deleted successfully',
        ]);
    }
}
