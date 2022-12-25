<?php

namespace App\Http\Controllers\Category;

use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Category\StoreCategoryRequest;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'message' => 'get all categories',
            'data' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $brand_image = $request->file('category_img');
        $name_generation = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->save('images/category/'.$name_generation);
        $path = 'images/category/'.$name_generation;

        $category = Category::create([
            'name' => $validated['name'],
            'category_img' => $path,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'category created successfully',
            'data' => CategoryResource::make($category)
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
        $category = Category::where('id', $id)->first();

        if (! $category) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 400));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'get category info',
            'data' => CategoryResource::make($category)
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

        $category = Category::where('id', $id)->first();

        if (! $category) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 400));
        }

        if ( $request->has( file('category_img') ) ) {

            $request->validate(['category_img' => 'image | mimes:jpeg,png,jpg,gif']);
            $brand_image = $request->file('category_img');

            unlink($category['category_img']);

            $name_generation = hexdec(uniqid('', true)).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->save('images/category/'.$name_generation);
            $path = 'images/brand/'.$name_generation;

            $category::update([
                'name' => $request['name'],
                'category_img' => $path,
            ]);

            $category->save();
        }

        $category::update([
            'name' => $request['name'],
        ]);

        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'category updated successfully',
            'data' => CategoryResource::make($category)
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
        $category = Category::where('id', $id)->first();

        if (! $category) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'category not found'
            ], 400));
        }

        unlink($category['category_img']);
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'category deleted successfully'
        ]);
    }
}
