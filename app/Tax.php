<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'description',
        'percentage'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
