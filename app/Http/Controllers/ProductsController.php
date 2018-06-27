<?php

namespace App\Http\Controllers;

use App\Pdv\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use App\Product;

class ProductsController extends ApiController
{
    /**
     * @var Pdv\Transformers\ProductTransformer
     */
    protected $productTransformer;

    function __construct(ProductTransformer $productTransformer)
    {
        $this->productTransformer = $productTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return $this->respond([
            'data' => $this->productTransformer->transformCollection($products->all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if ( ! $product) {
            return $this->respondNotFound('Product does not exist.');
        }

        return $this->respond([
            'data' => $this->productTransformer->transform($product)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
