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
      <br>
      <p>SR(A). Padre de Familia</p>
      <p>Mediante este correo se le hace llegar el siguiente aviso:</p>
      <p><?php echo $aviso; ?></p>
     <p style="text-align:center">ATENTAMENTE</p>
    </div>
  </body>
</html>
