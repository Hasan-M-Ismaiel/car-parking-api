<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleResource;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'user' => ['integer'],
        ]);
        $user = User::find($request->user);
        $vehicles = $user->vehicles;
        return VehicleResource::collection($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => ['required', 'string', 'max:255'],
            'user' => ['integer'],
        ]);
        
        $user = User::find($request->user);
        $vehicle = Vehicle::create([
            'user_id' => $user->id,
            'plate_number' => $request->plate_number,
        ]);
        
        return response()->json([
            'your new vehicle has been created successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicleinfo = $request->validate([
            'plate_number' => ['required', 'string', 'max:255'],
        ]);

        $vehicle->update($vehicleinfo);
        return new VehicleResource($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($vehicle)
    {
        $vehicle = Vehicle::find($vehicle);
        if($vehicle == null){
            return response()->json(['your vehicle is not exist!']);    
        }
        $vehicle->delete();
        return response()->json(['your vehicle has been deleted successfuly!']);
    }
}
