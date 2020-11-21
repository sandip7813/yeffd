<?php

use Illuminate\Support\Facades\Route;
use App\Mail\DonationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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

Route::get('/yeffd-admin', function () {
    return view('auth/login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::redirect('/home', '/');

//+++++++++++++++++++++ ADMIN ROUTES :: Start +++++++++++++++++++++//

Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
});

Route::prefix('admin')->name('admin.')->group(function(){
    //Route::resource('/dashboard', 'UsersController', ['except' => ['create', 'show', 'store']]);
    Route::resource('/events', 'EventsController', ['except' => ['show']]);
    Route::resource('/success-stories', 'SuccessStoriesController', ['except' => ['show']]);
});

Route::post('/change-event-status', 'EventsController@changeStatus');
Route::delete('/delete-event-picture/{id}', 'EventsController@deletePicture')->name('admin.events.delete-picture');
Route::get('/event-picture-dp/{id}', 'EventsController@changeEventPictureDP')->name('admin.events.event-picture-dp');

Route::post('/change-story-status', 'SuccessStoriesController@changeStatus');
Route::delete('/delete-story-picture/{id}', 'SuccessStoriesController@deletePicture')->name('admin.success-stories.delete-picture');
Route::get('/story-picture-dp/{id}', 'SuccessStoriesController@changeSuccessStoryPictureDP')->name('admin.success-stories.story-picture-dp');

Route::get('/donations', 'AdminGeneralController@donations')->name('admin.donations');

//+++++++++++++++++++++ ADMIN ROUTES :: End +++++++++++++++++++++//

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/mission', function () {
    return view('mission');
});


Route::get('/donate', 'PaymentController@payment');
Route::post('/paypal', 'PaymentController@paywithpaypal');
Route::get('/status', 'PaymentController@getPaymentStatus');

Route::get('/events', 'FrontendController@eventsList');
Route::get('/event/{event_slug}', 'FrontendController@eventDetails');
Route::get('/success-stories', 'FrontendController@successStoriesList');
Route::get('/success-story/{story_slug}', 'FrontendController@successStoryDetails');

/* Route::get('/email', function () {
    $donation_array = DB::table('donations')
                        ->where('paymentId', 'PAYID-L6H4AEI0L591602AK320661E')
                        ->first();
    
    //Mail::to('sandip_nandy2005@yahoo.com')->send(new DonationEmail($donation_array));
    return new DonationEmail($donation_array);
}); */


Route::get('/clear-cache', function() {
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";
});
