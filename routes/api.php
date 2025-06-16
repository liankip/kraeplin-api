<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KraeplinController;
use App\Http\Controllers\MultipleChoiceController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/', [AuthController::class, 'loginUsers'])->name('auth.login');

        Route::get('/me',  [AuthController::class, 'me'])->name('auth.me');

        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });

    Route::prefix('admin')->group(function () {
        Route::middleware(['auth:sanctum', 'role:admin|data-entry'])->group(function () {
            Route::prefix('student')->group(function () {
                Route::get('/', [StudentController::class, 'collectionStudent'])->middleware('permission:student.collection')->name('student.collection');
                Route::get('/{id}', [StudentController::class, 'documentStudent'])->middleware('permission:student.document')->name('student.document');
                Route::post('/', [StudentController::class, 'createStudent'])->middleware('permission:student.create')->name('student.create');
                Route::put('/{id}', [StudentController::class, 'updateStudent'])->middleware('permission:student.update')->name('student.update');
                Route::delete('/{id}', [StudentController::class, 'deleteStudent'])->middleware('permission:student.delete')->name('student.delete');
            });

            Route::prefix('group')->group(function () {
                Route::get('/', [GroupController::class, 'collectionGroup'])->middleware('permission:group.collection')->name('group.collection');
                Route::get('/{id}', [GroupController::class, 'documentGroup'])->middleware('permission:group.document')->name('group.document');
                Route::post('/', [GroupController::class, 'createGroup'])->middleware('permission:group.create')->name('group.create');
                Route::put('/{id}', [GroupController::class, 'updateGroup'])->middleware('permission:group.update')->name('group.update');
                Route::delete('/{id}', [GroupController::class, 'deleteGroup'])->middleware('permission:group.delete')->name('group.delete');
            });

            Route::prefix('kraeplin')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplin'])->middleware('permission:kraeplin.collection')->name('kraeplin.collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplin'])->middleware('permission:kraeplin.document')->name('kraeplin.document');
                Route::post('/', [KraeplinController::class, 'createKraeplin'])->middleware('permission:kraeplin.create')->name('kraeplin.create');
                Route::put('/{id}', [KraeplinController::class, 'updateKraeplin'])->middleware('permission:kraeplin.update')->name('kraeplin.update');
                Route::delete('/{id}', [KraeplinController::class, 'deleteKraeplin'])->middleware('permission:kraeplin.delete')->name('kraeplin.delete');
            });

            Route::prefix('kraeplin-scheduler')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplinScheduler'])->middleware('permission:kraeplin-scheduler.collection')->name('kraeplin-scheduler.collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplinScheduler'])->middleware('permission:kraeplin-scheduler.document')->name('kraeplin-scheduler.document');
                Route::post('/', [KraeplinController::class, 'createKraeplinScheduler'])->middleware('permission:kraeplin-scheduler.create')->name('kraeplin-scheduler.create');
                Route::put('/{id}', [KraeplinController::class, 'updateKraeplinScheduler'])->middleware('permission:kraeplin-scheduler.update')->name('kraeplin-scheduler.update');
                Route::delete('/{id}', [KraeplinController::class, 'deleteKraeplinScheduler'])->middleware('permission:kraeplin-scheduler.delete')->name('kraeplin-scheduler.delete');
            });

            Route::prefix('kraeplin-scheduler-group')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplinSchedulerGroup'])->middleware('permission:kraeplin-scheduler-group.collection')->name('kraeplin-scheduler-group.collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplinSchedulerGroup'])->middleware('permission:kraeplin-scheduler-group.document')->name('kraeplin-scheduler-group.document');
                Route::post('/', [KraeplinController::class, 'createKraeplinSchedulerGroup'])->middleware('permission:kraeplin-scheduler-group.create')->name('kraeplin-scheduler-group.create');
                Route::put('/{id}', [KraeplinController::class, 'updateKraeplinSchedulerGroup'])->middleware('permission:kraeplin-scheduler-group.update')->name('kraeplin-scheduler-group.update');
                Route::delete('/{id}', [KraeplinController::class, 'deleteKraeplinSchedulerGroup'])->middleware('permission:kraeplin-scheduler-group.delete')->name('kraeplin-scheduler-group.delete');
            });

            Route::prefix('multiple-choice')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoice'])->middleware('permission:multiple-choice.collection')->name('multiple-choice.collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoice'])->middleware('permission:multiple-choice.document')->name('multiple-choice.document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoice'])->middleware('permission:multiple-choice.create')->name('multiple-choice.create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoice'])->middleware('permission:multiple-choice.update')->name('multiple-choice.update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoice'])->middleware('permission:multiple-choice.delete')->name('multiple-choice.delete');
            });

            Route::prefix('multiple-choice-question')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoiceQuestion'])->middleware('permission:multiple-choice-question.collection')->name('multiple-choice-question.collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoiceQuestion'])->middleware('permission:multiple-choice-question.document')->name('multiple-choice-question.document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoiceQuestion'])->middleware('permission:multiple-choice-question.create')->name('multiple-choice-question.create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoiceQuestion'])->middleware('permission:multiple-choice-question.update')->name('multiple-choice-question.update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoiceQuestion'])->middleware('permission:multiple-choice-question.delete')->name('multiple-choice-question.delete');
            });

            Route::prefix('multiple-choice-scheduler')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoiceScheduler'])->middleware('permission:multiple-choice-scheduler.collection')->name('multiple-choice-scheduler.collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoiceScheduler'])->middleware('permission:multiple-choice-scheduler.document')->name('multiple-choice-scheduler.document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoiceScheduler'])->middleware('permission:multiple-choice-scheduler.create')->name('multiple-choice-scheduler.create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoiceScheduler'])->middleware('permission:multiple-choice-scheduler.update')->name('multiple-choice-scheduler.update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoiceScheduler'])->middleware('permission:multiple-choice-scheduler.delete')->name('multiple-choice-scheduler.delete');
            });

            Route::prefix('multiple-choice-scheduler-group')->group(function () {
                Route::get('/', [MultipleChoiceController::class, 'collectionMultipleChoiceSchedulerGroup'])->middleware('permission:multiple-choice-scheduler-group.collection')->name('multiple-choice-scheduler-group.collection');
                Route::get('/{id}', [MultipleChoiceController::class, 'documentMultipleChoiceSchedulerGroup'])->middleware('permission:multiple-choice-scheduler-group.document')->name('multiple-choice-scheduler-group.document');
                Route::post('/', [MultipleChoiceController::class, 'createMultipleChoiceSchedulerGroup'])->middleware('permission:multiple-choice-scheduler-group.create')->name('multiple-choice-scheduler-group.create');
                Route::put('/{id}', [MultipleChoiceController::class, 'updateMultipleChoiceSchedulerGroup'])->middleware('permission:multiple-choice-scheduler-group.update')->name('multiple-choice-scheduler-group.update');
                Route::delete('/{id}', [MultipleChoiceController::class, 'deleteMultipleChoiceSchedulerGroup'])->middleware('permission:multiple-choice-scheduler-group.delete')->name('multiple-choice-scheduler-group.delete');
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
