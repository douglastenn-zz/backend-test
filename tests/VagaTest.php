<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class VagaTest extends TestCase
{
    /**
     * Teste que deve retornar um json com todas as vagas
     * @return void
     */
    public function testFindAll()
    {
        $this->get('/api/vaga');
        $this->assertTrue($this->response->isOk());
        $this->assertJson($this->response->getContent());
    }

    /**
     * Teste que deve validar busca na /api/vaga com texto simples
     * @return void
     */
    public function testGetWithSimpleText()
    {
      $this->get('/api/vaga/camareiro');
      $this->assertJson($this->response->getContent());
      $this->assertTrue($this->response->isOk());
    }

    /**
     * Teste Get que deve executar status code 404, de não encontrado
     * @return void
     */
    public function testGetWithAnotherText()
    {
      $this->get('/api/vaga/green elixir');
      $this->assertJson($this->response->getContent());
      $this->assertEquals(404,$this->response->getStatusCode());
    }

    /**
     * Teste que deve validar busca com texto composto
     * @return void
     */
    public function testGetEncodedText()
    {
      $this->get('/api/vaga/realiza limpeza');
      $this->assertJson($this->response->getContent());
      $this->assertTrue($this->response->isOk());
    }

    /**
     * Teste que deve filtrar através do post de cidade gaspar
     * com ordenação descendente
     * @return void
     */
    public function testFilterCityWithSorcDesc()
    {
      $data = array(
        'cidade' => 'gaspar',
        'sort' => 'desc'
      );

      $this->response = $this->call('POST', '/api/vaga', $data);
      $this->assertJson($this->response->getContent());

      $data = json_decode($this->response->getContent(), true);

      foreach($data as $hasKey) :
        $this->assertArrayHasKey('title', $hasKey);
        $this->assertArrayHasKey('description', $hasKey);
        $this->assertArrayHasKey('salario', $hasKey);
        $this->assertArrayHasKey('cidade', $hasKey);
        $this->assertArrayHasKey('cidadeFormated', $hasKey);
      endforeach;

      $this->assertTrue($this->response->isOk());
    }

    /**
     * Teste de filtro com atributo título
     * garçom e ordenação ascendente
     * @return void
     */
    public function testFilterTitleWithSortAsc()
    {
      $data = array(
        'title' => 'Garçom',
        'sort' => 'asc'
      );

      $this->response = $this->call('POST', '/api/vaga', $data);
      $this->assertJson($this->response->getContent());

      $data = json_decode($this->response->getContent(), true);

      foreach($data as $hasKey) :
        $this->assertArrayHasKey('title', $hasKey);
        $this->assertArrayHasKey('description', $hasKey);
        $this->assertArrayHasKey('salario', $hasKey);
        $this->assertArrayHasKey('cidade', $hasKey);
        $this->assertArrayHasKey('cidadeFormated', $hasKey);
      endforeach;

      $this->assertTrue($this->response->isOk());
    }

    /**
     * Teste com descrição e títulos ordenados de forma
     * descendente que deve executar ok
     * @return void
     */
    public function testFilterWithDescriptionTitleWithSortDesc()
    {
      $data = array(
        'title' => 'Garçom',
        'description' => 'clientes',
        'sort' => 'desc'
      );

      $this->response = $this->call('POST', '/api/vaga', $data);
      $this->assertJson($this->response->getContent());

      $data = json_decode($this->response->getContent(), true);

      foreach($data as $hasKey) :
        $this->assertArrayHasKey('title', $hasKey);
        $this->assertArrayHasKey('description', $hasKey);
        $this->assertArrayHasKey('salario', $hasKey);
        $this->assertArrayHasKey('cidade', $hasKey);
        $this->assertArrayHasKey('cidadeFormated', $hasKey);
      endforeach;

      $this->assertTrue($this->response->isOk());
    }

    /**
     * Teste com atributos que não existem que
     * deve executar status code 404
     * @return void
     */
    public function testWithAttributesThatDontExists()
    {
      $data = array(
        'atributo_nao_existente' => 08498498489,
        'segundo_atributo_nao_existente' => 'lorem ipsum'
      );

      $this->response = $this->call('POST', '/api/vaga', $data);
      $this->assertJson($this->response->getContent());
      $this->assertEquals(404,$this->response->getStatusCode());
    }

    /**
     * Teste com atributos existentes e outros que não existem que deve
     * retornar com os dados referentes aos atributos
     * @return void
     */
    public function testFilterWithAttributesThatDontExistsWithSomeOthers()
    {
      $data = array(
        'title' => 'Garçom',
        'description' => 'clientes',
        'atributo_nao_existente' => 08498498489,
        'segundo_atributo_nao_existente' => 'lorem ipsum',
        'sort' => 'desc',
      );

      $this->response = $this->call('POST', '/api/vaga', $data);
      $this->assertJson($this->response->getContent());

      $data = json_decode($this->response->getContent(), true);

      foreach($data as $hasKey) :
        $this->assertArrayHasKey('title', $hasKey);
        $this->assertArrayHasKey('description', $hasKey);
        $this->assertArrayHasKey('salario', $hasKey);
        $this->assertArrayHasKey('cidade', $hasKey);
        $this->assertArrayHasKey('cidadeFormated', $hasKey);
      endforeach;

      $this->assertTrue($this->response->isOk());
    }

    /**
     * Teste que deve executar status code 400 para POST sem atributos
     * @return void
     */
    public function testWithNoAttributes()
    {
      $data = array();
      $this->response = $this->call('POST', '/api/vaga', $data);
      $this->assertJson($this->response->getContent());
      $this->assertEquals(400,$this->response->getStatusCode());
    }
}
