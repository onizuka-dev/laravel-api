<?php

namespace App\Pdv\Transformers;

class TaxTransformer extends Transformer
{
    /**
     * Transforms a tax
     *
     * @param $tax
     * @return array
     */
    public function transform($tax)
    {
        return [
            'description' => $tax['description'],
            'percentage' => (float)$tax['percentage']
        ];
    }
}
