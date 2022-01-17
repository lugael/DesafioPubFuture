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
  var conta_desconto = document.getElementById('conta_desconto').value;
  var valor_despesa = document.getElementById('valor_despesa').value;
  var tipo_de_despesa = document.getElementById('tipo_de_despesa').value;
  var data_pagamento = document.getElementById('data_pagamento').value;
  var data_vecimento = document.getElementById('data_vecimento').value;

  var request = $.ajax ({
    url:"despesa.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      conta_desconto: conta_desconto,
      valor_despesa:valor_despesa,
      tipo_de_despesa: tipo_de_despesa,
      data_pagamento: data_pagamento,
      data_vecimento: data_vecimento,

    },
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");
    montagrid_despesa()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
  modal.classList.remove('mostrar');

}

function montagrid_despesa(){
    $.ajax ({
    url:"listadespesa.php",
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

$(document).ready(function () {
  montagrid_despesa()


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

function abre_despesa(aux_op, id) {

  $("#aux_op").val('A');

  carrega_dados(id);
  abre_modal(aux_op, 'modal-edi');
}

function carrega_dados(id) {
    $.ajax ({
      url:"despesa.php",
      type:"POST",
      datatype:"json",
      data: {
        aux_op: 'carrega_dados',
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        console.log(data.valor_despesa);
        $("#edi_conta_desconto").val(data.conta_desconto);
        $("#edi_valor_despesa").val(data.valor_despesa);
        $("#edi_tipo_de_despesa").val(data.tipo_de_despesa);
        $("#edi_data_pagamento").val(data.data_pagamento);
        $("#edi_data_vecimento").val(data.data_vecimento);
        $("#id").val(id);
      },
      async: true
    });
}
function salvaredicao() {
  var conta_desconto = document.getElementById('edi_conta_desconto').value;
  var valor_despesa = document.getElementById('edi_valor_despesa').value;
  var tipo_de_despesa = document.getElementById('edi_tipo_de_despesa').value;
  var data_pagamento = document.getElementById('edi_data_pagamento').value;
  var data_vecimento = document.getElementById('edi_data_vecimento').value;

  var request = $.ajax ({
    url:"despesa.php",
    type:"POST",
    data:{
      aux_op: $("#aux_op").val(),
      conta_desconto: conta_desconto,
      valor_despesa:valor_despesa,
      tipo_de_despesa: tipo_de_despesa,
      data_pagamento: data_pagamento,
      data_vecimento: data_vecimento,
      id: $("#id").val()
    },
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");
    montagrid_despesa()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
 fecha_modal('modal-edi');

}
function remover_despesa(aux_op, id) {
  $.ajax ({
    url:"despesa.php",
    type:"POST",
    datatype:"json",
    data: {
    id: id,
    aux_op: 'E'
},
    datatype:"json",
  }).done(function(resposta) {
    console.log("resposta");
    montagrid_despesa()

  }).fail(function(jqXHR, textStatus){
    console.log("request failed:" + textStatus);

  }).always(function() {
    console.log("Completo");
  });
}
