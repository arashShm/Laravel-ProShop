<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttributeValues extends Pivot
{
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class , 'attribute_id' , 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class , 'value_id' , 'id');
    }
}
