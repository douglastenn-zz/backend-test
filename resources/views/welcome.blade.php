<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Backend Test</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  </head>
  <style media="screen">
    body {
      font-family: 'Roboto', sans-serif;
    }
    .center {
      margin: 0 auto;
      width: 50%;
    }
    p.center {
      text-align: center;
      padding: 10px;
    }
    li {
      padding: 5px;
    }

    label {
      font-size: 20px;
      display: block;
    }
    input, select {
      font-size: 20px;
      width: 80%;
      padding: 0.3em;
      border: 1px solid black;
      margin: 15px 0;
      box-shadow: none;
    }
  </style>
  <body>
    <p class="center">
      <a href="http://www.catho.com.br">
          <img src="http://static.catho.com.br/svg/site/logoCathoB2c.svg" alt="Catho"/>
      </a>
    </p>
    <div class="center">
      <p class="center">
        O projeto está sendo executado!
      </p>
      <h2>Notas</h2>
      <ul>
        <li>Os testes se encontrão em <span>/tests</span>, o principal caso de teste atualmente é o <strong>VagaTest.php</strong>.</li>
        <li>Os controllers da aplicação se encontra no caminho <span>app/Http/Controllers</span>, o principal controller é o <strong>VagaController.php</strong>.</li>
        <li>As rotas estão em <span>app/Http/routes.php</span>.</li>
        <li>Dependências do projeto estão configurados no <strong>composer.json</strong>.</li>
        <li>Os códigos estão comentados.</li>
      </ul>


      <h2>Rotas</h2>

      <ul>
        <li>
            <strong>[GET] - /api/vaga</strong>
            <ul>
              <li>Para encontrar todas as vagas.</li>
            </ul>
        </li>

        <li>
            <strong>[GET] - /api/vaga/{texto}</strong>
            <ul>
              <li>Para encontrar vagas através dos atributos (title, description).</li>
            </ul>
        </li>

        <li>
            <strong>[POST] - /api/vaga</strong>
            <ul>
              <li>Para filtrar através dos atributos (title, description, cidade).</li>
              <li>Para ordenar através do atributo sort com os valores (asc ou desc).</li>
            </ul>
        </li>
      </ul>
    </div>

  </body>
</html>
