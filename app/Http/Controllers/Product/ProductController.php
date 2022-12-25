<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\StoreProductRequest;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all products',
            'data' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return Response
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'],
            'category_id' => $validated['category_id'],
            'sub_category_id' => $validated['sub_category_id'],
            'brand_id' => $validated['brand_id'],
        ]);

        if ($request->has('colors')) {
            $colors = $request['colors'];

            foreach ($colors as $color) {
                Color::create([
                    'value' => $color['value'],
                    'product_id' => $product['id']
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
