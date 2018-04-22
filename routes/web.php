<?php

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
Route::get('coba', 'Coba@coba');

//ROUTE APLIKASI ADMIN
//login
Route::get('vLoginAdmin', 'Admin\LoginAdmin@vLogin');
Route::post('loginAdmin', 'Admin\LoginAdmin@login');
Route::get('logoutAdmin', 'Admin\LoginAdmin@logout');

//admi middleware
Route::group(['middleware' => 'checkLogin'], function () {
	Route::get('homeAdmin', 'Admin\CrudAdmin@vHomeAdmin');
	// my profile admin
	Route::get('vMyProfileAdmin', 'Admin\CrudAdmin@vMyProfile');
	Route::get('myProfileAdmin/{username}', 'Admin\CrudAdmin@myProfile');
	Route::post('updateMyProfileAdmin', 'Admin\CrudAdmin@updateMyProfile');
	// crud manage admin
	Route::get('vCrudAdmin', 'Admin\CrudAdmin@vCrudAdmin');
	Route::get('listAdmin', 'Admin\CrudAdmin@listAdmin');
	Route::get('detailAdmin/{username}', 'Admin\CrudAdmin@detailAdmin');
	Route::get('deleteAdmin/{username}', 'Admin\CrudAdmin@deleteAdmin');
	Route::post('mDeleteAdmin', 'Admin\CrudAdmin@mDeleteAdmin');
	Route::post('storeAdmin', 'Admin\CrudAdmin@storeAdmin');
	Route::post('updateAdmin', 'Admin\CrudAdmin@updateAdmin');
	// rud User
	Route::get('vManageUser', 'Admin\RudUser@vManageUser');
	Route::get('listUser', 'Admin\RudUser@listUser');
	Route::get('detailUser/{id}', 'Admin\RudUser@detailUser');
	Route::get('deleteUser/{id}', 'Admin\RudUser@deleteUser');
	Route::post('mDeleteUser', 'Admin\RudUser@mDeleteUser');
	Route::post('updateUser', 'Admin\RudUser@updateUser');
	// crud sekolah
	Route::get('vCrudSekolah', 'Admin\CrudSekolah@vCrudSekolah');
	Route::get('listSekolah', 'Admin\CrudSekolah@listSekolah');
	Route::get('detailSekolah/{id}', 'Admin\CrudSekolah@detailSekolah');
	Route::get('deleteSekolah/{id}', 'Admin\CrudSekolah@deleteSekolah');
	Route::post('mDelSekolah', 'Admin\CrudSekolah@mDeleteSekolah');
	Route::post('storeSekolah', 'Admin\CrudSekolah@storeSekolah');
	Route::post('updateSekolah', 'Admin\CrudSekolah@updateSekolah');
	// KOMENTAR rd
	Route::get('vKomentar', 'Admin\KomentarC@vKomentar');
	Route::get('listKomentar', 'Admin\KomentarC@listKomentar');
	Route::get('deleteKomentar/{id}', 'Admin\KomentarC@deleteKomentar');
	Route::post('mDelKomentar', 'Admin\KomentarC@mDeleteKomentar');
	// LIKE SEKOLAH
	Route::get('vLikeSekolah', 'Admin\LikeC@vLikeSekolah');
	Route::get('listLike', 'Admin\LikeC@listLike');
});

// ANDROID
Route::get('getToken', 'Android\LoginC@sendToken');
Route::post('loginUser', 'Android\LoginC@login');
Route::get('logoutUserAnd', 'Android\LoginC@logout');
Route::get('getSessionUser', 'Android\LoginC@getSession');
Route::get('myUserAkun/{id}', 'Android\UserC@detailUser');
Route::post('saveNewUser_And', 'Android\UserC@saveNew');
Route::post('updateUser_And', 'Android\UserC@updateUser');
Route::get('listSekolah/{rayon}', 'Android\SekolahC@listSekolah');
Route::get('getUserLike_And/{id}', 'Android\UserC@getUserLike');
Route::post('sendLike_And', 'Android\UserC@sendLike');
Route::get('deleteUserLike/{id}', 'Android\UserC@deleteUserLike');
Route::get('countUserLike/{id}', 'Android\UserC@countUserLike');
Route::get('getKomentar_And/{id}', 'Android\UserC@getKomentar');
Route::get('getLike_And/{id}', 'Android\UserC@getLike');
Route::post('sendKomentar_And', 'Android\UserC@sendKomentar');
Route::get('countKomentar_And/{id}', 'Android\UserC@countKomentar');
