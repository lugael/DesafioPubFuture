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
  var conta_nova = document.getElementById('conta_nova').value;
  var valor_conta = document.getElementById('valor_conta').value;
  var tipo_de_conta = document.getElementById('tipo_de_conta').value;
  var inst_financeira = document.getElementById('inst_financeira').value;


  var request = $.ajax ({
    url:"conta.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      conta_nova: conta_nova,
      valor_conta: valor_conta,
      tipo_de_conta: tipo_de_conta,
      inst_financeira: inst_financeira
    },
    datatype:"json",
  }).done(function(resposta) {
    montagrid_conta()

  }).fail(function(jqXHR, textStatus){


  }).always(function() {

  });
  modal.classList.remove('mostrar');

}

function montagrid_conta(){
    $.ajax ({
    url:"listaconta.php",
    type:"GET",
    datatype: 'json',
    data:{
      aux_op: $("#aux_op").val()
    },
    success: function(data) {
      var data = JSON.parse(data)
      $("table > #conteudo_conta").html('')
      $("table > #conteudo_conta").append(data)
    },
    async: false
  })


};

$(document).ready(function () {
  montagrid_conta()


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

function abre_conta(aux_op, id) {

  $("#aux_op").val('A');

  carrega_dados(id);
  abre_modal(aux_op, 'modal-edi');
}

function carrega_dados(id) {
    $.ajax ({
      url:"conta.php",
      type:"POST",
      datatype:"json",
      data: {
        aux_op: 'carrega_dados',
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        $("#edi_conta_nova").val(data.conta_nova);
        $("#edi_valor_conta").val(data.valor_conta);
        $("#edi_tipo_de_conta").val(data.tipo_de_conta);
        $("#edi_inst_financeira").val(data.inst_financeira);
        $("#id").val(id);
      },
      async: true
    });
}
function salvaredicao() {
  var conta_nova = document.getElementById('edi_conta_nova').value;
  var valor_conta = document.getElementById('edi_valor_conta').value;
  var tipo_de_conta = document.getElementById('edi_tipo_de_conta').value;
  var inst_financeira = document.getElementById('edi_inst_financeira').value;


  var request = $.ajax ({
    url:"conta.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      conta_nova: conta_nova,
      valor_conta:valor_conta,
      tipo_de_conta: tipo_de_conta,
      inst_financeira: inst_financeira,
      id: $("#id").val()
    },
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");
    montagrid_conta()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
 fecha_modal('modal-edi');

}
function remover_conta(aux_op, id) {
  $.ajax ({
    url:"conta.php",
    type:"POST",
    datatype:"json",
    data: {
    id: id,
    aux_op: 'E'
},
    datatype:"json",
  }).done(function(resposta) {
    montagrid_conta()

  }).fail(function(jqXHR, textStatus){


  }).always(function() {

  });
}
