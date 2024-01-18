<?php

namespace App\Http\Resources;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd(new VehicleResource($this->vehicle));
        return [
            'id' => $this->id, 
            'zone' => new ZoneResource($this->zone),
            'vehicle' => new VehicleResource($this->vehicle),
            'starting_date' => $this->start_time,
            'stop_date' => $this->stop_time,
            'total_price' => $this->v_total_price,
        ];
    }
}
