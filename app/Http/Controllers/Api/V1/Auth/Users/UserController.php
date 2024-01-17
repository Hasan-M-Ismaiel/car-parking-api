<?php

namespace App\Http\Controllers\Api\V1\Auth\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::find($user);
        return new UserResource($user[0]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    
}
