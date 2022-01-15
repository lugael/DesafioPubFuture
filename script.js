function iniciaModal(modalID) {
  const modal = document.getElementById(modalID);
  modal.classList.add('mostrar');
  modal.addEventListener('click',(e) => {
    if(e.target.id == modalID || e.target.className == 'fechar' || e.target.className == 'salvar'){
      modal.classList.remove('mostrar');
    }
  })
}

function salvarf() {
  const modal = document.getElementById('modal-adc');
  var tipo_de_renda = document.getElementById('tiporenda').value;
  var conta_deposito = document.getElementById('contaDepositada').value;
  var data_recebimento = document.getElementById('dataRecebimento').value;
  var descricao = document.getElementById('descricaoRenda').value;
  var valor_renda = document.getElementById('valorRenda').value;
  var data_esperada = document.getElementById('dataEsperado').value;

  var request = $.ajax ({
    url:"ini.php",
    type:"POST",
    data:{
      tipo_de_renda: tipo_de_renda,
      conta_deposito:conta_deposito,
      data_recebimento: data_recebimento,
      descricao: descricao,
      valor_renda: valor_renda,
      data_esperada: data_esperada,
    },
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
  modal.classList.remove('mostrar');

}
