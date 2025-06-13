<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthStudentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KraeplinController;
use App\Http\Controllers\MultipleChoiceController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/', [AuthController::class, 'loginUsers'])->name('auth.login');
    });

    Route::prefix('admin')->group(function () {
        Route::middleware(['auth:sanctum', 'role:admin|data-entry'])->group(function () {
            Route::prefix('student')->group(function () {
                Route::get('/', [StudentController::class, 'collectionStudent'])->middleware('permission:view data')->name('student.collection');
                Route::get('/{id}', [StudentController::class, 'documentStudent'])->middleware('permission:view data')->name('student.collection');
                Route::post('/', [StudentController::class, 'createStudent'])->middleware('permission:create data')->name('student.group-create');
                Route::put('/{id}', [StudentController::class, 'updateStudent'])->middleware('permission:edit data')->name('student.group-update');
                Route::delete('/{id}', [StudentController::class, 'deleteStudent'])->middleware('permission:delete data')->name('student.group-delete');
            });

            Route::prefix('group')->group(function () {
                Route::get('/', [GroupController::class, 'collectionGroup'])->middleware('permission:view data')->name('group.group-collection');
                Route::get('/{id}', [GroupController::class, 'documentGroup'])->middleware('permission:view data')->name('group.group-document');
                Route::post('/', [GroupController::class, 'createGroup'])->middleware('permission:create data')->name('group.group-create');
                Route::put('/{id}', [GroupController::class, 'updateGroup'])->middleware('permission:edit data')->name('group.group-update');
                Route::delete('/{id}', [GroupController::class, 'deleteGroup'])->middleware('permission:delete data')->name('group.group-delete');
            });

            Route::prefix( 'kraeplin')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplin'])->middleware('permission:view data')->name('kraeplin.kraeplin-collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplin'])->middleware('permission:view data')->name('kraeplin.kraeplin-document');
                Route::post('/', [KraeplinController::class, 'createKraeplin'])->middleware('permission:create data')->name('kraeplin.kraeplin-create');
                Route::put('/{id}', [KraeplinController::class, 'updateKraeplin'])->middleware('permission:edit data')->name('kraeplin.kraeplin-update');
                Route::delete('/{id}', [KraeplinController::class, 'deleteKraeplin'])->middleware('permission:delete data')->name('kraeplin.kraeplin-delete');
            });

            Route::prefix('kraeplin-scheduler')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplinScheduler'])->middleware('permission:view data')->name('kraeplin-scheduler.kraeplin-scheduler-collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplinScheduler'])->middleware('permission:view data')->name('kraeplin-scheduler.kraeplin-scheduler-document');
                Route::post('/', [KraeplinController::class, 'createKraeplinScheduler'])->middleware('permission:create data')->name('kraeplin-scheduler.kraeplin-scheduler-create');
                Route::put('/{id}', [KraeplinController::class, 'updateKraeplinScheduler'])->middleware('permission:edit data')->name('kraeplin-scheduler.kraeplin-scheduler-update');
                Route::delete('/{id}', [KraeplinController::class, 'deleteKraeplinScheduler'])->middleware('permission:delete data')->name('kraeplin-scheduler.kraeplin-scheduler-delete');
            });

            Route::prefix('kraeplin-scheduler-group')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplinSchedulerGroup'])->middleware('permission:view data')->name('kraeplin-scheduler-group.kraeplin-scheduler-collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplinSchedulerGroup'])->middleware('permission:view data')->name('kraeplin-scheduler-group.kraeplin-scheduler-document');
                Route::post('/', [KraeplinController::class, 'createKraeplinSchedulerGroup'])->middleware('permission:create data')->name('kraeplin-scheduler-group.kraeplin-scheduler-create');
                Route::put('/{id}', [KraeplinController::class, 'updateKraeplinSchedulerGroup'])->middleware('permission:edit data')->name('kraeplin-scheduler-group.kraeplin-scheduler-update');
                Route::delete('/{id}', [KraeplinController::class, 'deleteKraeplinSchedulerGroup'])->middleware('permission:delete data')->name('kraeplin-scheduler-group.kraeplin-scheduler-delete');
            });

            Route::prefix('multiple-choice')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoice'])->middleware('permission:view data')->name('multiple-choice.multiple-choice-collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoice'])->middleware('permission:view data')->name('multiple-choice.multiple-choice-document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoice'])->middleware('permission:create data')->name('multiple-choice.multiple-choice-create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoice'])->middleware('permission:edit data')->name('multiple-choice.multiple-choice-update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoice'])->middleware('permission:delete data')->name('multiple-choice.multiple-choice-delete');
            });

            Route::prefix('multiple-choice-question')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoiceQuestion'])->middleware('permission:view data')->name('multiple-choice-question.multiple-choice-question-collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoiceQuestion'])->middleware('permission:view data')->name('multiple-choice-question.multiple-choice-question-document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoiceQuestion'])->middleware('permission:create data')->name('multiple-choice-question.multiple-choice-question-create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoiceQuestion'])->middleware('permission:edit data')->name('multiple-choice-question.multiple-choice-question-update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoiceQuestion'])->middleware('permission:delete data')->name('multiple-choice-question.multiple-choice-question-delete');
            });

            Route::prefix('multiple-choice-scheduler')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoiceScheduler'])->middleware('permission:view data')->name('multiple-choice-scheduler.multiple-choice-scheduler-collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoiceScheduler'])->middleware('permission:view data')->name('multiple-choice-scheduler.multiple-choice-scheduler-document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoiceScheduler'])->middleware('permission:create data')->name('multiple-choice-scheduler.multiple-choice-scheduler-create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoiceScheduler'])->middleware('permission:edit data')->name('multiple-choice-scheduler.multiple-choice-scheduler-update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoiceScheduler'])->middleware('permission:delete data')->name('multiple-choice-scheduler.multiple-choice-scheduler-delete');
            });

            Route::prefix('multiple-choice-scheduler-group')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoiceSchedulerGroup'])->middleware('permission:view data')->name('multiple-choice-scheduler-group.multiple-choice-scheduler-collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoiceSchedulerGroup'])->middleware('permission:view data')->name('multiple-choice-scheduler-group.multiple-choice-scheduler-document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoiceSchedulerGroup'])->middleware('permission:create data')->name('multiple-choice-scheduler-group.multiple-choice-scheduler-create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoiceSchedulerGroup'])->middleware('permission:edit data')->name('multiple-choice-scheduler-group.multiple-choice-scheduler-update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoiceSchedulerGroup'])->middleware('permission:delete data')->name('multiple-choice-scheduler-group.multiple-choice-scheduler-delete');
            });

            Route::post('/', [AuthController::class, 'createUser'])->middleware('restrictRole:admin')->name('admin.register');
        });
    });

    Route::prefix('student')->group(function () {
        Route::prefix('kraeplin-scheduler')->group(function () {
            Route::get('/', [KraeplinController::class, 'collectionKraeplinSchedulerGroupStudent']);
        });

        Route::prefix('kraeplin-test')->group(function () {
            Route::post('/', [KraeplinController::class, 'createStudentKreplinTest']);
        });
    });
});
