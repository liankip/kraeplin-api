<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKraeplinRequest;
use App\Http\Requests\CreateStudentKraeplinTestRequest;
use App\Http\Requests\UpdateKraeplinRequest;
use App\Models\Kraeplin;
use App\Models\KraeplinScheduleGroup;
use App\Models\StudentKraeplinTest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\JsonResource;

class KraeplinController extends Controller
{
    public function collectionKraeplin()
    {
        $kraeplins = Kraeplin::latest()->paginate(5);

        return new JsonResource($kraeplins);
    }

    public function documentKraeplin($id)
    {
        $kraeplin = Kraeplin::find($id);

        return new JsonResource($kraeplin);
    }

    public function createKraeplin(CreateKraeplinRequest $request)
    {
        $kraeplin = Kraeplin::create($request->validated());

        return new JsonResource($kraeplin);
    }

    public function updateKraeplin(UpdateKraeplinRequest $request, $id)
    {
        $kraeplin = Kraeplin::find($id);

        if (!$kraeplin) {
            return response()->api(false, 'Kraeplin not found', []);
        }

        $kraeplin->update($request->all());

        return new JsonResource($kraeplin);
    }

    public function deleteKraeplin($id)
    {
        $kraeplin = Kraeplin::find($id);

        if (!$kraeplin) {
            return response()->api(false, 'Kraeplin not found', [], 200);
        }

        $kraeplin->delete();

        return new JsonResource($kraeplin);
    }

    public function collectionKraeplinSchedulerGroup()
    {
        $kraeplinSchedulGroup = KraeplinScheduleGroup::with([
            'group' => function ($query) {
                $query->select('id', 'name');
            },
            'kraeplinSchedule' => function ($query) {
                $query->select('id', 'date');
            }
        ])->latest()->paginate(5);

//        return response()->api(true, 'Collections kraeplin schedule group', [
        return $kraeplinSchedulGroup;
//        ], 200);
    }

    public function documentKraeplinSchedulerGroup($id)
    {
        return response()->api(true, 'Document kraeplin schedule group', [], 200);
    }

    public function createSiswaKreplinTest(CreateStudentKraeplinTestRequest $request)
    {
        try {
            $data = $request->validated();

            $result = StudentKraeplinTest::create($data);

            return new JsonResource($result);
        } catch (QueryException $e) {
            return response()->api(false, 'Kraeplin test has already submitted', [], 200);
        }
    }
}
