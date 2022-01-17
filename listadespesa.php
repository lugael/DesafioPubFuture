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

$dados_despesa = "SELECT * FROM despesa ORDER BY id ";
$lista_despesa = mysqli_query($conn, $dados_despesa);
if(($lista_despesa) and ($lista_despesa->num_rows != 0)){
	while ($row_despesa = mysqli_fetch_assoc($lista_despesa)) {
		$html .= '<tr>:';
		$html .= '<td>' . $row_despesa['id'] . '</td>';
		$html .= '<td>' . $row_despesa['conta_desconto'] . '</td>';
		$html .= '<td>' . $row_despesa['valor_despesa'] . '</td>';
		$html .= '<td>' . $row_despesa['tipo_de_despesa'] . '</td>';
		$html .= '<td>' . $row_despesa['data_pagamento'] . '</td>';
		$html .= '<td>' . $row_despesa['data_vecimento'] . '</td>';
		$html .= '<td><button id="'.$row_despesa['id'].'" onclick="abre_despesa(\'A\','.$row_despesa['id'].')">Editar</button></td>';
		$html .= '<td><button id="'.$row_despesa['id'].'" onclick="remover_despesa(\'E\','.$row_despesa['id'].')">Remover</button></td>';
		$html .= '</tr>';

	}
	echo json_encode($html);


}else{
	echo "nenhum dado encontrado";
}
?>
