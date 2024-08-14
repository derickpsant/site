<?php
    // Conexão com o banco de dados MySQL
    $nome = $_POST['nome'];
    $periodo = $_POST ['periodo'];
    $opcao = $_POST ['opcao'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "alimentobd";

     // Verifica se o campo 'nome' não está vazio
     if (empty($nome)) {
        die("Erro: O campo 'nome' não pode estar vazio.");
    }

    $conexao = mysqli_connect($servername, $username, $password, $dbname);


    // Verifica a conexão
    if (!$conexao) {
        die("Erro de conexão: " . mysqli_connect_error());
    }

    // Prepara a consulta SQL usando prepared statements
    $stmt = mysqli_prepare($conexao, "INSERT INTO votacao (nome, periodo, opcao) VALUES (?, ?, ?)");
    $sql = "SELECT COUNT(*) AS total_votos_sim FROM votacao WHERE opcao = 'sim'";
    $sql = "SELECT COUNT(*) AS total_votos_nao FROM votacao WHERE opcao = 'não'";
    
    // Vincula os parâmetros e executa a consulta
    mysqli_stmt_bind_param($stmt, "sss", $nome, $periodo, $opcao);
    $resultado = mysqli_stmt_execute($stmt);


    // Fecha a instrução e a conexão
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="logoetec.ico" type="image/x-icon">
        <title>Alimentoconsciente.com</title>
        <link rel="stylesheet" type="text/css" href="./css/index_php.css"/>
    </head>
    <body>
       <div class="linha">      <!-- HORARIO E ALERTAS -->
            <div id="dvlghr" class="col-lg-12 ">
                <p id="dataAtual"></p>

                <script>
                // Função para obter o dia da semana, o mês escrito, a data e o ano atuais
                function atualizarDataHora() {
                var diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
                var meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
                
                var dataAtual = new Date();
                var diaSemana = diasSemana[dataAtual.getDay()];
                var mes = meses[dataAtual.getMonth()];
                var data = dataAtual.getDate();
                var ano = dataAtual.getFullYear();
                
                // Construir a string com as informações obtidas
                var dataFormatada = diaSemana + ", " + mes + " " + data + ", " + ano;
                
                // Atualizar o conteúdo do elemento HTML com o ID 'dataAtual' com a data formatada
                document.getElementById('dataAtual').innerHTML = dataFormatada;
                }
                
                // Chamar a função inicialmente para exibir a data atual
                atualizarDataHora();
                </script>
            </div>
       </div>

       <div class="linha">      <!-- LOGO -->
            <div id="dvlogo" class="col-lg-1">
                &nbsp;
            </div>

            <div id="dvlogo" class="col-lg-5 centro">
                <img src="./images/eteclogo.png"  alt="Logo Etec" id="logopng">
            </div>
            <div id="dvlogo" class="col-lg-5 centro">
                <img src="./images/logo_cps_gov_transparente.png"  alt="logo cps e gov" id="logopng2">
            </div>

            <div id="dvlogo" class="col-lg-1">
                &nbsp;
            </div>
       </div>

        <div class="linha">      <!-- Line Vermelha -->
            <div id="dvline" class="col-lg-12 " >
                &nbsp;
            </div>
        </div class="linha">
            <div id="dvtitulo" class="col-lg-12 coramarelo centro">
                NÃO AO DESPERDÍCIO ALIMENTAR
            </div>
        </div>
       
         <div class="menu-wrapper">
            <div class="dropdown">
                <button class="dropbtn"><img src="images/Horizontal-Line-Transparent.png" height="20px" width="25px" ></button>
                <div class="dropdown-content">
                <a href="history.html">Contexto</a> 
                    <a href="qsmos.html">Quem Somos</a>
                    <a href="index.html">Formulário</a>
                    <a href="updt_vt.html">Relatório votos</a>
                </div>
            </div>
        </div>

       <div class="linha">      <!-- Conteudo -->
            <div id="dvconteudo" class="col-lg-1 ">
                &nbsp;
            </div>

            <div id="dvconteudo" class="col-lg-10 centro justificado topo">
            <img src="images/cardapioteste.PNG" alt="Cardápio">
                <form action="index.html">
                    <p>
                        <?php
                            if ($resultado) {
                                echo "VOTO REGISTRADO COM SUCESSO !";
                            } else {
                                echo "Erro ao registrar o voto: " . mysqli_error($conexao);
                            }
                        ?>
                        
                    </p>
                    <br>
                    <img src="images/tick-verify.gif" height="250" width="250" style="border-radius: 50%;" alt="gif">
                    <br>
                    <br>
                    
                    <button type="submit">VOLTE PARA O FORMULÁRIO </button>
                    
                </form>
            </div>
            
            <div id="dvconteudo" class="col-lg-1 ">
                &nbsp;
            </div>
        </div>

        <div class="linha">      <!-- Logos | Endereço | Contatos  -->
            <div id="dvmdcc" class="col-lg-2">
                &nbsp;
            </div>
            <div id="dvmdcc" class="col-lg-4">
                <img src="images/logo_baixo_nengue.png" alt="etec" id="imgcopy">
            </div>
            <div id="dvmdcc" class="col-lg-3">
                <p>
                    Endereço
                    <hr>
                </p>
                <p>
                    Avenida Benedito Lázaro Vieira, S/Nº<br>
                    Santo Antônio - Monte Mor/SP CEP: 13.190-120
                </p>
                
            </div>
            <div id="dvmdcc" class="col-lg-3">
                <p>
                    Contatos
                    <hr>
                </p>
                <p>
                    (19) 3879-6518<br>
                    (19) 3879-6515<br>
                    e198.atendimento@etec.sp.gov.br
                </p>
            </div>
       </div>

       <div class="linha">      <!-- Copyrigh Baixo Nengué | Tema --> 
            <div id="dvcopyt" class="col-lg-2 ">
                &nbsp;
            </div>
            <div id="dvcopyt" class="col-lg-10">
                <p>
                    Copyright &copy; 2024 Etec de Monte Mor. Todos os direitos reservados.
                </p>
                <p>
                    Tema: Desenvolvimento De Software Para Minimizar Desperdício Alimentar Na Merenda Escola Da Etec Monte Mor.
                </p>
            </div>
        </div> 
    </body>
</html>