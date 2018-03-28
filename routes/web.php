<?php

use Illuminate\Http\Request;
use App\Recommend;


Route::get('/','HomeController@index');

Route::get('/home','HomeController@index')->name('home');

Route::get('/logout','HomeController@destroy');

Auth::routes();

Route::get('account/google2fa/enable','Auth\RegisterController@register2FA')->name('google2fa.enable');

Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');

Route::get('account/google2fa/disable','Auth\RegisterController@disable2FA')->name('google2fa.disable');

Route::get('account/google2fa/validate','Auth\LoginController@getValidateToken')->name('google2fa.validateToken');

Route::post('account/google2fa/validate','Auth\LoginController@validate2FA')->name('google2fa.validate');

//Movie

Route::get('/movie/genre','GenreController@index');

Route::resource('movie', 'MovieController');

//Admin Panel

Route::get('/admin','AdminController@index')->name('admin');

Route::post('/admin/sync','AdminController@sync');

Route::post('/admin/syncAll','AdminController@syncAll');

//Users

Route::post('/user/rate','UserController@rate');

Route::post('/user/rating','UserController@getRating');

Route::post('/user/store','UserController@store')->name('user.store');

Route::patch('/user/update_role','UserController@updateRoll')->name('user.updateRoll');

Route::get('user/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor'  => 'Your Company',
        'product' => 'Your Product',
    ]);
});

Route::patch('/user/{id}','UserController@update')->name('user.update');

Route::get('/user/{id}','UserController@show')->name('user.show');

Route::get('/user/{id}/edit','UserController@edit');

Route::delete('/user/delete','UserController@destroy')->name('user.destroy');

Route::get('/login/{provider}','Auth\LoginController@redirectToProvider')->name('user.provider');

Route::get('/login/handle/{provider}','Auth\LoginController@handleProviderCallback');



//Actors

Route::get('/actor', 'ActorController@index');

Route::get('/actor/create','ActorController@create')->name('actor.create');

Route::post('/actor','ActorController@store')->name('actor.store');

Route::delete('/actor/delete','ActorController@destroy')->name('actor.destroy');

Route::get('/actor/{id}/edit','ActorController@edit')->name('actor.edit');

Route::patch('/actor/{id}','ActorController@update')->name('actor.update');

//Genres

Route::get('/genre/create','GenreController@create')->name('genre.create');

Route::post('/genre','GenreController@store')->name('genre.store');

Route::delete('/genre/delete','GenreController@destroy')->name('genre.destroy');

Route::get('/genre/{id}/edit','GenreController@edit')->name('genre.edit');

Route::patch('/genre/{id}','GenreController@update')->name('genre.update');

//Wishlists

Route::post('/wishlist/movies','WishlistController@getMovies')->name('wishlist.movies');

Route::patch('/wishlist/{id}','WishlistController@update')->name('wishlist.update');

Route::delete('/wishlist/{wid}/detach/{mid}','WishlistController@detach')->name('wishlist.detach');

Route::post('/wishlist','WishlistController@store')->name('wishlist.store');

Route::delete('/wishlist/{id}','WishlistController@destroy')->name('wishlist.destroy');

Route::post('/wishlist/{wid}/attach/{mid}','WishlistController@attach')->name('wishlist.attach');

//Subscriptions

Route::get('/account/billing','SubscriptionController@create')->name('subscription.create');

Route::get('/account/plan','SubscriptionController@index')->name('subscription.index');

Route::post('/subscribe','SubscriptionController@store')->name('subscription.store');

Route::patch('/subscribe/change/{id}','SubscriptionController@update')->name('subscription.update');

Route::delete('/subscribe/delete/{id}', 'SubscriptionController@destroy')->name('subscription.destroy');

Route::get('account/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor'  => 'MovieDB.com',
        'product' => 'Subscription',
    ]);
});

//the Search routes

Route::get('/search','SearchController@index')->name('search.index');


//Routes for testing purposes

Route::get('/test/roles',function () {
    return view('test.roles');
});

Route::get('/test/recommended',function () {

    $array = \App\Movie::recommenderArray();

    $ranks = new Recommend();

    $ranks = $ranks->getRecommendations($array,'Ivan Janev');

    return view('test.recommended',compact('ranks'));
});

Route::get('/test/subscription',function (){

    return view('test.subscriptions');
});

Route::get('/test/login','Test@redirectToProvider');

Route::get('/twitter','Test@handleProviderCallback');

Route::get('/flush',function (Request $request){
    session(['auth_passed' => false]);

    return redirect()->route('user.show',$request->user()->id);
});



