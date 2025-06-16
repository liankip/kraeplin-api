<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMultipleChoiceQuestionRequest;
use App\Http\Requests\CreateMultipleChoiceRequest;
use App\Http\Requests\CreateMultipleChoiceSchedulerRequest;
use App\Http\Requests\UpdateMultipleChoiceQuestionRequest;
use App\Http\Requests\UpdateMultipleChoiceRequest;
use App\Http\Requests\UpdateMultipleChoiceSchedulerRequest;
use App\Models\MultipleChoice;
use App\Models\MultipleChoiceQuestion;
use App\Models\MultipleChoiceScheduleGroup;
use App\Models\MultipleChoiceScheduler;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MultipleChoiceController extends Controller
{
    public function collectionMultipleChoice(Request $request): JsonResource
    {
        $multipleChoice = MultipleChoice::filter($request, ['name'])
            ->paginateRequest($request);

        return new JsonResource($multipleChoice);
    }

    public function documentMultipleChoice($id): JsonResource
    {
        $multipleChoice = MultipleChoice::find($id);

        return new JsonResource($multipleChoice);
    }

    public function createMultipleChoice(CreateMultipleChoiceRequest $request): JsonResource
    {
        $multipleChoice = MultipleChoice::create($request->validated());

        return new JsonResource($multipleChoice);
    }

    public function updateMultipleChoice(UpdateMultipleChoiceRequest $request, $id): JsonResource
    {
        $multipleChoice = MultipleChoice::find($id);

        if (!$multipleChoice) {
            return new JsonResource([
                'success' => false,
                'message' => 'Multiple choice not found'
            ]);
        }

        $multipleChoice->update($request->all());

        return new JsonResource($multipleChoice);
    }

    public function deleteMultipleChoice($id): JsonResource
    {
        $multipleChoice = MultipleChoice::find($id);

        if (!$multipleChoice) {
            return new JsonResource([
                'success' => false,
                'message' => 'Multiple choices not found'
            ]);
        }

        $multipleChoice->delete();

        return new JsonResource($multipleChoice);
    }

    public function collectionMultipleChoiceQuestion(Request $request): JsonResource
    {
        $multipleChoiceQuestion = MultipleChoiceQuestion::filter($request, ['name'])
            ->paginateRequest($request);

        return new JsonResource($multipleChoiceQuestion);
    }

    public function documentMultipleChoiceQuestion($id): JsonResource
    {
        $multipleChoiceQuestion = MultipleChoiceQuestion::find($id);

        return new JsonResource($multipleChoiceQuestion);
    }

    public function createMultipleChoiceQuestion(CreateMultipleChoiceQuestionRequest $request): JsonResource
    {
        $multipleChoiceQuestion = MultipleChoiceQuestion::create($request->validated());

        return new JsonResource($multipleChoiceQuestion);
    }

    public function updateMultipleChoiceQuestion(UpdateMultipleChoiceQuestionRequest $request, $id): JsonResource
    {
        $multipleChoiceQuestion = MultipleChoiceQuestion::find($id);

        if (!$multipleChoiceQuestion) {
            return new JsonResource([
                'success' => false,
                'message' => 'Multiple choice question not found'
            ]);
        }

        $multipleChoiceQuestion->update($request->all());

        return new JsonResource($multipleChoiceQuestion);
    }

    public function deleteMultipleChoiceQuestion($id): JsonResource
    {
        $multipleChoiceQuestion = MultipleChoiceQuestion::find($id);

        if (!$multipleChoiceQuestion) {
            return new JsonResource([
                'success' => false,
                'message' => 'Multiple choices not found'
            ]);
        }

        $multipleChoiceQuestion->delete();

        return new JsonResource($multipleChoiceQuestion);
    }

    public function collectionMultipleChoiceScheduler(Request $request): JsonResource
    {
        $multipleChoiceScheduler = MultipleChoiceScheduler::filter($request, ['date'])
            ->paginateRequest($request);

        return new JsonResource($multipleChoiceScheduler);
    }

    public function documentMultipleChoiceScheduler($id): JsonResource
    {
        $multipleChoiceScheduler = MultipleChoiceScheduler::find($id);

        return new JsonResource($multipleChoiceScheduler);
    }

    public function createMultipleChoiceScheduler(CreateMultipleChoiceSchedulerRequest $request): JsonResource
    {
        $multipleChoiceScheduler = MultipleChoiceScheduler::create($request->validated());

        return new JsonResource($multipleChoiceScheduler);
    }

    public function updateMultipleChoiceScheduler(UpdateMultipleChoiceSchedulerRequest $request, $id): JsonResource
    {
        $multipleChoiceScheduler = MultipleChoiceScheduler::find($id);

        if (!$multipleChoiceScheduler) {
            return new JsonResource([
                'success' => false,
                'message' => 'Multiple choice scheduler not found'
            ]);
        }

        $multipleChoiceScheduler->update($request->all());

        return new JsonResource($multipleChoiceScheduler);
    }

    public function deleteMultipleChoiceScheduler($id): JsonResource
    {
        $multipleChoiceScheduler = MultipleChoiceScheduler::find($id);

        if (!$multipleChoiceScheduler) {
            return new JsonResource([
                'success' => false,
                'message' => 'Multiple choices scheduler not found'
            ]);
        }

        $multipleChoiceScheduler->delete();

        return new JsonResource($multipleChoiceScheduler);
    }

    public function collectionMultipleChoiceSchedulerGroup(Request $request): JsonResource
    {
        $multipleChoiceScheduleGroup = MultipleChoiceScheduleGroup::filter($request, ['id_group', 'id_multiple_choice_scheduler'])
            ->paginateRequest($request);

        return new JsonResource($multipleChoiceScheduleGroup);
    }

    public function documentMultipleChoiceSchedulerGroup($id): JsonResource
    {
        $multipleChoiceScheduleGroup = MultipleChoiceScheduleGroup::find($id);

        return new JsonResource($multipleChoiceScheduleGroup);
    }

    public function createMultipleChoiceSchedulerGroup(CreateMultipleChoiceScheduleGroupRequest $request): JsonResource
    {

    }
}
