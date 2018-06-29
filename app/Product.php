<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['description', 'code', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class);
    }
}
