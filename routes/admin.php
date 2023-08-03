<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CustomerAddressController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DriverController;
use App\Http\Controllers\Dashboard\FunctionSettingController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\StateController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\TimeslotController;
use App\Http\Controllers\Dashboard\UnitController;
use App\Http\Controllers\Dashboard\ZipCodeController;
use App\Http\Controllers\Dashboard\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('admin')->group(function () {
        Route::middleware(['auth:admin'])->group(function () {
            Route::resources([
                'users' => AdminController::class,
                'customers' => CustomerController::class,
                'roles' => RoleController::class,
                'settings' => SettingController::class,
                'cities' => CityController::class,
                'zones' => ZoneController::class,
                'addresses' => CustomerAddressController::class,
                'drivers' => DriverController::class,
                'timeslots' => TimeslotController::class,
                'units' => UnitController::class,
                'stores' => StoreController::class,
                'attributes' => AttributeController::class,
                'categories' => CategoryController::class,
            ]);

            //==========================================
            //==AJAX====================================
            //==========================================
            Route::get('state-cities/{id}', [StateController::class, 'getStateCities']);
            Route::get('city-zones/{id}', [CityController::class, 'getCityZones']);
            Route::get('unit-languages/{langId}/{unitId}', [UnitController::class, 'getUnitLanguages']);
            Route::get('store-languages/{langId}/{storeId}', [StoreController::class, 'getStoreLanguages']);
            Route::get('attribute-languages/{langId}/{storeId}', [AttributeController::class, 'getAttributeLanguages']);
            Route::post('/zip-codes', [ZipCodeController::class, 'store'])->name('zip-codes.store');
            Route::put('/static-settings', [FunctionSettingController::class, 'staticSetting'])->name('staticSetting.update');
            Route::get('/lookup-location', [CustomerController::class, 'lookupLocation'])->name('location');
            Route::post('/check-email', [AdminController::class, 'checkEmail']);
            Route::post('/check-mobile', [AdminController::class, 'checkMobile']);
            Route::post('/check-code', [AdminController::class, 'checkCode']);
        });

    require __DIR__ . '/admin_auth.php';
});
