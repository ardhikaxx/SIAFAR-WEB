<?php

use App\Models\Medicine;
use App\Models\ApotekRating;
use App\Models\ShippingMethod;
use App\View\Components\Cards;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\ProfileEditController;
use App\Http\Controllers\ApotekRatingController;
use App\Http\Controllers\HomeCustomerController;
use App\Http\Controllers\TransactionInController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\TransactionOutController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\DashboardApotekerController;
use App\Http\Controllers\TransactionInDetailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\TransactionOut; // Pastikan untuk mengimpor model TransactionOut


Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::resource('dashboard', DashboardAdminController::class)->names([
        'index' => 'index',
    ]);

    Route::resource('profiles', ProfileEditController::class)->names([
        'edit' => 'profiles.edit',
        'update' => 'profiles.update',
    ]);

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');

    Route::resource('medicines', MedicineController::class)->names([
        'index' => 'medicines.index',
        'create' => 'medicines.create',
        'store' => 'medicines.store',
        'show' => 'medicines.show',
        'edit' => 'medicines.edit',
        'update' => 'medicines.update',
        'destroy' => 'medicines.destroy',
    ]);

    Route::resource('categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'show' => 'categories.show',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy',
    ]);

    Route::resource('units', UnitController::class)->names([
        'index' => 'units.index',
        'create' => 'units.create',
        'store' => 'units.store',
        'edit' => 'units.edit',
        'update' => 'units.update',
        'destroy' => 'units.destroy',
    ]);

    Route::resource('payments', PaymentController::class)->names([
        'index' => 'payments.index',
        'create' => 'payments.create',
        'store' => 'payments.store',
        'edit' => 'payments.edit',
        'update' => 'payments.update',
        'destroy' => 'payments.destroy',
    ]);

    Route::resource('suppliers', SupplierController::class)->names([
        'index' => 'suppliers.index',
        'create' => 'suppliers.create',
        'store' => 'suppliers.store',
        'edit' => 'suppliers.edit',
        'update' => 'suppliers.update',
        'destroy' => 'suppliers.destroy',
    ]);

    Route::resource('shippings', ShippingController::class)->names([
        'index' => 'shippings.index',
    ]);

    Route::resource('shipping_method', ShippingMethodController::class)->names([
        'create' => 'shippings.shipping_method.create',
        'store' => 'shippings.shipping_method.store',
        'edit' => 'shippings.shipping_method.edit',
        'update' => 'shippings.shipping_method.update',
        'destroy' => 'shippings.shipping_method.destroy',
    ]);

    Route::resource('shipping_address', ShippingAddressController::class)->names([
        'create' => 'shippings.shipping_address.create',
        'store' => 'shippings.shipping_address.store',
        'edit' => 'shippings.shipping_address.edit',
        'update' => 'shippings.shipping_address.update',
        'destroy' => 'shippings.shipping_address.destroy',
    ]);

    Route::resource('discounts', DiscountController::class)->names([
        'index' => 'discounts.index',
        'create' => 'discounts.create',
        'store' => 'discounts.store',
        'edit' => 'discounts.edit',
        'update' => 'discounts.update',
        'destroy' => 'discounts.destroy',
    ]);

    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);

    Route::resource('transactionOuts', TransactionOutController::class)->names([
        'index' => 'transactionOuts.index',
        'show' => 'transactionOuts.show',
        'update' => 'transactionOuts.update',
    ]);
    Route::get('transactionOuts/{transactionOut}/print', function (TransactionOut $transactionOut) {
        Log::info('Print transactionOuts accessed for ID: ' . $transactionOut->id);
        return app(TransactionOutController::class)->print($transactionOut);
    })->name('transactionOuts.print');


    Route::resource('transactionIns', TransactionInController::class)->names([
        'index' => 'transactionIns.index',
        'show' => 'transactionIns.show',
        'create' => 'transactionIns.create',
        'store' => 'transactionIns.store',
    ]);
    Route::get('transactionIns/{id}/print', function ($id) {
        Log::info('Print transactionIns accessed for ID: ' . $id);
        return app(TransactionInController::class)->print($id);
    })->name('transactionIns.print');


    Route::resource('transactionInDetails', TransactionInDetailController::class)->names([
        'store' => 'transactionInDetails.store',
        'update' => 'transactionInDetails.update',
        'destroy' => 'transactionInDetails.destroy',
    ]);


    Route::resource('reports', ReportController::class)->names([
        'index' => 'reports.index',
    ]);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reportOut', [ReportController::class, 'reportOut'])->name('reports.reportOut');
    Route::get('reportIn', [ReportController::class, 'reportIn'])->name('reports.reportIn');

    Route::put('transactionOutStatus/{transactionOut}', [TransactionOutController::class, 'updateStatusOut'])->name('transactionOutStatus.updateStatusOut');

    Route::post('whatsapp/{transactionOut}/send', [TransactionOutController::class, 'whatsapp'])->name('transactionOuts.whatsapp');

    Route::resource('token', TokenController::class)->names([
        'index' => 'token.index',
        'update' => 'token.update'
    ]);

    Route::resource('feedbacks', FeedBackController::class)->names([
        'index' => 'feedbacks.index',
    ]);

    Route::resource('promoCodes', PromoCodeController::class)->names([
        'index' => 'promoCodes.index',
        'create' => 'promoCodes.create',
        'store' => 'promoCodes.store',
        'edit' => 'promoCodes.edit',
        'update' => 'promoCodes.update',
        'destroy' => 'promoCodes.destroy',
    ]);

    Route::post('categories-import', [CategoryController::class, 'import'])->name('categories.import');
    Route::post('units-import', [UnitController::class, 'import'])->name('units.import');
    Route::post('medicines-import', [MedicineController::class, 'import'])->name('medicines.import');
    Route::post('suppliers-import', [SupplierController::class, 'import'])->name('suppliers.import');
});


Route::middleware(['auth', 'role:apoteker'])->prefix('apoteker')->as('apoteker.')->group(function () {
    Route::resource('dashboard', DashboardApotekerController::class)->names([
        'index' => 'index',
    ]);

    Route::resource('profiles', ProfileEditController::class)->names([
        'edit' => 'profiles.edit',
        'update' => 'profiles.update',
    ]);

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');

    Route::resource('medicines', MedicineController::class)->names([
        'index' => 'medicines.index',
    ]);

    Route::resource('transactionOuts', TransactionOutController::class)->names([
        'index' => 'transactionOuts.index',
        'show' => 'transactionOuts.show',
    ]);
    Route::get('transactionOuts/{transactionOut}/print', function (TransactionOut $transactionOut) {
        Log::info('Print transactionOuts accessed for ID: ' . $transactionOut->id);
        return app(TransactionOutController::class)->print($transactionOut);
    })->name('transactionOuts.print');


    Route::resource('transactionIns', TransactionInController::class)->names([
        'index' => 'transactionIns.index',
        'show' => 'transactionIns.show',
    ]);

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reportOut', [ReportController::class, 'reportOut'])->name('reports.reportOut');
    Route::get('reportIn', [ReportController::class, 'reportIn'])->name('reports.reportIn');

    Route::get('transactionIns/{id}/print', function ($id) {
        Log::info('Print transactionIns accessed for ID: ' . $id);
        return app(TransactionInController::class)->print($id);
    })->name('transactionIns.print');

    Route::resource('feedbacks', FeedBackController::class)->names([
        'index' => 'feedbacks.index',
    ]);
    Route::resource('discounts', DiscountController::class)->names([
        'index' => 'discounts.index',
        'create' => 'discounts.create',
        'store' => 'discounts.store',
        'edit' => 'discounts.edit',
        'update' => 'discounts.update',
        'destroy' => 'discounts.destroy',
    ]);



    Route::resource('promoCodes', PromoCodeController::class)->names([
        'index' => 'promoCodes.index',
        'create' => 'promoCodes.create',
        'store' => 'promoCodes.store',
        'edit' => 'promoCodes.edit',
        'update' => 'promoCodes.update',
        'destroy' => 'promoCodes.destroy',
    ]);
});



Route::middleware(['auth', 'role:customer'])->prefix('customer')->as('customer.')->group(function () {
    Route::resource('home', HomeCustomerController::class)->names([
        'index' => 'index',
    ]);

    Route::resource('profiles', ProfileEditController::class)->names([
        'edit' => 'profiles.edit',
        'update' => 'profiles.update',
    ]);

    Route::resource('medicines', MedicineController::class)->names([
        'index' => 'medicines.index',
    ]);

    Route::resource('carts', CartController::class)->names([
        'index' => 'carts.index',
        'create' => 'carts.create',
        'store' => 'carts.store',
        'update' => 'carts.update',
    ]);

    Route::get('checkout', [CartController::class, 'indexCheckout'])->name('checkout.index');

    Route::get('checkout/cek-promo', [CartController::class, 'CekPromo'])->name('checkout.CekPromo');

    Route::put('update-queue-number{id}', [TransactionOutController::class, 'updateQueueNumber'])->name('transactionOuts.updateQueueNumber');

    Route::resource('transactionOuts', TransactionOutController::class)->names([
        'index' => 'transactionOuts.index',
        'show' => 'transactionOuts.show',
        'update' => 'transactionOuts.update',
    ]);


    Route::get('transactionOuts/{transactionOut}/print', function (TransactionOut $transactionOut) {
        Log::info('Print transactionOuts accessed for ID: ' . $transactionOut->id);
        return app(TransactionOutController::class)->print($transactionOut);
    })->name('transactionOuts.print');


    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');

    Route::get('/customer/transactionOuts/queue-status', [TransactionOutController::class, 'getQueueStatus'])->name('customer.transactionOuts.getQueueStatus');


    Route::get('/ratings/{transactionOut}/create', [ApotekRatingController::class, 'create'])->name('ratings.create');
    Route::post('/ratings/{transactionOut}', [ApotekRatingController::class, 'store'])->name('ratings.store');

    Route::post('/med-rates/{medicine}', [MedicineController::class, 'storeRating'])->name('med-rates.storeRating');

    Route::resource('shipping_address', ShippingAddressController::class)->names([
        'index' => 'shippings.shipping_address.index',
        'create' => 'shippings.shipping_address.create',
        'store' => 'shippings.shipping_address.store',
        'edit' => 'shippings.shipping_address.edit',
        'update' => 'shippings.shipping_address.update',
        'destroy' => 'shippings.shipping_address.destroy',
    ]);

});

Route::get('home', [HomeCustomerController::class, 'index'])->name('public.index');
Route::get('medicines', [MedicineController::class, 'index'])->name('public.medicines.index');
Route::get('medicines{medicine}', [MedicineController::class, 'show'])->name('public.medicines.show');

// AKTOR: ADMIN, APOTEKER, CUSTOMER







require __DIR__ . '/auth.php';

