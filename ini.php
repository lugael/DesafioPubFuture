<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pubfuture";
$aux_op = (isset($_POST['aux_op']) ? $_POST['aux_op'] : '' );
$id = (isset($_POST['id']) ? $_POST['id'] : '' );
$tipo_de_renda = (isset($_POST['tipo_de_renda']) ? $_POST['tipo_de_renda'] : '' );
$conta_deposito = (isset($_POST['conta_deposito']) ? $_POST['conta_deposito'] : '' );
$data_recebimento = (isset($_POST['data_recebimento']) ? $_POST['data_recebimento'] : '' );
$descricao = (isset($_POST['descricao']) ? $_POST['descricao'] : '' );
$valor_renda = (isset($_POST['valor_renda']) ? $_POST['valor_renda'] : '' );
$data_esperada = (isset($_POST['data_esperada']) ? $_POST['data_esperada'] : '' );


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

switch ($aux_op) {
  case 'I':
      $sql = "INSERT INTO renda (
                  tipo_de_renda, conta_depositova, data_recebimento, descricao, valor_renda, data_esperada)
                  VALUES(
                    '{$tipo_de_renda}',
                    '{$conta_deposito}',
                    '{$data_recebimento}',
                    '{$descricao}',
                    '{$valor_renda}',
                    '{$data_esperada}'
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
    $sql="UPDATE renda Set tipo_de_renda = '$tipo_de_renda',
            conta_depositova = '$conta_deposito',
            data_recebimento = '$data_recebimento',
            descricao = '$descricao',
            valor_renda = '$valor_renda',
            data_esperada = '$data_esperada'
             WHERE id = '$id'";
    var_dump($sql);
     if (mysqli_query($conn, $sql)) {
           echo "Record updated successfully";
     } else {
           echo "Error updating record: " . mysqli_error($conn);
    }
  break;
  case 'E':
      $sql = "DELETE FROM renda WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }

  break;
  default:

    $dados = [];

    $sql = "SELECT tipo_de_renda,
                   conta_depositova,
                   data_recebimento,
                   descricao,
                   valor_renda,
                   data_esperada
              FROM renda
              WHERE id = $id";

    $query = $conn->query($sql);

    if(!empty($query)) {
      while ($row_renda = mysqli_fetch_assoc($query)) {
        $dados['tipo_de_renda'] = $row_renda['tipo_de_renda'];
        $dados['conta_deposito'] = $row_renda['conta_depositova'];
        $dados['data_recebimento'] = $row_renda['data_recebimento'];
        $dados['descricao'] = $row_renda['descricao'];
        $dados['valor_renda'] = $row_renda['valor_renda'];
        $dados['data_esperada'] = $row_renda['data_esperada'];

    	}
    }


    echo json_encode($dados);

  break;
}

$conn->close();

// mysqli_query($conn, $query);
// mysqli_close($conn);

?>
