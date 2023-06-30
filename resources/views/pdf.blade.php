<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
  </head>
  <body>
    <!-- <div class="ui container"> -->
      <!-- <div class="ui medium image"> -->
      <img src="https://www.gob.mx/cms/uploads/article/main_image/87283/logo_educ.jpg" style="margin:0px auto; width:300px;">
    <!-- </div> -->
      <!-- <br> -->
      <?php
      $causa=DB::table('causas')
      ->select('causa')
      ->where('causas.id',$causas)
      ->first();
      foreach ($causa as $value) {
        $causas1=$value;
      }
       ?>
      <p style="text-align:center">SUBSECRETARIA DE EDUCACIÓN MEDIA SUPERIOR</p>
      <p style="text-align:center">Unidad de Educación Media Superior Tecnológica Industrial y de Servicios</p>
      <p style="text-align:center">CENTRO DE BACHILLERATO TECNOLÓGICO INDUSTRIAL Y DE SERVICIOS No. 271</p><br><br>
      <p>Cd. Victoria Tam <?php echo $fecha; ?></p>
      <p style="text-align:right">Reporte <?php echo $numero_reporte; ?></p>
      <p>SR.(A) PADRE DE FAMILIA .- <?php echo $Nomb_padre; ?></p>
      <p>PRESENTE:</p>
      <p>Por este medio se le informa que su hijo (a) : <?php echo $NombreAlumno; ?></p>
      <p>Quién cursa el semestre (<?php echo $semestre; ?>) ha sido reportado por presentar la o las situaciones señaladas:</p>
      <br>
      <p><?php echo $causas1; ?></p><br><br>
      <p>Por lo que le solicitamos su apoyo para tratar asunto con su hijo y dar la solución a la problematica enfrentada.</p><br>

     <p style="text-align:center">ATENTAMENTE</p><br><br>
     <br>
     <div style="display:flex">
        <p style="text-align:left">JEFE DE SERVICIOS ESCOLARES</p>
        <p style="text-align:right">JEFE DE OFICINA DE ORIENTACIÓN</p>
      </div><br><br>
     <br>
     <p style="text-align:center">NOMBRE Y FIRMA DE ENTERADO</p>
     <p style="text-align:center">DEL PADRE O TUTOR</p><br><br><br>
     <p>NOTA: FAVOR DE REGRESAR REPORTE FRIMADO Y COPIA DE LA CREDENCIAL DE ELECTOR</p>

    <!-- </div> -->
  </body>
</html>
