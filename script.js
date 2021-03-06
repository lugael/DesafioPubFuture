function iniciaModal(modalID) {
  const modal = document.getElementById(modalID);
  $("#aux_op").val('I');
  modal.classList.add('mostrar');
  modal.addEventListener('click',(e) => {
    if(e.target.id == modalID || e.target.className == 'fechar' || e.target.className == 'salvar'){
      fecha_modal(modalID)
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
      aux_op: $("#aux_op").val(),
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
    montagrid()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
  modal.classList.remove('mostrar');

}
function montagrid(){
    $.ajax ({
    url:"lista.php",
    type:"GET",
    datatype: 'json',
    data:{
      aux_op: $("#aux_op").val()
    },
    success: function(data) {
      var data = JSON.parse(data)
      $("table > #conteudo").html('')
      $("table > #conteudo").append(data)
    },
    async: false
  })


};
$(document).ready(function () {
  montagrid()


});

function abre_modal(aux_op, id){
  $("#aux_op").val(aux_op);
  console.log("#"+id)
  $("#"+id).addClass('mostrar');
}

function fecha_modal(id){
  const modal = document.getElementById(id);
  $(modal).removeClass('mostrar');
}

function abre_renda(aux_op, id) {

  $("#aux_op").val('A');

  carrega_dados(id);
  abre_modal(aux_op, 'modal-edi');
}

function carrega_dados(id) {
    $.ajax ({
      url:"ini.php",
      type:"POST",
      datatype:"json",
      data: {
        aux_op: 'carrega_dados',
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        console.log(data.conta_deposito);
        $("#edi_tiporenda").val(data.tipo_de_renda);
        $("#edi_contaDepositada").val(data.conta_deposito);
        $("#edi_dataRecebimento").val(data.data_recebimento);
        $("#edi_descricaoRenda").val(data.descricao);
        $("#edi_valorRenda").val(data.valor_renda);
        $("#edi_dataEsperado").val(data.data_esperada);
        $("#id").val(id);
      },
      async: true
    });
}
function salvaredicao() {
  var tipo_de_renda = document.getElementById('edi_tiporenda').value;
  var conta_deposito = document.getElementById('edi_contaDepositada').value;
  var data_recebimento = document.getElementById('edi_dataRecebimento').value;
  var descricao = document.getElementById('edi_descricaoRenda').value;
  var valor_renda = document.getElementById('edi_valorRenda').value;
  var data_esperada = document.getElementById('edi_dataEsperado').value;

  var request = $.ajax ({
    url:"ini.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      tipo_de_renda: tipo_de_renda,
      conta_deposito:conta_deposito,
      data_recebimento: data_recebimento,
      descricao: descricao,
      valor_renda: valor_renda,
      data_esperada: data_esperada,
      id: $("#id").val()
    },
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");
    montagrid()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
 fecha_modal('modal-edi');

}
function remover_renda(aux_op, id) {
  $.ajax ({
    url:"ini.php",
    type:"POST",
    datatype:"json",
    data: {
    id: id,
    aux_op: 'E'
},
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");
    montagrid()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
}
function montagrid_despesa(){
    $.ajax ({
    url:"lista.php",
    type:"GET",
    datatype: 'json',
    data:{
      aux_op: $("#aux_op").val()
    },
    success: function(data) {
      var data = JSON.parse(data)
      $("table > #conteudo_depesa").html('')
      $("table > #conteudo_depesa").append(data)
    },
    async: false
  })


};
