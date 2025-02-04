<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\systemControllers\UsersController;
use App\Http\Controllers\systemControllers\AuthController;
use App\Http\Controllers\systemControllers\CarsController;
use App\Http\Controllers\systemControllers\ServiceController;
use App\Http\Controllers\systemControllers\OrcamentoController;
use App\Http\Controllers\TaxaController;
use App\Http\Controllers\systemControllers\PaymentController;
use App\Http\Controllers\systemControllers\MessageController;
use App\Http\Controllers\systemControllers\ReportController;


Route::get('/', function(){
    return view('welcome');
});

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::get('/register', function(){
    return view('auth.register');
})->name('register');

Route::get('/pricing', [ServiceController::class,'pricing'])->name('pricing');


Route::post('/entrar',[AuthController::class,'login'])->name('entrar');
Route::get('/sair',[AuthController::class,'logout'])->name('sair');
Route::prefix('customers')->group(function(){
    Route::controller(UsersController::class)->group(function(){
        Route::get('/','index')->middleware(['auth']);
        Route::post('/','store');
        Route::put('/update/{id}','update')->middleware(['auth']);
        Route::put('/updatePassword','updatePassword')->middleware(['auth']);
        Route::get('/employee','indexFunc')->middleware(['auth']);
        Route::get('/customers-details/{id}', 'show')->middleware(['auth']);
    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard',[UsersController::class, 'dashboard']);


    Route::get('/relatorios', [ReportController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorios/pdf', [ReportController::class, 'gerarPdf'])->name('relatorios.pdf');

    Route::prefix('cars')->group(function(){
        Route::controller(CarsController::class)->group(function(){
            Route::get('/','index');
            Route::post('/','store');
            Route::get('/qrcode/{id}','show');
            Route::put('/update/{id}','update');
            Route::delete('/delete/{id}','destroy');
        });
    });
    
    Route::prefix('message')->group(function(){
        Route::controller(MessageController::class)->group(function(){
            Route::get('/','index');
            Route::post('/','store');
            Route::put('/update/{id}','update');
            Route::delete('/delete/{id}','destroy');
        });
    });


    Route::prefix('orcamentos')->group(function(){
        Route::controller(OrcamentoController::class)->group(function(){
            Route::get('/','index');
            Route::post('/','store');
            Route::put('/update/{id}','update');
            Route::delete('/delete/{id}','destroy');
        });
    });
    Route::resource('pagamento', PaymentController::class);
    Route::get('/download/{id}', [PaymentController::class, 'downloadReceipt']);
    Route::prefix('taxas')->group(function(){
        Route::controller(TaxaController::class)->group(function(){
            Route::get('/','index');
            Route::post('/','store');
            Route::put('/update/{id}','update');
            Route::delete('/delete/{id}','destroy');
        });
    });

 

    Route::prefix('services')->group(function(){
        Route::controller(ServiceController::class)->group(function(){
            Route::get('/','index');
            Route::post('/','store');
            Route::put('/update/{id}','update');
            Route::delete('/delete/{id}','destroy');
        });
    });


    Route::get('/reports', function(){
        return view('dash_pages.reports');
    });


    

    Route::get('/settings', function(){
        return view('dash_pages.settings');
    });


});






