<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\UsersController;

use App\Models\User;
use App\Models\File;

use Illuminate\Support\Facades\Route;

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

// Actual pages routes
/*Route::get('/', function () {
    $files = [];

    if(auth()->check()) {
        $user = auth()->user();

        if ($user instanceof User && !$user->isSuper()) {
            $files = $user->files()->latest()->paginate(5);
        } elseif ($user instanceof User && $user->isSuper()) {
            $files = File::with('user')->latest()->paginate(5);
        }

        // Alter the size data to be user friendly
        foreach($files as $file) {
            if ($file->size > 1024) {
                $file['friendly_size'] = round($file->size / 1024, 2) . ' MB';
            } else {
                $file['friendly_size'] = $file->size . ' KB';
            }
        }
    }

    return view('pages.home', ['files' => $files]);
});

Route::get('/register', function () {
    return view('pages.register');
});

Route::get('/new_file', function () {
    return view('pages.new_file');
});

Route::get('/users', function () {
    if(auth()->check()) {
        $user = auth()->user();

        if ($user instanceof User && $user->isSuper()) {
            $all_users = User::latest()->paginate(5);

            return view('pages.users', ['users' => $all_users]);
        }
    }

    return redirect('/');
});

// Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register_user', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// User routes
Route::get('/edit_user/{user}', [UsersController::class, 'showProfileScreen']);
Route::put('/update_user/{user}', [UsersController::class, 'updateUser']);

// Files routes
Route::post('/upload_file', [FilesController::class, 'uploadFile']);
Route::get('/download/{file}', [FilesController::class, 'downloadFile'])->name('file.download');
Route::delete('/delete_file/{file}', [FilesController::class, 'deleteFile']);*/

// Guest routes
Route::middleware('guest')->group(function () {
    Route::view('/register', 'pages.register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register_user', [AuthController::class, 'register']);
});

// Home works for guests and users, so no middleware
Route::get('/', [FilesController::class, 'index']);

// Logged-in routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::view('/new_file', 'pages.new_file');
    Route::post('/upload_file', [FilesController::class, 'uploadFile']);
    Route::get('/download/{file}', [FilesController::class, 'downloadFile'])->name('file.download');
    Route::delete('/delete_file/{file}', [FilesController::class, 'deleteFile']);

    Route::get('/edit_user/{user}', [UsersController::class, 'index']);
    Route::put('/update_user/{user}', [UsersController::class, 'updateUser']);

    // Super user only (see below)
    Route::get('/users', function () {
        if(auth()->check()) {
            $user = auth()->user();

            if ($user instanceof User && $user->isSuper()) {
                $all_users = User::latest()->paginate(5);

                return view('pages.users', ['users' => $all_users]);
            }
        }
    })->middleware('super');
});