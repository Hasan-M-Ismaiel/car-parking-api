<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParkingResource;
use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingContoller extends Controller
{
    public function show (Parking $parking)
    {
        return new ParkingResource($parking);
    }

    public function store (Request $request)
    {

        $validationArray = [
            'user_id'=> ['integer'],
            'vehicle_id'=> ['integer'],
            'zone_id'=> ['integer'],
        ];
        $request->validate($validationArray);

        
        $parking = Parking::create([
            'user_id' => $request->user_id,
            'vehicle_id' => $request->vehicle_id,
            'zone_id' => $request->zone_id,
            'start_time' => now(),
        ]);
        
        return new ParkingResource($parking);
    }

    public function update (Parking $parking)
    {
        $validationArray = [
            'stop_time'=> now(),
            'total_price'=> $this->getPrice($parking->start_time,now(),$parking),
        ];
        
        $parking->update($validationArray);

        return new ParkingResource($parking);
    }

    protected function getPrice ($startdate,$enddate, Parking $parking)
    {
        $t1 = strtotime($enddate);
        $t2 = strtotime($startdate);
        $diff = $t1 - $t2;
        $hours = $diff / ( 60 * 60 );
        $price = $parking->zone->price_per_hour * $hours;
        // dd($price);
        return $price; 
    }
    
}
