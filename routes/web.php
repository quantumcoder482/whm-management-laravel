<?php
use Carbon\Traits\Rounding;
use App\Http\Controllers\ViewSettingController;

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

Route::get('/', function () {
	return view('welcome');
});

Route::get('/suspended', function () {
	return view('suspended');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/get_site_info', 'OrganizationListController@get_site_info');

Route::group(['middleware' => 'auth'], function () {

	/**
	 * Direct Access page
	 */
	Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

	Route::any('/new-organization', 'OrganizationController@new')->name('neworganization');


	/**
	 *  Data processing 
	 */

	Route::get('/organizationlist', 'OrganizationListController@index')->name('organizationlist');
	
	Route::post('/delete-organization', 'OrganizationController@delete')->name('delete_org');
	Route::post('/org-suspend', 'OrganizationController@suspend')->name('org_suspend');
	Route::post('/add-organization', 'OrganizationController@add')->name('add_org');

	Route::get('/view-setting', 'ViewSettingController@index')->name('view_setting');
	Route::post('/update-setting', 'ViewSettingController@update')->name('update_setting');




	/**
	 * Theme templates 
	 */

	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::post('update-status', 'UserController@updateStatus')->name('update_status');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
