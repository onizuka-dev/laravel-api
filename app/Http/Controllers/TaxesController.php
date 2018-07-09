<?php

namespace App\Http\Controllers;

use App\Api\Transformers\TaxTransformer;
use Illuminate\Http\Request;
use App\Tax;

class TaxesController extends ApiController
{
    protected $taxTransformer;

    function __construct(TaxTransformer $taxTransformer)
    {
        $this->taxTransformer = $taxTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = Tax::all();
        return $this->respond([
            'data' => $this->taxTransformer->transformCollection($taxes->all())
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
        // TODO implement validation
        if ( ! $request->description || ! $request->percentage) {
            return $this->respondNotValid([
                'Parameters failed validation for a tax.'
            ]);
        }

        // TODO handle `already exist response`

        $tax = Tax::create($request->all());

        return $this->respondCreated($tax, 'Tax successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tax = Tax::find($id);

        if ( ! $tax) {
            return $this->respondNotFound('Tax does not exist');
        }

        return $this->respond([
            'data' => $this->taxTransformer->transform($tax)
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
