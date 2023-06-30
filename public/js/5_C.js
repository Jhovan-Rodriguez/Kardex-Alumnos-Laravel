$(document).ready(function() {
  $('.ui.dropdown').dropdown();
  $('.checkbox').checkbox().first().checkbox({
    onChecked: function() {
      $("#Otro").css("display","block");
      $('#OtroTipo').val("");
    },
    onUnchecked: function() {
      $("#Otro").css("display","none");
      $('#OtroTipo').val("1");
    }
  });

});

function reporte(curp) {
  $('#modalReporte').modal('setting', 'closable', false).modal('show');
  var valor =1;
  console.log(valor);
  $.ajax({
    type:'GET',
    url: '/infoalumno',
    data: {curp:curp,valor:valor},
    dataType:'json',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success:function(response) {
      console.log(response[1]);
      $('#Numero_Reporte').val("");
      $('#correoPadre').val(response[0].correo);
      $('#curp').val(response[0].CURP);
      if (response[1]==4) {
        $('#Numero_Reporte').val("Suspención");
        $('#validar').addClass('disabled');
        $('#suspencion').css('display','block');
        $('#causas').addClass('disabled');
        $('#checkbox').addClass('disabled');
      }else {
        $('#Numero_Reporte').val(response[1]);
      }
      // $('#Numero_Reporte').val(response[1]);
      $('#IdCorreoPadre').val(response[0].id_correo);
      $('#Nombre_Padre').val(response[0].Nombre_Padre);
      $('#NombreAlumno').val(response[0].Nombre);
      $('#Semestre').val(response[0].Nombre_Grupo);
      var fecha = new Date(); //Fecha actual
      var mes = fecha.getMonth()+1; //obteniendo mes
      var dia = fecha.getDate(); //obteniendo dia
      var ano = fecha.getFullYear(); //obteniendo año
      if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
      if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
      document.getElementById('fecha').value=ano+"-"+mes+"-"+dia;
    }
  });
}
function validacion() {
  $('#FormReporte')
  .form({
    on:'blur',
    fields: {
      Padre: {
        identifier: 'Nombre_Padre',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor insertar nombre del padre'
          }
        ]
      },
      NombreAlumno: {
        identifier: 'NombreAlumno',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor insertar nombre del alumno'
          }
        ]
      },
      Semestre: {
        identifier: 'Semestre',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor inserte el semestre del alumno'
          }
        ]
      },
      Numero_Reporte: {
        identifier: 'Numero_Reporte',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor inserte el numero de reporte del alumno'
          }
        ]
      },
      fecha: {
        identifier: 'fecha',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor ingrese una fecha'
          }
        ]
      },
      causas: {
        identifier: 'causas',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor seleccione una causa'
          }
        ]
      },
      OtroTipo: {
        identifier: 'OtroTipo',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor ingrese otra causa'
          }
        ]
      }
    },
    onSuccess:function() {
      var padre =$('#Nombre_Padre').val();
      var curp=$('#curp').val();
      var correopadre=$('#correoPadre').val();
      var id_correoPadre=$('#IdCorreoPadre').val();
      var nombre_alumno=$('#NombreAlumno').val();
      var semestre=$('#Semestre').val();
      var numero_reporte=$('#Numero_Reporte').val();
      var fecha=$('#fecha').val();
      var causas=$('#causas').val();
      var otra_causa=$('#OtroTipo').val();
      var arreglo=[padre,correopadre,id_correoPadre,nombre_alumno,semestre,numero_reporte,fecha,causas,curp];
      $('.ui.modal').modal('hide');
      $('#FormReporte')[0].reset();
      $('.text').html("Causas");
      $('#pdf').modal({
        closable  : false,
        onDeny    : function(){
          $('#pdf').modal('hide');
        },
        onApprove : function() {
        $('#Nomb_padre').val(padre);
        $('#curp_al').val(curp);
        $('#idcorreo_padre').val(id_correoPadre);
        $('#nomAlumno').val(nombre_alumno);
        $('#semes').val(semestre);
        $('#num_reporte').val(numero_reporte);
        $('#date').val(fecha);
        $('#cau').val(causas);
        $('#otra_cau').val(otra_causa);
        $('#submit').trigger('click');
        }
      }).modal('show');
      $.ajax({
        type:'GET',
        url: '/correo',
        data: {arreglo:arreglo,otra_causa:otra_causa},
        dataType:'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(response) {
          console.log(response);
        }
      });
    }
  }).submit(function(e) {
    e.preventDefault();
  });
}
function aduana() {
  console.log('llego');
  if ($('#OtroTipo').val()=="") {
    $('#OtroTipo').val("1");
  }
  console.log($('#OtroTipo').val());
  validacion();
  $('#FormReporte').submit();
}
function cancelar() {
  $('#FormReporte')[0].reset();
  $('.text').html("Causas");
  $('#suspencion').css('display','none');
  $('#causas').removeClass('disabled');
  $('#validar').removeClass('disabled');
  $('#checkbox').removeClass('disabled');
}
function suspencion() {
  var padre =$('#Nombre_Padre').val();
  var curp=$('#curp').val();
  var correopadre=$('#correoPadre').val();
  var id_correoPadre=$('#IdCorreoPadre').val();
  var nombre_alumno=$('#NombreAlumno').val();
  var semestre=$('#Semestre').val();
  var numero_reporte=$('#Numero_Reporte').val();
  var fecha=$('#fecha').val();
  var causas=$('#causas').val();
  var otra_causa=$('#OtroTipo').val();
  var arreglo=[padre,correopadre,id_correoPadre,nombre_alumno,semestre,numero_reporte,fecha,causas,curp];
  $('#modalReporte').modal('hide');
  $('#pdf').modal({
    closable  : false,
    onDeny    : function(){
      $('#pdf').modal('hide');
    },
    onApprove : function() {
    $('#FormPdf').attr('action','/pdf2')  
    $('#Nomb_padre').val(padre);
    $('#curp_al').val(curp);
    $('#idcorreo_padre').val(id_correoPadre);
    $('#nomAlumno').val(nombre_alumno);
    $('#semes').val(semestre);
    $('#num_reporte').val(numero_reporte);
    $('#date').val(fecha);
    $('#cau').val(causas);
    $('#otra_cau').val(otra_causa);
    $('#submit').trigger('click');
    }
  }).modal('show');
  $.ajax({
    type:'GET',
    url: '/suspencion',
    data: {arreglo:arreglo,otra_causa:otra_causa},
    dataType:'json',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success:function(response) {
      console.log(response);
    }
  });
}
