<?php

namespace App;

use App\PropertyRatePayment;
use App\PropertyImage;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //

    protected static $paginateNumber = 12;
    protected $appends = ['images','owner'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getOwnerAttribute()
    {
        return $this->owner()->get()->first();
    }

    public function getImagesAttribute()
    {
        return $this->images()->get();
    }

    public function ratePayments()
    {
        return $this->hasMany(PropertyRatePayment::class, 'property_id');
    }

    public function available()
    {
        return
        $this->ratePayments()->latest()->get()->pluck('active_year')->contains(\Carbon\Carbon::now()->year)
        &&
        $this->available;
    }

    public static function scopeIsAvailable($query)
    {
        return $query->join('property_rate_payments',
                                'properties.id', '=',
                                'property_rate_payments.property_id')
            ->where('active_year','=', \Carbon\Carbon::now()->year)
            ->select('properties.*');
    }

    public static function scopeNotOwner($query)
    {
        return $query->where('owner_id','<>', auth()->id());
    }

    public static function scopeisOwner($query)
    {
        return $query->where('owner_id','=', auth()->id());
    }

    public static function scopeOfType($query, $type)
    {
        if($type==3)return $query;
        return $query->where('type', $type);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public static function allAvailableProperties($type=3)
    {
        return self::isAvailable()->ofType($type)->notOwner()->paginate(self::$paginateNumber);
    }

    public static function myProperties()
    {
       return self::isOwner()->paginate(self::$paginateNumber);
    }

    public function payPropertyRate(PropertyRatePayment $property)
    {
        $payment->property_id = $this->id;
        return $payment->save();
    }

    public function attachImage(PropertyImage $image)
    {
        $image->property_id = $this->id;
        return $image->save();
    }


    private function yearfm($months)
    {
    $str = '';

    if(($y = round(bcdiv($months, 12))))
    {
        $str .= "$y Year".($y-1 ? 's' : null);
    }
    if(($m = round($months % 12)))
    {
        $str .= ($y ? ' ' : null)."$m Month".($m-1 ? 's' : null);
    }
    return empty($str) ? false : $str;
    }

    public function convertMonths()
    {
//        $this->duration = $this->yearfm($this->duration);
            return $this->yearfm($this->duration);
    }

}
