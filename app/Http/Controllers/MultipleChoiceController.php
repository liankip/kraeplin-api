<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMultipleChoiceQuestionRequest;
use App\Http\Requests\CreateMultipleChoiceRequest;
use App\Http\Requests\UpdateMultipleChoiceQuestionRequest;
use App\Http\Requests\UpdateMultipleChoiceRequest;
use App\Models\MultipleChoice;
use App\Models\MultipleChoiceQuestion;
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
}
