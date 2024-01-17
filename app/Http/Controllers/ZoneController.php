<?php

namespace App\Http\Controllers;

use App\Http\Resources\ZoneResource;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $zones = Zone::all();
        return ZoneResource::collection($zones);
    }
}
