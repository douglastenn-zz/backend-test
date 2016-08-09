<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VagaController extends Controller
{
    /**
     * Cria uma nova instância do controller.
     *
     * @return void
     */
    public function __construct()
    {
      // Decodifica o json e cria uma instância
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
      return response()->json($this->json['docs']);
    }

    public function search($text)
    {
      $types = ['title','description'];
      $result = [];

      foreach ($types as $type) {
        array_push($result, $this->filter($text, $type));
      }

      // Retorna 404 caso não encontre nada
      if(empty($result[0])) {
        return response()->json('Not found', 404);
      }

      return response()->json($result);
    }

    /**
     * Função para listar as vagas de acordo com os parâmetros
     * @param  Request $request injeção de dependência da Classe Request
     * @return Array com as vagas parametrizadas
     */
    public function get(Request $request) {
      $result = [];

      // Retorna 400 (Bad request), pois não foi enviado nenhum parâmetro.
      if(empty($request->input())) {
        return response()->json('Bad Request', 400);
      }

      foreach ($request->input() as $key => $value) {
        array_push($result, $this->filter($value, $key));
      }

      $sort = empty($request->input('sort')) ? 'asc' : $request->input('sort');
      $result = $this->sort($result, $sort);

      // Retorna 404 caso não encontre nada
      if(empty($result)) {
        return response()->json('Not found', 404);
      }

      return response()->json($result);
    }

    /**
     * Função para filtro geral das vagas de acordo
     * com as similaridades entre os textos
     *
     * @param  String $value texto que será aplicado no filtro
     * @param  String $type  atributo que será filtrado
     * @return Array com os filtros aplicados
     */
    public function filter($value, $type)
    {
      $highSimilarity = [];
      $lowSimilarity = [];
      $middleSimilarity = [];

      foreach ($this->json['docs'] as $vaga) :

        if (isset($vaga[$type])) {
          // decodificar a o texto que vem de url
          $value = urldecode($value);

          // remover todos os espaços entre os textos
          $value = preg_replace('/\s+/', '', $value);

          if (is_array($vaga[$type])) {
            foreach ($vaga[$type] as $valueVaga) {
                $currentVaga = preg_replace('/\s+/', '', $valueVaga);
            }
          } else {
            // remover todos os espaços entre os textos
            $currentVaga = preg_replace('/\s+/', '', $vaga[$type]);
          }

          // Verifica a similaridade dos textos e retorna uma porcentagem na variável $percent
          // Poderia ser utilizado também o algoritmo de levenshtein
          similar_text($currentVaga, $value, $percent);

          // Adiciona no array as vagas com o texto que tenha mais similaridade
          // Ordenando assim entre alta, meio e baixa similaridade
          if ($percent >= 90) {
            array_push($highSimilarity, $vaga);
          } elseif ($percent >= 75) {
            array_push($middleSimilarity, $vaga);
          } elseif ($percent >= 60) {
            array_push($lowSimilarity, $vaga);
          }

        }

      endforeach;

      // Retorna um array com as vagas filtradas.
      return array_merge($highSimilarity, $middleSimilarity, $lowSimilarity);
    }

    /**
     * Função para ordenar as vagas por salário
     *
     * @param [Array] $data Array com as vagas que serão ordenadas
     * @param [String] $sort Tipo de ordenação (asc, desc), default asc.
     * @return [Array] Array com as vagas ordenadas
     */
    public function sort($data, $sort)
    {
      usort($data[0], function($a, $b) use ($sort) {
          if($a['salario'] == $b['salario']) {
            return 0;
          }
          // Se variável for descendente
          if ($sort == 'desc') {
             // Se o salário for maior retorna true na ordenação descendente
             return ($a['salario'] > $b['salario']) ? -1 : 1;
          } else {
            // Se o salário for menor retorna true na ordenação ascendente
            return ($a['salario'] < $b['salario']) ? -1 : 1;
          }
      });
      return $data[0];
    }

}
