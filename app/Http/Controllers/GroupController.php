<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $groups = Group::paginate(10);
        return GroupResource::collection($groups);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return GroupResource
     */
    public function store(Request $request)
    {
        $group = $request->isMethod('put') ? Group::findOrFail($request->group_id) : new Group;
        $group->id = $request->input('group_id');
        $group->title = $request->input('title');

        if($group->save()) {
            return new GroupResource($group);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return GroupResource
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        return new GroupResource($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return GroupResource
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);

        if($group->delete()) {
            return new GroupResource($group);
        }
    }
}
