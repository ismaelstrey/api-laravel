<?php
// Rota de clientes
Route::get('clientes/{id}/documento', 'Api\ClienteApiController@documento');
Route::get('clientes/{id}/telefone', 'Api\ClienteApiController@telefone');
Route::resource('clientes', 'Api\ClienteApiController');
// Rota de documentos
Route::get('documento/{id}/cliente', 'Api\DocumentoApiController@cliente');
Route::resource('documento', 'Api\DocumentoApiController');
// Rota de telefone
Route::get('telefone/{id}/cliente', 'Api\TelefoneApiController@cliente');
Route::resource('telefone', 'Api\TelefoneApiController');
// Rota de filmes
Route::resource('filme', 'Api\FilmeApiController');
