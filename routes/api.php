<?php

use Illuminate\Http\Request;

Route::post('login', 'LoginController@login'); //do login
Route::post('register', 'LoginController@store'); //create petugas


Route::group(['middleware' => ['jwt.verify']], function () {

	Route::get('login/check', "LoginController@LoginCheck"); //cek token
	Route::post('logout', "LoginController@logout"); //cek token

	//Petugas
	Route::get('petugas', "LoginController@index"); //read semua petugas
	Route::get('petugas/{limit}/{offset}', "LoginController@getAll"); //read dengan limit petugas
	// Route::post('petugas', 'LoginController@store'); //create petugas
	Route::put('petugas/{id}', "LoginController@update"); //update petugas
	Route::delete('petugas/{id}', "LoginController@delete"); //delete petugas

	//siswa
	Route::get('product', "ProductController@index"); //read siswa
	Route::get('product/{limit}/{offset}', "ProductController@getAll"); //read siswa
	Route::post('product', 'ProductController@store'); //create siswa
	Route::put('product/{id}', "ProductController@update"); //update siswa
	Route::delete('product/{id}', "ProductController@delete"); //delete siswa

	//pelanggaran
	Route::get('pelanggaran', "PelanggaranController@index"); //read pelanggaran
	Route::get('pelanggaran/{limit}/{offset}', "PelanggaranController@getAll"); //read pelanggaran
	Route::post('pelanggaran', 'PelanggaranController@store'); //create pelanggaran
	Route::put('pelanggaran/{id}', "PelanggaranController@update"); //update pelanggaran
	Route::delete('pelanggaran/{id}', "PelanggaranController@delete"); //delete pelanggaran

	//kelola poin siswa
	Route::get('poin', "PoinController@index"); //read poin
	Route::get('poin/{limit}/{offset}', "PoinController@getAll"); //read poin
	Route::post('poin', 'PoinController@store'); //create poin
	Route::put('poin/{id}', "PoinController@update"); //update poin
	Route::delete('poin/{id}', "PoinController@delete"); //delete poin

	//Data Semua Poin Siswa
	Route::get('poin_siswa', 'PoinController@getPoinSiswa');

	//Cari data poin siswa by nama
	Route::post('poin_siswa', 'PoinController@findPoinSiswa');

	//data detail poin per siswa
	Route::get('poin_siswa/{id}','PoinController@getDetailPoinSiswa');
});