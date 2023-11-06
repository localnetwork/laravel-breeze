<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\WalletController;
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

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('index');
    });
    Route::get('/about', function () {
        return view('pages.about');
    });

    Route::middleware(['auth'])->group(function () {

        Route::get('/wallet', [WalletController::class, 'index']);

        
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    });

    // Check if the user role is 1.
    Route::middleware('checkRole:1')->group(function () {
        Route::delete('/admin/trees/{tree}', [TreeController::class, 'destroy'])->name('admin.trees.destroy');
            
        Route::get('/admin/trees/create', [TreeController::class, 'create'])->name('admin.trees.create');
        Route::post('/admin/trees', [TreeController::class, 'store'])->name('admin.trees.store'); 

        Route::get('/admin/trees', 'App\Http\Controllers\TreeController@index')->name('admin.trees.index');
        
        Route::get('/admin/trees/{tree}', [TreeController::class, 'edit'])->name('admin.trees.edit'); 
        Route::put('/admin/trees/{tree}', [TreeController::class, 'update'])->name('admin.trees.update'); 



        Route::delete('/admin/barangays/{tree}', [BarangayController::class, 'destroy'])->name('admin.barangays.destroy');

        Route::get('/admin/barangays/create', [BarangayController::class, 'create'])->name('admin.barangays.create');
        Route::post('/admin/barangays', [BarangayController::class, 'store'])->name('admin.barangays.store'); 

        Route::get('/admin/barangays', 'App\Http\Controllers\BarangayController@index')->name('admin.barangays.index');
        
        Route::get('/admin/barangays/{barangay}', [BarangayController::class, 'edit'])->name('admin.barangays.edit'); 
        
        Route::put('/admin/barangays/{barangay}', [BarangayController::class, 'update'])->name('admin.barangays.update'); 
    });

    // Check if the user role is 1.
    // Route::middleware('checkRole:1')->group(function () {


        Route::get('/api/jobs', [JobController::class, 'jobsApi'])->name('jobs.api');

        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/create', [JobController::class, 'create']);

        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store'); 

         
        Route::get('/jobs/{job}', [JobController::class, 'show']);
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
        Route::put('/jobs/{job}', [JobController::class, 'update']);
        Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
    // });


    Route::get('/check-database', function () {
        try {
            DB::connection()->getPdo();
            return 'Database connection is successful.';
        } catch (\Exception $e) {
            return 'Database connection failed: ' . $e->getMessage();
        } 
    }); 

    require __DIR__.'/auth.php';
});
