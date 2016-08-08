<?php

$app->get('/vaga', ["as" => "get_all_vagas", "uses" => "VagaController@findAll"]);
