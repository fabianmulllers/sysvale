<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['middleware'=>'auth', function () {
    return view('home');
}]);

Route::auth();

Route::get('/home', 'HomeController@index');


Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' ], function (){
    Route::resource('users','UserController');
    Route::resource('empresas','EmpresaController');
    Route::resource('departamentos','DepartamentoController');
    Route::put('users','UserController@updatePaneles')->name("admin.users.updatepaneles");
    Route::post('users/selecttype','UserController@select_type')->name("admin.users.selecttype");
    Route::put('empresas','EmpresaController@updatePaneles')->name("admin.empresas.updatepaneles");
    Route::put('departamentos','DepartamentoController@updatePaneles')->name("admin.departamentos.updatepaneles");


});

Route::group(['prefix' => 'user' , 'namespace' => 'Usuario'], function (){

        Route::post('vales/buscarproducto', 'ValesController@buscarproducto')->name('user.vales.buscarproducto');
        Route::post('vales/ingresarvale', 'ValesController@ingresarvale')->name('user.vales.ingresarvale');
        Route::post('vales/vernotificacion', 'ValesController@vernotificacion')->name('user.vales.vernotificacion');
        Route::resource('vales','ValesController');
        Route::put('vales', 'ValesController@valeingresados')->name('user.vales.valeingresados');



});


Route::group(['prefix' => 'approver' , 'namespace' => 'Approver'], function (){
    Route::get('approver/{approver}/desbloquear','ApproverController@desbloquear')->name('approver.approver.desbloquear');
    Route::post('approver/aprobarvale','ApproverController@aprobarvale')->name('approver.approver.aprobarvale');
    Route::get('approver/{approver}/enviarnotificacion','ApproverController@enviarnotificacion')->name('approver.approver.enviarnotificacion');
    Route::put('approver','ApproverController@updatePaneles')->name("approver.approver.updatepaneles");
    Route::resource('approver','ApproverController');


});