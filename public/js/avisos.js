$(document).ready(function(){
  $('.ui.dropdown').dropdown();

});
function modal() {
  $('#NuevoAviso').modal('Accion','Nuevo');
  $('#guardar').removeClass('disabled');
  $('#volver').css('display','none');
  $('#NuevoAviso').modal('setting', 'closable', false).modal('show');
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
function validacion() {
  $('#FormAviso')
  .form({
    on:'blur',
    fields: {
      nombre_aviso: {
        identifier: 'nombre_aviso',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor insertar nombre del aviso'
          }
        ]
      },
      fecha: {
        identifier: 'fecha',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor ingresar una fecha'
          }
        ]
      },
      aviso: {
        identifier: 'aviso',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor inserte el semestre del alumno'
          },
          {
            type   : 'minLength[20]',
            prompt : 'Por favor ingrese un aviso de más de 20 caracteres'
          }
        ]
      }
    },
    onSuccess:function() {
      var nombre=$('#nombre_aviso').val();
      var fecha = $('#fecha').val();
      var aviso=$('#aviso').val();
      $.ajax({
        type:'get',
        url: '/mandaraviso',
        data: {nombre:nombre,fecha:fecha,aviso:aviso},
        dataType:'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(response) {
          console.log(response);
          $('.ui.modal').modal('hide');
          if (response.response==true) {
            $('#cuerpo').html(response.tabla);
            $('.ui.dropdown').dropdown();
            swal("Bien hecho!", "El aviso se ha guardado con éxito!", "success");
          }else {
            swal("Rayos!", "El aviso no se guardó correctamente!", "error");
          }
        }
      });
    }
  }).submit(function(e) {
    e.preventDefault();
  });
}
function aduana() {
  console.log('llega');
    validacion();
    $('#FormAviso').submit();

}
function cancelar() {
  $('#NuevoAviso').modal('hide');
  $('#FormAviso')[0].reset();
}
function mandar(id) {
  $('#confirmo').modal({
    closable  : false,
    onDeny    : function(){
      $('#confirmo').modal('hide');
    },
    onApprove : function() {
      $.ajax({
        type:'get',
        url: '/mandar',
        data: {id:id},
        dataType:'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(response) {
        }
      });
    }
  }).modal('show');
}
function editar(id) {
  $('#NuevoAviso').modal('Accion','Editar');
  $('#NuevoAviso').modal('setting', 'closable', false).modal('show');
  $.ajax({
    type:'get',
    url: '/editar',
    data: {id:id},
    dataType:'json',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success:function(response) {
      console.log(response);
      $('#nombre_aviso').val(response.Nombre_aviso);
      $('#fecha').val(response.fecha);
      $('#aviso').val(response.aviso);
      $('#id_aviso').val(id);
      $('#guardar').addClass('disabled');
      $('#volver').css('display','block');
    }
  });
}
function actualizar() {
  var nombre=$('#nombre_aviso').val();
  var fecha = $('#fecha').val();
  var aviso=$('#aviso').val();
  var id=$('#id_aviso').val();
  $.ajax({
   type:'GET',
   url: '/actualizar',
   data: {nombre:nombre,fecha:fecha,aviso:aviso,id:id},
   dataType:'json',
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   success:function(response) {
     console.log(response);
   }
 });
}
function eliminar(id) {
  $('#borrarAviso')
  .modal({
    closable  : false,
    onDeny    : function(){
      $('#borrarAviso').modal('hide');
      return false;
    },
    onApprove : function() {
      $.ajax({
       type:'GET',
       url: '/borrar',
       data: {id:id},
       dataType:'json',
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       success:function(response) {
         if (response.response==true) {
           $('#cuerpo').html(response.tabla);
           swal("Bien hecho!", "El aviso se ha borrado con éxito!", "success");
         }else {
           swal("Rayos!", "El aviso no se borró correctamente!", "error");
         }
       }
     });
    }
  })
  .modal('show')
;
}
