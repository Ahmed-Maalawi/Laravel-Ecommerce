<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\product\StoreProductRequest;
use Intervention\Image\Facades\Image;
use App\Models\product\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::whith(['images', 'colors'])->all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all products',
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
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

//        ------------  insert product colors -------------
        if ($request->has('colors')) {
            $colors[] = $request['colors'];
            foreach ($colors as $color) {
                Color::create([
                    'value' => $color['value'],
                    'product_id' => $product['id']
                ]);
            }
        }

//        -------------- insert product images ---------------


        if ($request->hasFile('images')) {
            $productImages[]= $request->file('images');
            foreach ($productImages as $img) {
                $this->saveImage($img, $product['id']);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'product created successfully',
            'data' => $product
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $product = Product::where('id', $id)->with('colors')->first();

        if (! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 400));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get product info',
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreProductRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(StoreProductRequest $request,int $id)
    {
        $validated = $request->validated();

        $product = Product::where('id', $id)->fitst();

        if (! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 400));
        }

        $product->update([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'],
            'category_id' => $validated['category_id'],
            'sub_category_id' => $validated['sub_category_id'],
            'brand_id' => $validated['brand_id'],
        ]);

        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'product updated successfully',
            'data' => $product
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
        $product = Product::where('id', $id)->fitst();

        if (! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 400));
        }

        $imges = ProductImage::where('product_id', $id)->get();

        foreach ($imges as $img){
            unlink($img['image_path']);
            $img->delete();
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'product deleted successfully',
            'data' => $product
        ]);
    }

    public function saveImage($img, int $id)
    {
        $name_generation = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->save('images/product/'.$name_generation);
        $path = 'images/product/'.$name_generation;

        $productImg = ProductImage::create([
            'image_path' => $path,
            'product_id' => $id
        ]);
    }

    public function addProductImages(Request $request, int $id)
    {
        $product = Product::where('id', $id)->first();

        if (! $product) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'product not found'
            ], 400));
        }

        try {
            if ($images = $request->hasFile('images')) {
                foreach ($images as $img) {
                    $this->saveImage($img, $id);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'images uploaded successfully',
                'data' => $product->with(['color', 'images'])
            ]);

        } catch (HttpResponseException) {

            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'image upload error'
            ]));

        }
    }

    public function deleteImage(int $id)
    {
        $image = ProductImage::where('id', $id)->first();

        unlink($image['image_path']);

        $image->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'image deleted successfully',
        ]);
    }
}
