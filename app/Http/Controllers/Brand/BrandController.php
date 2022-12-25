<?php

namespace App\Http\Controllers\Brand;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Brnad\StoreBrandRequest;
use Intervention\Image\Facades\Image;
use App\Http\Resources\BrandResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Create a new BrandController instance.
     *
     * @return void
     */
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
        $brands = Brand::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all brands',
            'data' => BrandResource::collection($brands),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBrandRequest $request
     * @return JsonResponse
     */
    public function store(StoreBrandRequest $request)
    {
        $validated = $request->validated();

        $brand_image = $request->file('brand_img');
        $name_generation = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->save('images/brand/'.$name_generation);
        $path = 'images/brand/'.$name_generation;

        $brand = Brand::create([
            'name' => $validated['name'],
            'brand_img' => $path,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'brand created successfully',
            'data' => $brand
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
        $brand = Brand::where('id', $id)->first();

        if (! $brand) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'brand not found'
            ], 400));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get brand info',
            'data' => BrandResource::make($brand)
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
            'name' => 'string | min:2'
        ]);

        $brand = Brand::where('id', $id)->first();

        if (! $brand) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'brand not found'
            ], 400));
        }

        if ( $request->has( file('brand_img'))) {

            $request->validate(['brand_img' => 'image | mimes:jpeg,png,jpg,gif']);
            $brand_image = $request->file('brand_img');

            unlink($brand['brand_img']);

            $name_generation = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->save('images/brand/'.$name_generation);
            $path = 'images/brand/'.$name_generation;

            $brand::update([
                'name' => $request['name'],
                'brand_img' => $path,
            ]);

            $brand->save();
        }

        $brand::update([
            'name' => $request['name'],
        ]);

        $brand->save();

        return response()->json([
            'status' => 'success',
            'message' => 'brand updated successfully',
            'data' => BrandResource::make($brand)
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
        $brand = Brand::where('id', $id)->first();

        if (! $brand) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'brand not found'
            ], 400));
        }

        unlink($brand['brand_img']);
        $brand->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'brand deleted successfully',
        ]);
    }
}
