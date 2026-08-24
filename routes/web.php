<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    WelcomeController,
    BlogController,
    ClientController,
    MyPostController,
    ProfileController,
    ResentPasswordController,
    InvoiceController,
    AIController,
    CapatchaController,
};

use App\Http\Controllers\Berker\{
    BeekeeperController,
    RedeemCodeController,
    DashboradController,
    ProfileBeekeerperController,
};

use App\Livewire\{
    AboutPage,
    Catgorypage,
    Contactpage,
    Descpage,
    Homepage,
    Productpage,
    TeamWork,
    OrdersList,
    OrdersSuccess,
    CartList,
    PayPage,
    VideoPage,
    Feq,
    ChatList
};


// Guest Routes
Route::middleware(['guest', 'lang'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('wel.pag');
    Route::get('/staticpage', [WelcomeController::class, 'staticPage'])->name('info.dev');
    Route::get('/video', VideoPage::class);
    Route::get('/feq', Feq::class)->name('faq.index');

    // AI Route -------
    Route::get('/ask-json', [AIController::class, 'showForm'])->name('ask-json.form');
    Route::post('/ask-json', [AIController::class, 'getAnswer'])->name('ask-json.ai');

    // Captcha Route -------
    Route::get('/captcha-image', [CapatchaController::class, 'CapatchaImage']);
    Route::get('/verify-captcha', [CapatchaController::class, 'CapatchaVerify'])->name('verify-captcha.get');
    Route::post('/verify-captcha', [CapatchaController::class, 'CapatchaVerifySend'])->name('verify-captcha');

    Route::prefix('generalpublications')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('generalpublications.index');
        Route::get('/{req}', [BlogController::class, 'showR'])->name('show.cl');
        Route::get('/ad/{blo}', [BlogController::class, 'showA'])->name('show.ad');
    });

    Route::get('/login', [ClientController::class, 'login'])->name('login');
    Route::post('/login', [ClientController::class, 'postlogin'])->name('postlogin');

    Route::get('/register', [ClientController::class, 'register'])->name('register');
    Route::post('/register', [ClientController::class, 'postregister'])->name('postregister');

    Route::prefix('forgot-password')->group(function () {
        Route::get('/', [ResentPasswordController::class, 'forgot'])->name('password.request');
        Route::post('/', [ResentPasswordController::class, 'postforgot'])->name('password.email');
    });

    Route::prefix('reset-password')->group(function () {
        Route::get('/{token}', [ResentPasswordController::class, 'resent'])->name('password.reset');
        Route::post('/', [ResentPasswordController::class, 'postresent'])->name('password.update');
    });
});

// Authenticated Client Routes
Route::middleware(['client', 'lang'])->group(function () {
    Route::get('/logout', [ClientController::class, 'logout'])->name('logout');
    Route::get('/orders', OrdersList::class);
    Route::get('/cart', CartList::class)->name('cart.index');
    Route::get('/order/success/{orderId}', OrdersSuccess::class)->name('order.success');
    Route::get('/invoice/download/{orderId}', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::post('/order-email/{order}', [InvoiceController::class, 'orderSend'])->name('order.invoice.email');
    Route::get('/orders/old', [InvoiceController::class, 'oldOrder'])->name('order.old');
    Route::get('/pay/{orderId}', PayPage::class)->name('fake.pay');


    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::delete('/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('my-post')->group(function () {
        Route::get('/', [MyPostController::class, 'index'])->name('post.index');
        Route::get('/create', [MyPostController::class, 'create'])->name('post.create');
        Route::post('/store', [MyPostController::class, 'store'])->name('post.store');
        Route::get('/delete/{id}', [MyPostController::class, 'destroy'])->name('post.destroy');
        Route::get('/edit/{id}', [MyPostController::class, 'edit'])->name('post.edit');
        Route::post('/update/{id}', [MyPostController::class, 'update'])->name('post.update');
    });

    Route::get('/home', Homepage::class)->name('home.index');
    Route::get('/about', AboutPage::class)->name('about.index');
    Route::get('/product', ProductPage::class)->name('product.index');
    Route::get('/category', CatgoryPage::class)->name('category.index');
    Route::get('/contact', ContactPage::class)->name('contact.index');
    Route::get('/desc/product/{product}', DescPage::class)->name('desc.index');
    Route::get('/team', TeamWork::class);
    Route::get('/chat', ChatList::class)->name('chat');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [ResentPasswordController::class, 'verieyemail'])->name('verification.notice');
    Route::post('/email/verification-notification', [ResentPasswordController::class, 'sendEmail'])
        ->middleware('throttle:6,1')->name('verification.send');
});

Route::get('/email/verify/{id}/{hash}', [ResentPasswordController::class, 'veriey'])
    ->middleware(['auth', 'signed'])->name('verification.verify');

// Language Switch Route
Route::get('/lang/{lang}', [WelcomeController::class, 'languish'])->name('lang.switch');


// ------------------------------//

Route::get('/loginbeekeeper', [BeekeeperController::class, 'loginbee'])->name('loginbeekeeper');
Route::post('/loginbeekeeper', [BeekeeperController::class, 'postloginbee'])->name('postloginbeekeeper');

Route::get('/registerbeekeeper', [BeekeeperController::class, 'registerbee'])->name('registerbeekeeper');
Route::post('/registerbeekeeper', [BeekeeperController::class, 'postregisterbee'])->name('postregisterbeekeeper');

Route::post('/redeem-code', [RedeemCodeController::class, 'redeem'])->name('redeem.code');
Route::get('/redeem-code', [RedeemCodeController::class, 'showForm'])->name('redeem.form');

Route::middleware(['beekeeper', 'lang'])->group(function () {
    Route::middleware('beekeepe.code')->get('/dashborad', [DashboradController::class, 'dash'])->name('hives.dashboard');
    Route::get('/hive-simulator', [DashboradController::class, 'index'])->name('hive.simulator');
    Route::post('/hive-simulator', [DashboradController::class, 'store']);
    Route::get('/hives/{hive}', [DashboradController::class, 'show'])->name('hives.show');
    Route::post('/logout-beekeeper', [BeekeeperController::class, 'logoutbeekeeper'])->name('logout.beekeeper');
    Route::prefix('profile-beekeer')->group(function () {
        Route::get('/', [ProfileBeekeerperController::class, 'profilebeekeer'])->name('profile.beekeer');
        Route::post('/update', [ProfileBeekeerperController::class, 'updateProfilebeekeer'])->name('profilebeekeer.update');
        Route::delete('/delete', [ProfileBeekeerperController::class, 'destroybeekeer'])->name('profilebeekeer.destroy');
    });
});
