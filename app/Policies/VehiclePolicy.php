<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\Response;
use SebastianBergmann\Type\TrueType;

class VehiclePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vehicle $vehicle): Response
    {
        return $user->id === $vehicle->user_id
                ? Response::allow()
                : Response::deny('You do not own this vehicle.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,Vehicle $vehicle): bool
    {
        // return $user->role == 'writer';return $user->role == 'writer';
        // return $user->id === $vehicle->user_id
        //         ? Response::allow()
        //         : Response::deny('You do not own this vehicle.');
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vehicle $vehicle): Response
    {
        return $user->id === $vehicle->user_id
                ? Response::allow()
                : Response::deny('You do not own this vehicle.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vehicle $vehicle): Response
    {
        return $user->id === $vehicle->user_id
                ? Response::allow()
                : Response::deny('You do not own this vehicle.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vehicle $vehicle): Response
    {
        return $user->id === $vehicle->user_id
                ? Response::allow()
                : Response::deny('You do not own this vehicle.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vehicle $vehicle): bool
    {
        return false;

    }
}
