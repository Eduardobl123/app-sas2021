<?
    if(isset($_GET['tipo1'])){
        if(isset($_GET['tipo2'])){
            $link = mysqli_connect("127.0.0.1:3306", "root", "12345678", "bd_saas");
    
            $result = mysqli_query($link, "select DISTINCT tipo_participacao_nv3 from tb_categoria_atividade
            where tipo_participacao_nv1 = '".$_GET['tipo1']."'"." and tipo_participacao_nv2 = '".$_GET['tipo2']."'");
            $dado_tipo2 = mysqli_fetch_all($result);
           
            $array = array();
            foreach($dado_tipo2 as $vetor){
                foreach($vetor as $item){
                    $array[] = $item;
                 }
            }
    
            echo json_encode($array);

        }else{

            // $link = mysqli_connect("127.0.0.1:3306", "root", "12345678", "bd_saas");
            // // echo "select DISTINCT tipo_participacao_nv2 from tb_categoria_atividade where tipo_participacao_nv1 = '".$_GET['tipo1']."'";
            // $result = mysqli_query($link, "select DISTINCT tipo_participacao_nv2 from tb_categoria_atividade
            // where tipo_participacao_nv1 = '".$_GET['tipo1']."'");
            // print($result);
            // $dado_tipo2 = mysqli_fetch_row($result);
            // var_dump($dado_tipo2);
            // $array = array();
            // foreach($dado_tipo2 as $vetor){
            //     foreach($vetor as $item){
            //         $array[] = $item;
            //      }
            // }

            /* Open a connection */

            $mysqli = new mysqli("127.0.0.1:3306", "root", "12345678", "bd_saas");

            /* check connection */ 
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }

            $query = "select DISTINCT tipo_participacao_nv2 from tb_categoria_atividade
            where tipo_participacao_nv1 = '".$_GET['tipo1']."';";
            $array = array();
            /* execute multi query */
            if ($mysqli->multi_query($query)) {
                do {
                    /* store first result set */
                    if ($result = $mysqli->store_result()) {
                        while ($row = $result->fetch_row()) {
                            $array[] = $row;
                        }
                        $result->free();
                    }
                    /* print divider */
                    if ($mysqli->more_results()) {
                        
                    }
                } while ($mysqli->next_result());
            }

            /* close connection */
            $mysqli->close();
            echo json_encode($array);
        }
        
    }

?>