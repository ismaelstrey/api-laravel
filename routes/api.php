<?php

// rotas de login
Route::post('login', 'Auth\AuthenticateController@authenticate');
Route::post('login-refresh', 'Auth\AuthenticateController@refreshToken');

Route::get('me', 'Auth\AuthenticateController@getAuthenticatedUser');

Route::group(['namespace' => 'Api'], function () {


    // Rota de clientes
    Route::get('clientes/{id}/filmes-alugados', 'ClienteApiController@alugados');
    Route::get('clientes/{id}/documento', 'ClienteApiController@documento');
    Route::get('clientes/{id}/telefone', 'ClienteApiController@telefone');
    Route::resource('clientes', 'ClienteApiController');
    // Rota de documentos
    Route::get('documento/{id}/cliente', 'DocumentoApiController@cliente');
    Route::resource('documento', 'DocumentoApiController');
    // Rota de telefone
    Route::get('telefone/{id}/cliente', 'TelefoneApiController@cliente');
    Route::resource('telefone', 'TelefoneApiController');
    // Rota de filmes
    Route::resource('filme', 'FilmeApiController');
});
