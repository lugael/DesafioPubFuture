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

$dados_renda = "SELECT * FROM renda ORDER BY id ";
$lista_renda = mysqli_query($conn, $dados_renda);
if(($lista_renda) and ($lista_renda->num_rows != 0)){
	while ($row_renda = mysqli_fetch_assoc($lista_renda)) {
		$html .= '<tr>:';
		$html .= '<td>' . $row_renda['id'] . '</td>';
		$html .= '<td>' . $row_renda['conta_depositova'] . '</td>';
		$html .= '<td>' . $row_renda['valor_renda'] . '</td>';
		$html .= '<td>' . $row_renda['tipo_de_renda'] . '</td>';
		$html .= '<td>' . $row_renda['descricao'] . '</td>';
		$html .= '<td>' . $row_renda['data_recebimento'] . '</td>';
		$html .= '<td>' . $row_renda['data_esperada'] . '</td>';
		$html .= '<td><button id="'.$row_renda['id'].'" onclick="abre_renda(\'A\','.$row_renda['id'].')">Editar</button></td>';
		$html .= '<td><button id="'.$row_renda['id'].'" onclick="remover_renda(\'E\','.$row_renda['id'].')">Remover</button></td>';
		$html .= '</tr>';

	}
	echo json_encode($html);

}else{
	echo "nenhum dado encontrado";
}
?>
