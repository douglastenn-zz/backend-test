<?php

namespace App\Http\Controllers;

class VagaController extends Controller
{
    /**
     * Cria uma nova instância do controller.
     *
     * @return void
     */
    public function __construct()
    {
      //
    }

    /**
     * Lista todas as vagas.
     *
     * @return json
     */
    public function findAll()
    {
      echo base_path().'/vagas,json';
      $data = file_get_contents(base_path().'/vagas,json');
      $json = json_decode($data, true);
      echo 'xxxxxxxxxxxxx'; exit  ;
    }
}
