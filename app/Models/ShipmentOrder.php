<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentOrder extends Model
{
    protected $fillable = [
        'user_id',
        'tracking',
        'courier_name',
        'service_name',
        'courier_insurance',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->hasOne(Sender::class);
    }

    public function recipient()
    {
        return $this->hasOne(Recipient::class);
    }

    public function shipmentItems()
    {
        return $this->hasMany(ShipmentItem::class);
    }
}
