<?php

  session_start();
  if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM' || $_SESSION['tipo_usuario'] != 'aluno'){
    header('Location: ../tela_login/index.php?login=erro2');
  }

?>