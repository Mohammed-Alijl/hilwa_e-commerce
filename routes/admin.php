<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\AttributeValueController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\CustomerAddressController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DriverController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\StateController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\TimeslotController;
use App\Http\Controllers\Dashboard\UnitController;
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
                'values' => AttributeValueController::class,
                'categories' => CategoryController::class,
                'products' => ProductController::class,
            ]);

            Route::get('/',[\App\Http\Controllers\Dashboard\DashboardController::class,'create']);

            //==========================================
            //==AJAX====================================
            //==========================================
            Route::get('state-cities/{id}', [StateController::class, 'getStateCities']);
            Route::get('city-zones/{id}', [CityController::class, 'getCityZones']);
            Route::get('attribute-values/{id}', [AttributeController::class, 'getAttributeValues']);
            Route::get('unit-languages/{langId}/{unitId}', [UnitController::class, 'getUnitLanguages']);
            Route::get('store-languages/{langId}/{storeId}', [StoreController::class, 'getStoreLanguages']);
            Route::get('category-languages/{langId}/{categoryId}', [CategoryController::class, 'getCategoryLanguages']);
            Route::get('attribute-languages/{langId}/{storeId}', [AttributeController::class, 'getAttributeLanguages']);
            Route::post('/zip-codes', [SettingController::class, 'addZipCode'])->name('zip-codes.store');
            Route::put('/static-settings', [SettingController::class, 'staticSetting'])->name('staticSetting.update');
            Route::get('/lookup-location', [CustomerController::class, 'lookupLocation'])->name('location');
            Route::post('/check-email', [AdminController::class, 'checkEmail']);
            Route::post('/check-mobile', [AdminController::class, 'checkMobile']);
            Route::post('/check-code', [AdminController::class, 'checkCode']);

            Route::get('categories/create/child/category/{id}',[CategoryController::class,'createChild'])->name('categories.child.create');
        });

    require __DIR__ . '/admin_auth.php';
});
