<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthStudentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\KraeplinController;
use App\Http\Controllers\KraeplinSchedulerController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/', [AuthController::class, 'loginUsers'])->name('auth.login');
        });

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::prefix('students')->group(function () {
                Route::post('/', [StudentController::class, 'registerStudent'])->middleware('restrictRole:admin')->name('student.register');
            });

            Route::prefix('group')->group(function () {
                Route::get('/', [GroupController::class, 'collectionGroup'])->middleware('restrictRole:admin')->name('group.group-collection');
                Route::get('/{id}', [GroupController::class, 'documentGroup'])->middleware('restrictRole:admin')->name('group.group-document');
                Route::post('/', [GroupController::class, 'createGroup'])->middleware('restrictRole:admin')->name('group.group-create');
                Route::put('/{id}', [GroupController::class, 'updateGroup'])->middleware('restrictRole:admin')->name('group.group-update');
                Route::delete('/{id}', [GroupController::class, 'deleteGroup'])->middleware('restrictRole:admin')->name('group.group-delete');
            });

            Route::prefix('kraeplin')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplin'])->middleware('restrictRole:admin')->name('kraeplin.kraeplin-collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplin'])->middleware('restrictRole:admin')->name('kraeplin.kraeplin-document');
                Route::post('/', [KraeplinController::class, 'createKraeplin'])->middleware('restrictRole:admin')->name('kraeplin.kraeplin-create');
                Route::put('/{id}', [KraeplinController::class, 'updateKraeplin'])->middleware('restrictRole:admin')->name('kraeplin.kraeplin-update');
                Route::delete('/{id}', [KraeplinController::class, 'deleteKraeplin'])->middleware('restrictRole:admin')->name('kraeplin.kraeplin-delete');
            });

            Route::prefix('kraeplin-scheduler')->group(function () {
                Route::get('/', [KraeplinSchedulerController::class, 'collectionKraeplinScheduler'])->middleware('restrictRole:admin')->name('kraeplin-scheduler.kraeplin-scheduler-collection');
                Route::get('/{id}', [KraeplinSchedulerController::class, 'documentKraeplinScheduler'])->middleware('restrictRole:admin')->name('kraeplin-scheduler.kraeplin-scheduler-document');
                Route::post('/', [KraeplinSchedulerController::class, 'createKraeplinScheduler'])->middleware('restrictRole:admin')->name('kraeplin-scheduler.kraeplin-scheduler-create');
                Route::put('/{id}', [KraeplinSchedulerController::class, 'updateKraeplinScheduler'])->middleware('restrictRole:admin')->name('kraeplin-scheduler.kraeplin-scheduler-update');
                Route::delete('/{id}', [KraeplinSchedulerController::class, 'deleteKraeplinScheduler'])->middleware('restrictRole:admin')->name('kraeplin-scheduler.kraeplin-scheduler-delete');
            });

            Route::prefix('kraeplin-scheduler-group')->group(function () {
                Route::get('/', [KraeplinController::class, 'collectionKraeplinSchedulerGroup'])->middleware('restrictRole:admin')->name('kraeplin-scheduler-group.kraeplin-scheduler-collection');
                Route::get('/{id}', [KraeplinController::class, 'documentKraeplinSchedulerGroup'])->middleware('restrictRole:admin')->name('kraeplin-scheduler-group.kraeplin-scheduler-document');
//                Route::post('/', [KraeplinSchedulerGroupController::class, 'createKraeplinSchedulerGroup'])->middleware('restrictRole:admin')->name('kraeplin-scheduler-group.kraeplin-scheduler-create');
//                Route::put('/{id}', [KraeplinSchedulerGroupController::class, 'updateKraeplinSchedulerGroup'])->middleware('restrictRole:admin')->name('kraeplin-scheduler-group.kraeplin-scheduler-update');
//                Route::delete('/{id}', [KraeplinSchedulerGroupController::class, 'deleteKraeplinSchedulerGroup'])->middleware('restrictRole:admin')->name('kraeplin-scheduler-group.kraeplin-scheduler-delete');
            });

            Route::post('/', [AuthController::class, 'register'])->middleware('restrictRole:admin')->name('admin.register');
        });
    });

    Route::prefix('student')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('login', [AuthStudentController::class, 'login'])->name('auth.login');
        });

        Route::prefix('kreplin')->group(function () {
            Route::post('create-student-kreplin-test', [KraeplinController::class, 'createSiswaKreplinTest'])->name('student.create-student-kreplin-test');
        });
    });
});
