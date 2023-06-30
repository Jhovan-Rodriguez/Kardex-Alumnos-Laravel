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
    <div class="ui container">
      <div class="ui medium image">
      <img src="https://www.gob.mx/cms/uploads/article/main_image/87283/logo_educ.jpg">
    </div>
      <br>
      <p style="text-align:center">SUBSECRETARIA DE EDUCACIÓN MEDIA SUPERIOR</p>
      <p style="text-align:center">Unidad de Educación Media Superior Tecnológica Industrial y de Servicios</p>
      <p style="text-align:center">CENTRO DE BACHILLERATO TECNOLÓGICO INDUSTRIAL Y DE SERVICIOS No. 271</p>
      <p>Cd. Victoria Tam <?php echo $fecha; ?></p>
      <p style="text-align:right">Reporte <?php echo $Numero_Reporte; ?></p>
      <p>SR.(A) PADRE DE FAMILIA .- <?php echo $Nombre_Padre; ?></p>
      <p>PRESENTE:</p>
      <p>Por este medio se le informa que su hijo (a) : <?php echo $NombreAlumno; ?></p>
      <p>Quién cursa el semestre (<?php echo $semestre; ?>) ha sido reportado por presentar la o las situaciones señaladas:</p>
      <br>
      <p><?php echo $causas; ?></p><br><br>
      <p>Por lo que le solicitamos su apoyo para tratar asunto con su hijo y dar la solución a la problematica enfrentada.</p><br>

     <strong style="text-align:center">ATENTAMENTE</strong>
    </div>
  </body>
</html>
