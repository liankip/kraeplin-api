<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKraeplinRequest;
use App\Http\Requests\CreateKraeplinScheduleGroupRequest;
use App\Http\Requests\CreateKraeplinScheduleRequest;
use App\Http\Requests\CreateStudentKraeplinTestRequest;
use App\Http\Requests\UpdateKraeplinRequest;
use App\Http\Requests\UpdateKraeplinScheduleGroupRequest;
use App\Http\Requests\UpdateKraeplinScheduleRequest;
use App\Models\Kraeplin;
use App\Models\KraeplinSchedule;
use App\Models\KraeplinScheduleGroup;
use App\Models\Student;
use App\Models\StudentKraeplinTest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class KraeplinController extends Controller
{
    public function collectionKraeplin(Request $request)
    {
        $kraeplins = Kraeplin::filter($request, ['name', 'duration', 'status', 'description'])
            ->paginateRequest($request);

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
            return new JsonResource([
                'success' => false,
                'message' => 'Kraeplin not found'
            ]);
        }

        $kraeplin->update($request->all());

        return new JsonResource($kraeplin);
    }

    public function deleteKraeplin($id)
    {
        $kraeplin = Kraeplin::find($id);

        if (!$kraeplin) {
            return new JsonResource([
                'success' => false,
                'message' => 'Kraeplin not found'
            ]);
        }

        $kraeplin->delete();

        return new JsonResource($kraeplin);
    }

    public function collectionKraeplinScheduler()
    {
        $kraeplinSchedule = KraeplinSchedule::all();

        return new JsonResource($kraeplinSchedule);
    }

    public function documentKraeplinScheduler($id)
    {
        $kraeplinSchedule = KraeplinSchedule::find($id);

        return new JsonResource($kraeplinSchedule);
    }

    public function createKraeplinScheduler(CreateKraeplinScheduleRequest $request)
    {
        $kraeplinSchedule = KraeplinSchedule::create($request->validated());

        return new JsonResource($kraeplinSchedule);
    }

    public function updateKraeplinScheduler(UpdateKraeplinScheduleRequest $request, $id)
    {
        $kraeplinSchedule = KraeplinSchedule::find($id);

        if (!$kraeplinSchedule) {
            return new JsonResource([
                'success' => false,
                'message' => 'Kraeplin Schedule not found'
            ]);
        }

        $kraeplinSchedule->update($request->validated());

        return new JsonResource($kraeplinSchedule);
    }

    public function deleteKraeplinScheduler($id)
    {
        $kraeplinSchedule = KraeplinSchedule::find($id);

        if (!$kraeplinSchedule) {
            return new JsonResource([
                'success' => false,
                'message' => 'Kraeplin Schedule not found'
            ]);
        }

        $kraeplinSchedule->delete();

        return new JsonResource($kraeplinSchedule);
    }

    public function collectionKraeplinSchedulerGroup()
    {
        $kraeplinSchedulerGroup = KraeplinScheduleGroup::with([
            'group' => function ($query) {
                $query->select('id', 'name');
            },
            'kraeplinSchedule' => function ($query) {
                $query->select('id', 'date');
            }
        ])->latest()->paginate(5);

        return new JsonResource($kraeplinSchedulerGroup);
    }

    public function documentKraeplinSchedulerGroup($id)
    {
        $kraeplinSchedulerGroup = KraeplinScheduleGroup::with([
            'group' => function ($query) {
                $query->select('id', 'name');
            },
            'kraeplinSchedule' => function ($query) {
                $query->select('id', 'date');
            }
        ])->find($id);

        return new JsonResource($kraeplinSchedulerGroup);
    }

    public function createKraeplinSchedulerGroup(CreateKraeplinScheduleGroupRequest $request)
    {
        $kraeplinScheduleGroup = KraeplinScheduleGroup::create($request->validated());

        return new JsonResource($kraeplinScheduleGroup);
    }

    public function updateKraeplinSchedulerGroup(UpdateKraeplinScheduleGroupRequest $request, $id)
    {
        $kraeplinScheduler = KraeplinScheduleGroup::find($id);

        if (!$kraeplinScheduler) {
            return new JsonResource([
                'succes' => false,
                'message' => 'Kraeplin schedule not found'
            ]);
        }

        $kraeplinScheduler->update($request->validated());

        return new JsonResource($kraeplinScheduler);
    }

    public function deleteKraeplinSchedulerGroup($id)
    {
        $kraeplinSchedule = KraeplinScheduleGroup::find($id);

        if (!$kraeplinSchedule) {
            return new JsonResource([
                'succes' => false,
                'message' => 'Kraeplin schedule not found'
            ]);
        }

        $kraeplinSchedule->delete();

        return new JsonResource($kraeplinSchedule);
    }

    public function collectionKraeplinSchedulerGroupStudent(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());

        if (!$token) {
            return new JsonResource([
                'success' => false,
                'message' => 'Student not found'
            ]);
        }

        $student = $token->tokenable;

        $schedules = $student->kraeplinSchedules()
            ->select('kraeplin_schedules.id', 'id_kraeplin', 'date')
            ->with(['kraeplin:id,name,duration,status,description'])
            ->paginateRequest($request);

        return new JsonResource($schedules);
    }

    public function createStudentKreplinTest(CreateStudentKraeplinTestRequest $request)
    {
        try {
            $studentKraeplinTest = StudentKraeplinTest::create($request->validated());

            return new JsonResource($studentKraeplinTest);
        } catch (QueryException $e) {
            return new JsonResource($e->getMessage());
        }
    }
}
