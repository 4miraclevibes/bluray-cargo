<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    protected $fillable = [
        'shipment_order_id',
        'name',
        'phone',
        'address',
    ];

    public function shipmentOrder()
    {
        return $this->belongsTo(ShipmentOrder::class);
    }
}
