<?php

namespace App\Http\Controllers\Category;

use App\Http\Requests\Category\StoreSubCategoryRequest;
use App\Http\Resources\Category\SubCategoryResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $allSubCategories = SubCategory::with('category')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'get all sub-categories',
            'data' => SubCategoryResource::collection($allSubCategories)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $validated = $request->validated();

        $subCategory = SubCategory::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'sub category added successfully',
            'data' => $subCategory
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
        $subCategory = SubCategory::where('id', $id)->first();

        if (! $subCategory) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'sub category not found'
            ], 400));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'sub category info',
            'data' => SubCategoryResource::make($subCategory)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSubCategoryRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(StoreSubCategoryRequest $request, int $id)
    {
        $validated = $request->validated();

        $subCategory = SubCategory::where('id', $id)->first();

        if (! $subCategory) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'sub category not found'
            ], 400));
        }

        $subCategory->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
        ]);

        $subCategory->save();

        return response()->json([
            'status' => 'success',
            'message' => 'sub category updated successfully',
            'data' => $subCategory
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
        $subCategory = SubCategory::where('id', $id)->first();

        if (! $subCategory) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'sub category not found'
            ], 400));
        }

        $subCategory->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'sub category updated successfully',
            'data' => $subCategory
        ]);
    }
}
