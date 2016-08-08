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
      $data = file_get_contents(base_path().'/vagas.json');
      $this->json = json_decode($data, true);
    }

    /**
     * Lista todas as vagas.
     *
     * @return json
     */
    public function findAll()
    {

      $value = 'Gaspar';
      $type = 'cidade';
      print_r($this->filter($value, $type));
      // print_r($filtred); exit;
      // return response()->json($this->json);
    }

    public function filter($value, $type)
    {
      $filtred = [];
      foreach($this->json['docs'] as $vaga) {
        // Verifica a similaridade dos textos e retorna uma porcentagem na variável $percent
        similar_text($vaga[$type][0], $value, $percent);
        // Adiciona vagas com o texto que tenha mais que 70% de similaridade
        if($percent >= 70) {
          array_push($filtred, $vaga);
        }
      }
      return $filtred;
    }
}
