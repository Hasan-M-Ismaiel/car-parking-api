<?php

namespace App\Http\Controllers\Api\V1\Auth\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestChangePassword;
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

    public function changePassword(UserRequestChangePassword $request, User $user)
    {
        $userPassword['password'] = $request->validated()['newPassword'];
        $user->update($userPassword);

        $device = substr($request->userAgent() ?? '', 0, 255);
 
        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ], 201);
    }
    
}
