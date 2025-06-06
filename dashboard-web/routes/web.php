        <?php

        use App\Http\Controllers\ProfileController;
        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\CityController;
        use App\Http\Controllers\CitizenController;
        use App\Http\Controllers\ReportCitizenController;


        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        Route::get('/citizens/grouped', [CitizenController::class, 'grouped'])->name('citizens.grouped');
        
        Route::middleware(['auth'])->group(function () {
            Route::resource('cities', CityController::class);
            Route::resource(('citizens'), CitizenController::class);
            Route::get('report', [ReportCitizenController::class, 'send_report'])->name('report');
        });

        Route::get('/custom-dashboard', [App\Http\Controllers\NewDashboardController::class, 'index'])->name('custom-dashboard');

        Route::post('/toggle-darkmode', function () {
            $darkMode = session('dark_mode', false);
            session(['dark_mode' => !$darkMode]);
            return back();
        })->name('toggle.darkmode');



        require __DIR__.'/auth.php';