<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyRatePayment extends Model
{
    //
    public function property()
    {
        return $this->belongsTo(App\Property::class, 'property_id');
    }
}
