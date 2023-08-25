<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\FormBuilderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FormBuilderController::class, 'index']);

Route::get('/test', function () {
    return 'Test Route Works!';
});

//Auth Routes
Route::get('/login', [AuthController::class, "loginView"])->name('login')->middleware('guest');
Route::post('/login-fill', [AuthController::class, "loginAuth"])->middleware('guest');
Route::get('/logout', [AuthController::class, "logout"])->middleware('auth');

//FormBuilder Routes
Route::get('/form-builder', [FormBuilderController::class, 'formBuilder'])->middleware('auth');
Route::post('/form', [FormBuilderController::class, 'createForm'])->middleware('auth');
Route::get('/forms', [FormBuilderController::class, 'displayForm'])->middleware('auth');
Route::get('/myforms/{id}', [FormBuilderController::class, 'displayMyForm'])->middleware('auth');
Route::get('/form-view/{id}', [FormBuilderController::class, 'viewForm'])->middleware('auth');
Route::get('/form-clone/{id}', [FormBuilderController::class, 'cloneForm'])->middleware('auth');
Route::get('/form-publish/{type}/{id}', [FormBuilderController::class, 'publish'])
    ->where('type', '.*') // This allows the type parameter to contain any character, including slashes
    ->name('form.publish');

Route::get('/delete-form/{id}', [FormBuilderController::class, 'deleteForm'])->middleware('auth');
Route::get('/edit-view-form/{id}', [FormBuilderController::class, 'editViewForm'])->middleware('auth');
Route::post('/edit-save-form/{id}', [FormBuilderController::class, 'editSaveForm'])->middleware('auth');

//Submission Routes
Route::post('/submit', [FormBuilderController::class, 'submit']);
Route::get('/submitted', [FormBuilderController::class, 'submittedView'])->middleware('auth');
Route::get('/submitted-view/{id}', [FormBuilderController::class, 'submittedDetails'])->middleware('auth');
Route::get('/submitted-delete/{id}', [FormBuilderController::class, 'submittedDelete'])->middleware('auth');
Route::get('/submitted-based/{formType}', [FormBuilderController::class, 'submittedBased'])->middleware('auth')->where('formType', '[\w\s\-_\/]+');
Route::get('/approval-submission/{formType}', [FormBuilderController::class, 'submittedPending'])->middleware('auth');
Route::get('/thankyou', [FormBuilderController::class, 'thankyou']);
Route::get('/approve/{id}', [FormBuilderController::class, 'approved'])->middleware('auth');
Route::get('/reject/{id}', [FormBuilderController::class, 'rejected'])->middleware('auth');

//Ready Made and template Routes
Route::get('/ready-forms', [TemplateController::class, 'readyMade'])->middleware('auth');
Route::get('/template', [TemplateController::class, 'template'])->middleware('auth');
Route::get('/sponsorship', [TemplateController::class, 'sponsor'])->middleware('auth');
Route::get('/sponsor-publish/{name}', [TemplateController::class, 'sponsorPublish']);
Route::get('/19LsignupForm', [TemplateController::class, 'signupForm'])->middleware('auth');
Route::get('/19LsignupForm-publish/{id}', [TemplateController::class, 'signupFormPublish']);
Route::post('/submitTemp', [TemplateController::class, 'submitTemp']);
Route::post('/submitTempSign', [TemplateController::class, 'submitTempSign']);
Route::get('/sponsorship-submission', [TemplateController::class, 'sponsorshipSubmission'])->middleware('auth');
Route::get('/signup-submission', [TemplateController::class, 'signupSubmission'])->middleware('auth');

//users Routes
Route::get('/users', [UserController::class, 'users'])->middleware('auth');
Route::get('/add-user', [UserController::class, 'addUser'])->middleware('auth');
Route::get('/profile/{id}', [UserController::class, 'profile'])->middleware('auth');
Route::get('/profile/{id}', [UserController::class, 'profile'])->middleware('auth');
Route::post('/register-user', [UserController::class, 'createUser'])->middleware('auth');
Route::put('/edit-user/{id}', [UserController::class, 'editUser'])->middleware('auth');
Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->middleware('auth');
Route::put('/change-password-user/{id}', [UserController::class, 'changePasswordUser'])->middleware('auth');

//Recycle Bin Routes
Route::get('/trash-form', [RecycleController::class, 'trashForm'])->middleware('auth');
Route::get('/trash-restore/{id}', [RecycleController::class, 'trashFormRestore'])->middleware('auth');
Route::delete('/trash-form-delete/{id}', [RecycleController::class, 'trashFormDelete'])->middleware('auth');
Route::get('/trash-submitted', [RecycleController::class, 'trashSubmitted'])->middleware('auth');
Route::get('/trash-submitted-restore/{id}', [RecycleController::class, 'trashSubmittedRestore'])->middleware('auth');
Route::get('/trash-submitted-delete/{id}', [RecycleController::class, 'trashSubmittedDelete'])->middleware('auth');
