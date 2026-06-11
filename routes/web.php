<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PupukController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('customer.dashboard');
    }
    return view('welcome');
})->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

/*
|--------------------------------------------------------------------------
| API CUACA
|--------------------------------------------------------------------------
*/

Route::get('/api/cuaca', function () {
    $data = file_get_contents('https://wttr.in/Jember?format=j1');
    return response($data)->header('Content-Type', 'application/json');
});

/*
|--------------------------------------------------------------------------
| AUTH USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | SETTINGS (ADMIN + CUSTOMER)
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/save', [SettingsController::class, 'save'])->name('settings.save');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware(['cek.admin'])->group(function () {

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/dashboard/reset-counter', [DashboardController::class, 'resetCounter'])->name('dashboard.reset_counter');

        Route::get('/admin/laporan', [CheckOutController::class, 'laporan'])->name('admin.laporan');

        Route::get('/admin/pesanan', [CheckOutController::class, 'adminPesanan'])->name('admin.pesanan');
        Route::post('/admin/pesanan/{id}/status', [CheckOutController::class, 'updateStatus'])->name('admin.pesanan.update');

        Route::get('/admin/chats', [ChatController::class, 'index'])->name('admin.chats');
        Route::get('/admin/chats/{chat}', [ChatController::class, 'adminShow'])->name('admin.chats.show');
        Route::post('/admin/chats/{chat}/send', [ChatController::class, 'adminSend'])->name('admin.chats.send');
        Route::get('/admin/chats/{chat}/poll', [ChatController::class, 'adminPoll'])->name('admin.chats.poll');
    });

    /*
    |--------------------------------------------------------------------------
    | PRODUK / PUPUK
    |--------------------------------------------------------------------------
    */

    Route::get('/pupuk-search', [PupukController::class, 'liveSearch'])->name('pupuk.search');
    Route::resource('pupuk', PupukController::class);

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/customer/dashboard', function () {
    $user = auth()->user();

    $totalPesanan = \App\Models\Transaction::where('user_id', $user->id)->count();

    $totalPengeluaran = \App\Models\Transaction::where('user_id', $user->id)
        ->whereIn('status', ['selesai', 'dikirim', 'diproses'])
        ->sum('total');

    $totalKeranjang = \App\Models\Cart::where('user_id', $user->id)->sum('qty');

    $pesananTerbaru = \App\Models\Transaction::where('user_id', $user->id)
        ->with('items.pupuk')
        ->latest()
        ->take(5)
        ->get();

    return view('customer.dashboard', compact(
        'totalPesanan',
        'totalPengeluaran',
        'totalKeranjang',
        'pesananTerbaru'
    ));
    })->name('customer.dashboard');

    /*
    |--------------------------------------------------------------------------
    | CART / KERANJANG
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [CheckOutController::class, 'showCheckout'])->name('checkout.form');
    Route::post('/checkout', [CheckOutController::class, 'checkout'])->name('checkout');
    Route::post('/buy-now/{id}', [CheckOutController::class, 'buyNow'])->name('buy.now');
    Route::get('/checkout/cancel', [CheckOutController::class, 'cancelCheckout'])->name('checkout.cancel');

    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/payment/{id}', [CheckOutController::class, 'paymentForm'])->name('payment.form');
    Route::post('/payment/{id}', [CheckOutController::class, 'paymentProcess'])->name('payment.process');

    /*
    |--------------------------------------------------------------------------
    | PESANAN CUSTOMER
    |--------------------------------------------------------------------------
    */

    Route::get('/pesanan', [CheckOutController::class, 'pesanan'])->name('pesanan');
    Route::get('/invoice/{id}', [CheckOutController::class, 'invoice'])->name('invoice');

    Route::post('/pesanan/{id}/konfirmasi',[CheckOutController::class, 'confirmReceived'])->name('pesanan.konfirmasi');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profil/index', [ProfileController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil/update', [ProfileController::class, 'update'])->name('profil.update');

    /*
    |--------------------------------------------------------------------------
    | CHAT — CUSTOMER
    |--------------------------------------------------------------------------
    */

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/poll', [ChatController::class, 'poll'])->name('chat.poll');


    // ── Tambahkan ke routes/web.php ─────────────────────────────────
    // Letakkan di dalam middleware 'auth' yang sudah ada

    
    Route::middleware('auth')->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/',              [NotificationController::class, 'index'])->name('index');
    Route::get('/unread-count',  [NotificationController::class, 'unreadCount'])->name('unread');
    Route::post('/read/{notification}', [NotificationController::class, 'markRead'])->name('read');
    Route::post('/read-all',     [NotificationController::class, 'markAllRead'])->name('readAll');
    });


});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';