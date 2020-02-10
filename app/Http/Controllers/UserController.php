<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::paginate(10);
        return UserResource::collection($users);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $user = $request->isMethod('put') ? User::findOrFail($request->user_id) : new User;
        $user->id = $request->input('user_id');
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');

        if($user->save()) {
            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show($id): UserResource
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function destroy($id): UserResource
    {
        $user = User::findOrFail($id);

        if($user->delete()) {
            return new UserResource($user);
        }
    }

    /**
     * @param $user_id
     * @param $group_id
     */
    public function attachToGroup($user_id, $group_id): void
    {
        $user = User::find($user_id);
        $user->groups()->syncWithoutDetaching($group_id);
    }

    /**
     * @param $user_id
     * @param $group_id
     */
    public function detachFromGroup($user_id, $group_id): void
    {
        $user = User::find($user_id);
        $user->groups()->detach($group_id);
    }
}
