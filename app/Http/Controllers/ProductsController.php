<?php

namespace App\Http\Controllers;

use App\Api\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use App\Product;
use Validator;

class ProductsController extends ApiController
{
    /**
     * @var Api\Transformers\ProductTransformer
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
        $products = Product::paginate();

        return $this->respondWithPagination(
            $products,
            ['data' => $this->productTransformer->transformCollection((array)$products->all())]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'numeric',
            'code' => 'required|unique:products|max:50',
            'active' => 'boolean',
            'description' => 'required|max:255',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->respondNotValid($validator->errors());
        }

        // TODO refactor, be explicit with fields
        $product = Product::create($request->all());

        return $this->respondCreated($product, 'Product successfully created.');
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
        $validator = Validator::make($request->all(), [
            'category_id' => 'numeric',
            'code' => 'unique:products|max:50',
            'active' => 'boolean',
            'description' => 'required|max:255',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->respondNotValid($validator->errors());
        }

        $product = Product::find($id);

        if ( ! $product) {
            return $this->respondNotFound('Product does not exist.');
        }

        $product->update([
            'description' => $request->description,
            'price' => $request->price
        ]);

        return $this->respondUpdated($product, 'Product successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ( ! $product) {
            return $this->respondNotFound('Product does not exist.');
        }

        $product->delete();

        return $this->respondDeleted($product, 'Product successfully deleted.');
    }
}
