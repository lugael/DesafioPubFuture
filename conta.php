<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pubfuture";
$aux_op = (isset($_POST['aux_op']) ? $_POST['aux_op'] : '' );
$id = (isset($_POST['id']) ? $_POST['id'] : '' );
$conta_nova = (isset($_POST['conta_nova']) ? $_POST['conta_nova'] : '' );
$valor_conta = (isset($_POST['valor_conta']) ? $_POST['valor_conta'] : '' );
$tipo_de_conta = (isset($_POST['tipo_de_conta']) ? $_POST['tipo_de_conta'] : '' );
$inst_financeira = (isset($_POST['inst_financeira']) ? $_POST['inst_financeira'] : '' );

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

switch ($aux_op) {
  case 'I':
      $sql = "INSERT INTO contas (
                  conta_nova, valor_conta, tipo_de_conta, inst_financeira, )
                  VALUES(
                    '{$conta_nova}',
                    '{$valor_conta}',
                    '{$tipo_de_conta}',
                    '{$inst_financeira}'
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
    $sql="UPDATE contas Set conta_nova = '$conta_nova',
            valor_conta = '$valor_conta',
            tipo_de_conta = '$tipo_de_conta',
            inst_financeira = '$inst_financeira'
             WHERE id = '$id'";
    var_dump($sql);
     if (mysqli_query($conn, $sql)) {
           echo "Record updated successfully";
     } else {
           echo "Error updating record: " . mysqli_error($conn);
    }
  break;
  case 'E':
      $sql = "DELETE FROM contas WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }

  break;
  default:

    $dados = [];

    $sql = "SELECT conta_nova,
                   valor_conta,
                   tipo_de_conta,
                   inst_financeira
              FROM contas
              WHERE id = $id";

    $query = $conn->query($sql);

    if(!empty($query)) {
      while ($row_conta = mysqli_fetch_assoc($query)) {
        $dados['conta_nova'] = $row_conta['conta_nova'];
        $dados['valor_conta'] = $row_conta['valor_conta'];
        $dados['tipo_de_conta'] = $row_conta['tipo_de_conta'];
        $dados['inst_financeira'] = $row_conta['inst_financeira'];

    	}
    }


    echo json_encode($dados);

  break;
}

$conn->close();

?>
