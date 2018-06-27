<?php

namespace App\Pdv\Transformers;

class ProductTransformer extends Transformer
{
    /**
     * Transforms a product
     *
     * @param $product
     * @return array
     */
    public function transform($product)
    {
        return [
            'code' => $product['code'],
            'is_active' => (bool)$product['active'],
            'description' => $product['description'],
            'price' => $product['price']
        ];
    }
}
