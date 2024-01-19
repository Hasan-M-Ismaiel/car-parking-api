<?php

namespace App\Policies;

use App\Models\User;
use App\Models\parking;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class ParkingPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, parking $parking): Response
    {
        return $user->id === $parking->user_id
            ? Response::allow()
            : Response::deny('You do not own this parking.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->id === request()->user_id
                ? Response::allow()
                : Response::deny('You do not own this vehicle.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, parking $parking): Response
    {
        return $user->id === $parking->user_id
        ? Response::allow()
        : Response::deny('You do not own this parking.');
    }

}
