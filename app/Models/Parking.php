<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vehicle_id', 'zone_id', 'start_time', 'stop_time', 'total_price'];

    protected $casts = [
        'start_time' => 'datetime', //YYYY-mm-dd
        'stop_time' => 'datetime',  //YYYY-mm-dd
    ];

    public function vehicle ()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function zone ()
    {
        return $this->belongsTo(Zone::class);
    }


    public function VTotalPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>
                $this->getPrice($attributes['start_time'],now())
        );
    }
    
    protected function getPrice ($startdate,$enddate)
    {
        $t1 = strtotime($enddate);
        $t2 = strtotime($startdate);
        $diff = $t1 - $t2;
        $hours = $diff / ( 60 * 60 );
        $price = $this->zone->price_per_hour * $hours;
        return $price;
    }
}
