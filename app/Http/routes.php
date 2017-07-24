<?php

$app->get('/', function () use ($app) {
    return view('welcome');
});

$app->get('/api/vaga', ["as" => "get_all_vagas", "uses" => "VagaController@findAll"]);

// Rota GET para encontrar todas as vagas
$app->get('/api/vaga', ["as" => "get_all_vagas", "uses" => "VagaController@findAll"]);

// Rota GET para procura geral de vagas através dos atributos [title, description]
$app->get('/api/vaga/{text}', ["as" => "search_vagas", "uses" => "VagaController@search"]);

// Rota POST para filtrar exatamente os atributos das vagas
$app->post('/api/vaga', ["as" => "get_vagas", "uses" => "VagaController@get"]);
