<?php

namespace App\Http\Controllers\favourite;

use App\Http\Resources\product\FavouriteItem as resource;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\FavouriteItem;
use App\Models\Product;

class FavouriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $user_id = auth()->id();

        $favourites = FavouriteItem::query()
            ->where('user_id', $user_id)->get();

        foreach ($favourites as $item) {
            $item['product'] = Product::where('id', $item['product_id'])->with('images')->first();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get favourite items',
            'data' => resource::collection($favourites),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function store(int $id)
    {
        $user_id = auth()->id();

        $is_found = FavouriteItem::where(['user_id' => $user_id, 'product_id' => $id])->first();

        if ($is_found) {
            return response()->json([
                'status' => 'error',
                'message' => 'product already added',
            ], 400);
        }

        $product = Product::where('id', $id)->first();

        if (! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 400));
        }

        $item = FavouriteItem::create([
            'user_id' => $user_id,
            'product_id' => $product['id'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'item added successfully',
            'data' => $item
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $item = FavouriteItem::where('id', $id)->first();

        if (! $item) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'item not found',
            ], 400));
        }

        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'product remove successfully',
        ]);
    }
}
