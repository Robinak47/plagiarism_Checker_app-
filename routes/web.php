<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlaskApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// Route to upload files to Flask API
Route::post('/upload-file', [FlaskApiController::class, 'uploadFile']);

// Route to fetch file list from Flask API
Route::get('/files', [FlaskApiController::class, 'getFileList']);

// Route to delete selected files via Flask API
Route::delete('/delete-files', [FlaskApiController::class, 'deleteFiles']);
