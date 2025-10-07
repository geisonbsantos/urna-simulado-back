<?php

use App\Http\Controllers\Api\AbilityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReportErrorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CandidateTypeController;
use App\Http\Controllers\Api\ElectionController;
use App\Http\Controllers\Api\ElectionTypeController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\VoteController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('forget-password', [ForgotPasswordController::class, 'sendEmail']);
Route::post('valid-token', [ForgotPasswordController::class, 'validToken']);
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword']);
Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');

Route::group(['middleware' => ['auth:sanctum', 'refreshTokenSanctum']], function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/report', [ReportErrorController::class, 'sendEmailReport']);
    
    /*
    |--------------------------------------------------------------------------
    | Profiles Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(ProfileController::class)->prefix('profiles')->name('profiles.')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_perfil'])->name('index');
        Route::get('/{profile}', 'show')->middleware(['abilities:list_perfil'])->name('show');
        Route::get('/{profile}/abilities', 'getAbilities')->middleware(['abilities:list_perfil'])->name('abilities');
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_perfil'])->name('store');
        Route::post('/{profile}/abilities', 'storeAbilities')->middleware(['abilities:cad_perfil'])->name('abilities.store');
        Route::put('/{profile}', 'beforeUpdate')->middleware(['abilities:cad_perfil'])->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
    /*
    |--------------------------------------------------------------------------
    | Abilities Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(AbilityController::class)->prefix('abilities')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_habilidade']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_habilidade']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_habilidade']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_habilidade']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_habilidade']);
    });
    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_users', 'listUsers')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::post('/{user}/profiles', 'storeProfiles')->middleware(['abilities:cad_perfil']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Address Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(AddressController::class)->prefix('addresses')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_addresses', 'listAddresses')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Election Type Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(ElectionTypeController::class)->prefix('election_types')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_election_types', 'listElectionTypes')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Election Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(ElectionController::class)->prefix('elections')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_elections', 'listElections')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Candidate Type Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(CandidateTypeController::class)->prefix('candidate_types')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_candidate_types', 'listCandidateTypes')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Candidate Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(CandidateController::class)->prefix('candidates')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_candidates', 'listCandidates')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Registration Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(RegistrationController::class)->prefix('registrations')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_registrations', 'listRegistrations')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Vote Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(VoteController::class)->prefix('votes')->group(function () {
        Route::get('/', 'index')->middleware(['abilities:list_usuario']);
        Route::get('/list_votes', 'listVotes')->middleware(['abilities:list_usuario']);
        Route::get('/{id}', 'show')->middleware(['abilities:list_usuario']);
        Route::post('/', 'beforeStore')->middleware(['abilities:cad_usuario']);
        Route::put('/{id}', 'beforeUpdate')->middleware(['abilities:cad_usuario']);
        Route::delete('/{id}', 'destroy')->middleware(['abilities:del_usuario']);
        Route::put('/restore/{id}', 'restore')->middleware(['abilities:del_usuario']);
    });
    /*
    |--------------------------------------------------------------------------
    | Faq Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(FaqController::class)->prefix('faqs')->group(function () {
        Route::get('/{id}', [FaqController::class, 'show'])->middleware(['abilities:list_faqs']);
        Route::post('/', [FaqController::class, 'beforeStore'])->middleware(['abilities:cad_faqs']);
        Route::put('/{id}', [FaqController::class, 'beforeUpdate'])->middleware(['abilities:cad_faqs']);
        Route::delete('/{id}', [FaqController::class, 'destroy'])->middleware(['abilities:del_faqs']);
    });
});