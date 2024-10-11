<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index')->name('home');

Route::get('jodi/{category_name}', 'IndexController@jodiDisplay');

Route::get('panel/{category_name}', 'IndexController@PanelDisplay');

Route::get('/clear-laravel-cache','IndexController@clearLaravelCache')->name('clear.laravel.cache');


Route::get('/clear-cache','IndexController@clearLaravelCache');

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);

Route::middleware(['auth', 'twofactor'])->prefix('admin')->group(function () {
  // Test Route
  Route::get('/test', "TestController@test")->name('admin.test');

  // For Settings
  Route::get('/settings/edit_profile', "SettingController@edit_profile")->name('admin.settings.edit_profile');
  Route::get('/settings/general', "SettingController@index")->name('admin.settings.index');
  Route::post('/settings/update', "SettingController@update")->name('admin.settings.update');

  // For Dashboard
  Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');

  // For Users
  Route::get('/users', 'UserController@index')->name('admin.users.index');
  Route::get('/users/add', "UserController@create")->name('admin.users.create');
  Route::get('/users/edit', "UserController@edit")->name('admin.users.edit');
  Route::post('/users/store', "UserController@store")->name('admin.users.store');
  Route::post('/users/update', "UserController@update")->name('admin.users.update');
  Route::get('/users/ajax', "UserController@ajax")->name('admin.users.ajax');
  Route::post('/users/delete', "UserController@delete")->name('admin.users.delete');
  // For date
  Route::get('/date', 'DateController@index')->name('admin.date.index');
  Route::get('/date/add', "DateController@create")->name('admin.date.create');
  Route::get('/date/edit', "DateController@edit")->name('admin.date.edit');
  Route::post('/date/store', "DateController@store")->name('admin.date.store');
  Route::post('/date/update', "DateController@update")->name('admin.date.update');
  Route::get('/date/ajax', "DateController@ajax")->name('admin.date.ajax');
  Route::post('/date/delete', "DateController@delete")->name('admin.date.delete');

   // For Jodi
   Route::get('/jodi', 'JodiController@index')->name('admin.jodi.index');
   Route::get('/jodi/add', "JodiController@create")->name('admin.jodi.create');
   Route::get('/jodi/edit', "JodiController@edit")->name('admin.jodi.edit');
   Route::post('/jodi/store', "JodiController@store")->name('admin.jodi.store');
   Route::post('/jodi/update', "JodiController@update")->name('admin.jodi.update');
   Route::get('/jodi/ajax', "JodiController@ajax")->name('admin.jodi.ajax');
   Route::post('/jodi/delete', "JodiController@delete")->name('admin.jodi.delete');



   // For Panel
   Route::get('/panel', 'PanelController@index')->name('admin.panel.index');
   Route::get('/panel/add', "PanelController@create")->name('admin.panel.create');
   Route::get('/panel/edit', "PanelController@edit")->name('admin.panel.edit');
   Route::post('/panel/store', "PanelController@store")->name('admin.panel.store');
   Route::post('/panel/update', "PanelController@update")->name('admin.panel.update');
   Route::get('/panel/ajax', "PanelController@ajax")->name('admin.panel.ajax');
   Route::post('/panel/delete', "PanelController@delete")->name('admin.panel.delete');

     // For Category
     Route::get('/category', 'CategoryController@index')->name('admin.category.index');
     Route::get('/category/add', "CategoryController@create")->name('admin.category.create');
     Route::get('/category/edit', "CategoryController@edit")->name('admin.category.edit');
     Route::post('/category/store', "CategoryController@store")->name('admin.category.store');
     Route::post('/category/update', "CategoryController@update")->name('admin.category.update');
     Route::get('/category/ajax', "CategoryController@ajax")->name('admin.category.ajax');
     Route::post('/category/delete', "CategoryController@delete")->name('admin.category.delete');

  // For Roles
  Route::get('/roles', 'RoleController@index')->name('admin.roles.index');
  Route::get('/roles/add', "RoleController@create")->name('admin.roles.create');
  Route::get('/roles/edit', "RoleController@edit")->name('admin.roles.edit');
  Route::post('/roles/store', "RoleController@store")->name('admin.roles.store');
  Route::post('/roles/update', "RoleController@update")->name('admin.roles.update');
  Route::get('/roles/ajax', "RoleController@ajax")->name('admin.roles.ajax');
  Route::post('/roles/delete', "RoleController@delete")->name('admin.roles.delete');

  // For Page
  Route::get('/pages', 'Admin\PageController@index')->name('admin.pages.index');
  Route::get('/pages/add', "Admin\PageController@create")->name('admin.pages.create');
  Route::get('/pages/edit', "Admin\PageController@edit")->name('admin.pages.edit');
  Route::post('/pages/store', "Admin\PageController@store")->name('admin.pages.store');
  Route::post('/pages/update', "Admin\PageController@update")->name('admin.pages.update');
  Route::get('/pages/ajax', "Admin\PageController@ajax")->name('admin.pages.ajax');
  Route::post('/pages/delete', "Admin\PageController@delete")->name('admin.pages.delete');

});
