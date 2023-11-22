<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrentUserInfoController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PointTransactionController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\VolunteerJobsTakenController;



// use App\Http\Middleware\DisableApiCache; 

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


    Route::get('/contact', function () {
        return view('pages.contact');
    });

    // Route to store form data
    Route::post('/contact', [ContactFormController::class, 'store'])->name('contact.store');

    // Route to display all contact form entries
    Route::get('/admin/contact', [ContactFormController::class, 'index']);

    Route::get('/apply', function () {
        return view('pages.apply');
    })->middleware('guest');

    Route::middleware(['auth'])->group(function () {
        Route::middleware('checkRole:2,3')->group(function () {
            Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
            Route::get('/wallet/transactions', [WalletController::class, 'walletTransactions'])->name('wallet.transactions');

            Route::post('/wallet/store', [PointTransactionController::class, 'store'])->name('wallet.store');
        });
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/api/user', [CurrentUserInfoController::class, 'index'])->name('user.index');
    });
    
    // Check if the user role is admin.
    Route::get('/api/trees', [TreeController::class, 'treesApi'])->name('trees.api');


    Route::middleware('checkRole:1')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');


        Route::put('/points/approval/{id}/topup', [PointTransactionController::class, 'approvedTopup']);

        Route::put('/points/approval/{id}/withdrawal', [PointTransactionController::class, 'approvedWithdrawal']);


        Route::get('/admin/trees', [TreeController::class, 'index'])->name('admin.trees.index');

        Route::delete('/admin/trees/{tree}', [TreeController::class, 'destroy'])->name('admin.trees.destroy');
            
        Route::get('/admin/trees/create', [TreeController::class, 'create'])->name('admin.trees.create');
        Route::post('/admin/trees', [TreeController::class, 'store'])->name('admin.trees.store'); 

        
        
        Route::get('/admin/trees/{tree}', [TreeController::class, 'edit'])->name('admin.trees.edit'); 
        Route::put('/admin/trees/{tree}', [TreeController::class, 'update'])->name('admin.trees.update'); 

        Route::delete('/admin/barangays/{barangay}', [BarangayController::class, 'destroy'])->name('admin.barangays.destroy');

        Route::get('/admin/barangays/create', [BarangayController::class, 'create'])->name('admin.barangays.create');
        Route::post('/admin/barangays', [BarangayController::class, 'store'])->name('admin.barangays.store'); 

        Route::get('/admin/barangays', 'App\Http\Controllers\BarangayController@index')->name('admin.barangays.index');
        
        Route::get('/admin/barangays/{barangay}', [BarangayController::class, 'edit'])->name('admin.barangays.edit'); 
        
        Route::put('/admin/barangays/{barangay}', [BarangayController::class, 'update'])->name('admin.barangays.update'); 

        Route::get('/admin/points-transactions', [PointTransactionController::class, 'adminPointsTransactions'])->name('admin.points-transactions.index'); 
        
    });

    

    // Check if the user role is sponsor
    Route::middleware('checkRole:2')->group(function () {


        Route::get('/api/jobs', [JobController::class, 'jobsApi'])->name('jobs.api');
        
        Route::match(['get', 'patch', 'put'], '/api/jobs/{job}', [JobController::class, 'update'])->name('api.jobs.show');

        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/create', [JobController::class, 'create']);

        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store'); 

         
        Route::get('/jobs/{job}', [JobController::class, 'show']);
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
        Route::put('/jobs/{job}', [JobController::class, 'update']);
        Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
    });


    // Check if the user role is volunteer
    Route::middleware('checkRole:3')->group(function () {
        Route::post('/job/{id}/accept', [VolunteerJobsTaken::class, 'store'])->name('jobstaken.store');
    });



    Route::get('/check-database', function () {
        try {
            DB::connection()->getPdo();
            return 'Database connection is successful.';
        } catch (\Exception $e) {
            return 'Database connection failed: ' . $e->getMessage();
        } 
    }); 


    Route::post('upload-files', [FilesController::class,'store'])->middleware('optimizeImages'); 

    require __DIR__.'/auth.php';
});
