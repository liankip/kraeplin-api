<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupController extends Controller
{
    public function collectionGroup(Request $request)
    {
        $group = Group::filter($request, ['name'])
            ->paginateRequest($request);

        return new JsonResource($group);
    }

    public function documentGroup($id)
    {
        $group = Group::find($id);

        return new JsonResource($group);
    }

    public function createGroup(CreateGroupRequest $request)
    {
        $group = Group::create($request->all());

        return new JsonResource($group);
    }

    public function updateGroup(UpdateGroupRequest $request, $id)
    {
        $group = Group::find($id);

        if (!$group) {
            return new JsonResource('Group not found');
        }

        $group->update($request->all());

        return new JsonResource($group);
    }

    public function deleteGroup($id)
    {
        $group = Group::find($id);

        if (!$group) {
            return new JsonResource('Group not found');
        }

        $group->delete();
        return new JsonResource($group);
    }
}
