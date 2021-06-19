<?php
    session_start();

    $nome = $_POST['nome'];
    $tipo1 = $_POST['tipo1'];
    $tipo2 = $_POST['tipo2'];
    $tipo3 = "Não há";

    if(isset($_POST['tipo3'])){
        $tipo3 = $_POST['tipo3'];
    }
    $data_inicio = $_POST['dataInicioAtividade'];
    $data_fim = $_POST['dataFimAtividade'];
    $ch_total = $_POST['ch_total'];
    $descricao = $_POST['descricao'];
    $login = $_SESSION['login'];

    // Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../upload/';
 

// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 45; // 2Mb
 
// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'png', 'gif');
 
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = false;
 
// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
 
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
exit; // Para a execução do script
}
 
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
 
// Faz a verificação da extensão do arquivo
/*$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
echo "Por favor,Não envie arquivos com as seguintes extensões: jpg, png ou gif";
}*/
 
// Faz a verificação do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
echo "O arquivo enviado é muito grande, envie arquivos de até 15Mb.";
}
 
// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
$nome_final = time().'.jpg';
} else {
// Mantém o nome original do arquivo
$nome_final = $_FILES['arquivo']['name'];
    echo $nome_final;
}

$caminho = $_UP['pasta'] . $nome_final;


// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
echo "Upload efetuado com sucesso!";
echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "Não foi possível enviar o arquivo, tente novamente";
}
 
}
 

$link = mysqli_connect("127.0.0.1:3306", "root", "12345678", "bd_saas");

/*$str_insert = "select sp_add_atividade('$nome', '$descricao','$tipo1', '$tipo1', '$tipo3', '$data_inicio', '$data_fim', $ch_total, '$login', '$nome_final','$caminho')";*/

$str_insert = "insert into tb_atividade(nome_atividade, descricao_atividade, tipo_participacao_nv1, tipo_participacao_nv2, tipo_participacao_nv3, data_inicio, data_fim, ch_total_atividade, id_aluno, id_professor)
values('$nome', '$descricao', '$tipo1', '$tipo2', '$tipo3', '2020-01-01','2020-01-01' , $ch_total, '$login', 'bruno.aranda');";

$result = mysqli_query($link, $str_insert);


$st_sucesso = "sucesso";

    header('location: minhas-atividades.php?aviso='. $st_sucesso);

?>