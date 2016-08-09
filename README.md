<p align="center">
  <a href="http://www.catho.com.br">
      <img src="http://static.catho.com.br/svg/site/logoCathoB2c.svg" alt="Catho"/>
  </a>
</p>
---
# Solução

#### Instalação

Para a solução deste problema escolhi o micro-framework **[Lumen](https://lumen.laravel.com/)** com testes unitários no **[PHPUnit](https://phpunit.de/)**.

Requisitos para executar o projeto:
- Composer (gerenciador de dependências do php) - *[Instalação](https://getcomposer.org/doc/00-intro.md#manual-installation)*
- PHPUnit (para executar os testes unitários) - *[Instalação](https://phpunit.de/manual/current/pt_br/installation.html)*
- PHP >=5.5.9 - *[Instalação](http://php.net/downloads.php)*

Após clonar esse projeto, é necessário apontar o servidor web para o caminho da aplicação no caso */caminho/backend-test/public* onde será inicializado o arquivo **index.php**.

Para instalar as dependências do projeto *(lumen/phpunit)*, é necessário executar o comando do composer abaixo:
```
composer install
```
Para executar os testes unitários, é preciso usar o comando abaixo:
```
phpunit
```
#### Notas

- Os testes se encontrão em */tests*, o principal caso de teste atualmente é o **VagaTest.php**.
- Os controllers da aplicação se encontra no caminho *app/Http/Controllers*, o principal controller é o **VagaController.php**.
- As rotas estão em *app/Http/routes.php*.
- Dependências do projeto estão configurados no **composer.json**.
- Os códigos estão comentados.

#### Rotas

-  **[GET] - /api/vaga**
    -  Para encontrar todas as vagas.
-  **[GET] - /api/vaga/{texto}**
   - Para encontrar vagas através dos atributos (title, description).
-  **[POST] - /api/vaga**
    - Para filtrar através dos atributos (title, description, cidade).
    - Para ordenar através do atributo sort com os valores (asc ou desc).

Para ajudar:
- Segue abaixo link do **[postman](https://www.getpostman.com/)** com uma coleção com as rotas para realizar os testes.
https://www.getpostman.com/collections/da3e3eba575499f379fb

---
# Problema: backend-test

Uma pessoa esta a procura de emprego e dentre as várias vagas que existem no mercado (disponibilizadas nesse <a href="https://github.com/catho/backend-test/blob/master/vagas.json">JSON</a>) e ela quer encontrar vagas que estejam de acordo com o que ela saiba fazer, seja direto pelo cargo ou atribuições que podem ser encontradas na descrição das vagas. Para atender essa necessidade precisamos:

- uma API simples p/ procurar vagas (um GET p/ procurar as vagas no .json disponibilizado);
- deve ser possível procurar vagas por texto (no atributos title e description);
- deve ser possível procurar vagas por uma cidade;
- deve ser possível ordenar o resultado pelo salário (asc e desc);

O teste deve ser feito utilizando PHP (com ou sem framework, a escolha é sua). Esperamos como retorno, fora o GET da API funcionando, os seguintes itens:

- uma explicação do que é necessário para fazer seu projeto funcionar;
- como executar os testes, se forem testes de unidade melhor ainda;
- comentários nos códigos para nos explicar o que está sendo feito.

Lembre-se que na hora da avaliação olharemos para:

- organização de código;
- desempenho;
- manutenabilidade.
