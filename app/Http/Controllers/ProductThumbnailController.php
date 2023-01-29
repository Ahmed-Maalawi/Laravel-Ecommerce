<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductThumbnailRequest;
use App\Http\Requests\UpdateProductThumbnailRequest;
use App\Models\ProductThumbnail;

class ProductThumbnailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductThumbnailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductThumbnailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductThumbnail  $productThumbnail
     * @return \Illuminate\Http\Response
     */
    public function show(ProductThumbnail $productThumbnail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductThumbnail  $productThumbnail
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductThumbnail $productThumbnail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductThumbnailRequest  $request
     * @param  \App\Models\ProductThumbnail  $productThumbnail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductThumbnailRequest $request, ProductThumbnail $productThumbnail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductThumbnail  $productThumbnail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductThumbnail $productThumbnail)
    {
        //
    }
}
