<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "renda";
$tipo_de_renda = $_POST['tipo_de_renda'];
$conta_deposito = $_POST['conta_deposito'];
$data_recebimento = $_POST['data_recebimento'];
$descricao = $_POST['descricao'];
$valor_renda = $_POST['valor_renda'];
$data_esperada = $_POST['data_esperada'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}




$sql = "INSERT INTO renda (
            tipo_de_renda, conta_depositova, data_recebimento, descricao, valor_renda, data_esperada)
            VALUES(
              '{$tipo_de_renda}',
              '{$conta_deposito}',
              '{$data_recebimento}',
              '{$descricao}',
              '{$valor_renda}',
              '{$data_esperada}',
              )";
              if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                echo "New record created successfully. Last inserted ID is: " . $last_id;
}

              else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// mysqli_query($conn, $query);
// mysqli_close($conn);

?>
