<?php
$erroNome="";
$erroEmail="";
$erroSenha="";
$erroRepeteSenha="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //VALIDAÇÃO DE NOME
        //verificar se esta vazio o post nome
        if(empty($_POST['nome'])){
            $erroNome="Por favor preencha um nome";
        }else{
            //pega o valor do post e limpa
            $nome=limpaPost($_POST['nome']);
            //verifica os caracteris do post
            if(!preg_match("/^[a-zA-Z-' ]*$/",$nome)){
                $erroNome="Apenas aceitamos letras e espaços em branco";
            }

        }
        //VALIDAÇÃO E-MAIL
        if(empty($_POST['email'])){
            $erroEmail="Por favor informe um email.";
        }else{
            $email=limpaPost($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $erroEmail="Email invalido";
            }
        }
        //VALIDAÇÃO SENHA
        if(empty($_POST['senha'])){
            $erroSenha="Por favor informe um senha.";
        }else{
            $senha=limpaPost($_POST['senha']);
            if(strlen($senha)<6){
                $erroSenha="A senha tem que ter no minimo 6 digitos";
            }
        }
        //VALIDAÇAO REPETE SENHA
        if(empty($_POST['repeteSenha'])){
            $erroRepeteSenha="Por favor informe a repetição da senha";
        }else{
            $repeteSenha=limpaPost($_POST['repeteSenha']);
            if($repeteSenha !== $senha){
                $erroRepeteSenha="O repete senha esta diferente do repete senha.";
            }
        }
        if(($erroEmail=="")&&($erroNome=="")&&($erroSenha=="")&&($erroRepeteSenha=="")){
            header('Location: final.php');
        }
    }
    function limpaPost($valor){
        $valor= trim($valor);
        $valor= htmlspecialchars($valor);
        $valor= stripcslashes($valor);
        return $valor;
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validaçao de Formulario</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <h1>Validação de Formulário</span></h1>
        <span class="erro"></span>
        <form action="" method="post">

            <!--NOME COMPLETO-->
            <label for="nome">Nome Completo</label>
            <input type="text" name="nome" id="nome" <?php if(!empty($erroNome)){ echo "class='invalido'";}?> <?php if(isset($_POST['nome'])){ echo "value='".$_POST['nome']."'";} ?>placeholder="Digite seu nome">
            <br>
            <span class="erro"><?php echo $erroNome ?></span>

            <!--EMAIL-->    
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" <?php if(!empty($erroEmail)){ echo "class='invalido'";}?> <?php if(isset($_POST['email'])){ echo "value='".$_POST['email']."'";} ?> placeholder="email@provedor.com">
            <br>
            <span class="erro"><?php echo $erroEmail ?></span>

            <!--SENHA-->
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" <?php if(!empty($erroSenha)){ echo "class='invalido'";}?> placeholder="Digite uma senha">
            <br>
            <span class="erro"><?php echo $erroSenha ?></span>

            <!--REPETE SENHA-->
            <label for="repiteSenha">Repite senha</label>
            <input type="password" name="repeteSenha" id="repeteSenha" <?php if(!empty($erroRepeteSenha)){ echo "class='invalido'";}?> placeholder="Repita a senha">
            <br>
            <span class="erro"><?php echo $erroRepeteSenha ?></span>

            <button type="submit">Enviar Formulário</button>
        </form>
    </main>
</body>
</html>