<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pubfuture";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$html = '';

$dados_conta = "SELECT * FROM contas ORDER BY id ";
$lista_conta = mysqli_query($conn, $dados_conta);
if(($lista_conta) and ($lista_conta->num_rows != 0)){
	while ($row_conta = mysqli_fetch_assoc($lista_conta)) {
		$html .= '<tr>:';
		$html .= '<td>' . $row_conta['id'] . '</td>';
		$html .= '<td>' . $row_conta['conta_nova'] . '</td>';
		$html .= '<td>' . $row_conta['valor_conta'] . '</td>';
		$html .= '<td>' . $row_conta['tipo_de_conta'] . '</td>';
		$html .= '<td>' . $row_conta['inst_financeira'] . '</td>';
		$html .= '<td><button id="'.$row_conta['id'].'" onclick="abre_conta(\'A\','.$row_conta['id'].')">Editar</button></td>';
		$html .= '<td><button id="'.$row_conta['id'].'" onclick="remover_conta(\'E\','.$row_conta['id'].')">Remover</button></td>';
		$html .= '</tr>';

	}
	echo json_encode($html);


}else{
	echo "nenhum dado encontrado";
}
?>
