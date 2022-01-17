<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pubfuture";
$aux_op = (isset($_POST['aux_op']) ? $_POST['aux_op'] : '' );
$id = (isset($_POST['id']) ? $_POST['id'] : '' );
$conta_desconto = (isset($_POST['conta_desconto']) ? $_POST['conta_desconto'] : '' );
$valor_despesa = (isset($_POST['valor_despesa']) ? $_POST['valor_despesa'] : '' );
$tipo_de_despesa = (isset($_POST['tipo_de_despesa']) ? $_POST['tipo_de_despesa'] : '' );
$data_pagamento = (isset($_POST['data_pagamento']) ? $_POST['data_pagamento'] : '' );
$data_vecimento = (isset($_POST['data_vecimento']) ? $_POST['data_vecimento'] : '' );


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

switch ($aux_op) {
  case 'I':
      $sql = "INSERT INTO despesa (
                  conta_desconto, valor_despesa, tipo_de_despesa, data_pagamento, data_vecimento)
                  VALUES(
                    '{$conta_desconto}',
                    '{$valor_despesa}',
                    '{$tipo_de_despesa}',
                    '{$data_pagamento}',
                    '{$data_vecimento}'
                    )";
                    if ($conn->query($sql) === TRUE) {
                      $last_id = $conn->insert_id;
                      echo "New record created successfully. Last inserted ID is: " . $last_id;
      }

                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  break;
  case 'A':
    $sql="UPDATE despesa Set conta_desconto = '$conta_desconto',
            valor_despesa = '$valor_despesa',
            tipo_de_despesa = '$tipo_de_despesa',
            data_pagamento = '$data_pagamento',
            data_vecimento = '$data_vecimento'
             WHERE id = '$id'";
    var_dump($sql);
     if (mysqli_query($conn, $sql)) {
           echo "Record updated successfully";
     } else {
           echo "Error updating record: " . mysqli_error($conn);
    }
  break;
  case 'E':
      $sql = "DELETE FROM despesa WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }

  break;
  default:

    $dados = [];

    $sql = "SELECT conta_desconto,
                   valor_despesa,
                   tipo_de_despesa,
                   data_pagamento,
                   data_vecimento
              FROM despesa
              WHERE id = $id";

    $query = $conn->query($sql);

    if(!empty($query)) {
      while ($row_despesa = mysqli_fetch_assoc($query)) {
        $dados['conta_desconto'] = $row_despesa['conta_desconto'];
        $dados['valor_despesa'] = $row_despesa['valor_despesa'];
        $dados['tipo_de_despesa'] = $row_despesa['tipo_de_despesa'];
        $dados['data_pagamento'] = $row_despesa['data_pagamento'];
        $dados['data_vecimento'] = $row_despesa['data_vecimento'];


    	}
    }


    echo json_encode($dados);

  break;
}

$conn->close();

?>
