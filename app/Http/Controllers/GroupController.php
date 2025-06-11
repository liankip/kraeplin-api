<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function collectionGroup()
    {
        $group = Group::all();

        return response()->api(true, 'Collection Group', [
            $group
        ], 200);
    }

    public function documentGroup($id)
    {
        $group = Group::find($id);

        return response()->api(true, 'Document Group', [
            $group
        ], 200);
    }

    public function createGroup(CreateGroupRequest $request)
    {
        $group = Group::create($request->all());

        return response()->api(true, 'Group created successfully', [
            $group
        ], 201);
    }

    public function updateGroup(UpdateGroupRequest $request, $id)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->api(false, 'Group not found', []);
        }

        $group->update($request->all());

        return response()->api(true, 'Group ' . $group->name . ' updated successfully', []);
    }

    public function deleteGroup($id)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->api(false, 'Group not found', []);
        }

        $group->delete();
        return response()->api(true, 'Group ' . $group->name . ' deleted successfully', []);
    }
}
