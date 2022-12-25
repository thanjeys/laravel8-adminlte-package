<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\ {
    BankComponent,
    UserComponent,
    LeadsComponent,
    FreelancerComponent
};



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


Auth::routes([
    'register' => true, // register
    'reset' => false,
    'verify' => false,
  ]);

Route::redirect('/', 'login');

Route::middleware('auth')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('sanctioned-report', [HomeController::class, 'getLoanSanctionedOfMonth'])->name('sanctioned.report');
    Route::get('leads', LeadsComponent::class)->name('leads');
    Route::get('users', UserComponent::class)->name('users')->middleware('can:isAdmin');
    Route::get('banks', BankComponent::class)->name('banks');
    Route::get('freelancers', FreelancerComponent::class)->name('freelancers');

    Route::get('/changePassword',[ProfileController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[ProfileController::class, 'changePasswordPost'])->name('changePasswordPost');

    Route::view('bankcategory', 'bankcategory')->name('bankcategory');
    Route::view('bankcategory-upload', 'bankcategory-upload')->name('bankcategory-upload');



});



