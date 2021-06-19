<?php

session_start();// alocar memoria para cada navegador

$login = $_POST['email'];
$senha = $_POST['senha'];

$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");



$consulta = "select tipo_usuario FROM tb_aluno where login = '$login';";


$consulta_aluno = "select * from tb_aluno as aluno where aluno.login = '$login' and aluno.passworld = '$senha'";

$consulta_professor = "select * from tb_professor as prof where prof.login = '$login' and prof.passworld = '$senha'";

$result = mysqli_query($link, $consulta);

$tipo_usuario = mysqli_fetch_assoc($result);//é adiquiro o array com os dados do usuario caso exista



if($tipo_usuario['tipo_usuario'] == null){

    $consulta = "select tipo_usuario FROM tb_professor where login = '$login';";

    

    $result = mysqli_query($link, $consulta);

    $tipo_usuario = mysqli_fetch_assoc($result);//é adiquiro o array com os dados do usuario caso exista

    if ($tipo_usuario['tipo_usuario'] != "professor"){
        $tipo_usuario['tipo_usuario'] = "erro, não encontrado o usuario";
    }
    
}else{
   
    if ($tipo_usuario['tipo_usuario'] != "aluno"){
        $tipo_usuario['tipo_usuario'] = "erro, não encontrado o usuario";
    }
}

echo $tipo_usuario['tipo_usuario'];

if($tipo_usuario['tipo_usuario'] == null || $tipo_usuario['tipo_usuario'] == "erro, não encontrado o usuario"){
    header('location: ./tela_login/index.php?login=erro');
    
}else{
    if($tipo_usuario['tipo_usuario'] == 'aluno'){

        
        $result = mysqli_query($link, $consulta_aluno);
        echo $consulta_aluno;
        $dados_usuario = mysqli_fetch_assoc($result);//é adiquiro o array com os dados do usuario caso exista

        if($dados_usuario != false){
            $_SESSION['autenticado'] = 'SIM';
            foreach( $dados_usuario as $key => $val ) {
                if( is_array( $val ) ) {
                    $_SESSION[$key] = arrayCopy( $val );
                } elseif ( is_object( $val ) ) {
                    $_SESSION[$key] = clone $val;
                } else {
                    $_SESSION[$key] = $val;
                }
            }
            header('location: ./tela_aluno/index.php');
        }else{
            $_SESSION['autenticado'] = 'NÃO';
            header('location: ./tela_login/index.php?login=erro');
        }
        
        
    }
    if($tipo_usuario['tipo_usuario'] == 'professor'){
        
        $result_dados_usuario = mysqli_query($link, $consulta_professor);
        $dados_usuario = mysqli_fetch_assoc($result_dados_usuario);
        echo '<pre>';
        var_dump($dados_usuario);
        if($dados_usuario != false){
            $_SESSION['autenticado'] = 'SIM';
            foreach( $dados_usuario as $key => $val ) {
                if( is_array( $val ) ) {
                    $_SESSION[$key] = arrayCopy( $val );
                } elseif ( is_object( $val ) ) {
                    $_SESSION[$key] = clone $val;
                } else {
                    $_SESSION[$key] = $val;
                }
            }
            header('location: ./tela_professor/index.php');
        }else{
            $_SESSION['autenticado'] = 'NÃO';
            header('location: ./tela_login/index.php?login=erro');
        }
        
        
    }
}
?>
