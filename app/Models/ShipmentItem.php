<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentItem extends Model
{
    protected $fillable = [
        'shipment_order_id',
        'name',
        'description',
        'price',
        'weight'
    ];

    public function shipmentOrder()
    {
        return $this->belongsTo(ShipmentOrder::class);
    }
}
