<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKraeplinScheduleRequest;
use App\Http\Requests\UpdateKraeplinScheduleRequest;
use App\Models\KraeplinSchedule;
use Illuminate\Http\Request;

class KraeplinSchedulerController extends Controller
{
    public function collectionKraeplinScheduler()
    {
        $kraeplinSchedule = KraeplinSchedule::all();

        return response()->api(true, 'Kraeplin Schedule listed successfully',
            $kraeplinSchedule
        , 200);
    }

    public function documentKraeplinScheduler($id)
    {
        $kraeplinSchedule = KraeplinSchedule::find($id);

        return response()->api(true, 'Kraeplin Schedule document listed successfully', [
            $kraeplinSchedule
        ], 200);
    }

    public function createKraeplinScheduler(CreateKraeplinScheduleRequest $request)
    {
        $kraeplinSchedule = KraeplinSchedule::create($request->validated());

        return response()->api(true, 'Kraeplin Schedule created successfully', [
            $kraeplinSchedule
        ], 200);
    }

    public function updateKraeplinScheduler(UpdateKraeplinScheduleRequest $request, $id)
    {
        $kraeplinSchedule = KraeplinSchedule::find($id);

        if (!$kraeplinSchedule) {
            return response()->api(false, 'Kraeplin Schedule not found', [], 200);
        }

        $kraeplinSchedule->update($request->validated());

        return response()->api(true, 'Kraeplin Schedule updated successfully', [], 201);
    }

    public function deleteKraeplinScheduler($id)
    {
        $kraeplinSchedule = KraeplinSchedule::find($id);

        if (!$kraeplinSchedule) {
            return response()->api(false, 'Kraeplin Schedule not found', [], 200);
        }

        $kraeplinSchedule->delete();

        return response()->api(true, 'Kraeplin Schedule deleted successfully', [], 200);
    }
}
