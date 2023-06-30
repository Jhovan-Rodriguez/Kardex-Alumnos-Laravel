<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title></title>
  </head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js" charset="utf-8"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
  <script type="text/javascript" src="{{ URL::asset('js/Alumnos.js') }}"></script>
  <body>
<div class="ui container">
  <br><br>
  <div class="ui header">
    ESPECIALIDADES
</div>
<div class="ui breadcrumb">
  <a class="section">Menú</a>
  <i class="right arrow icon divider"></i>
  <div class="active section">Especialidades</div>
</div><br><br><br>
<?php
  $especialidad = DB::table('especialidad')->get();

 ?>
<a href="/alumnos/especialidad/<?php echo $especialidad[0]->id ?>">
  <div class="ui segment">
    <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
    <span>Programación</span>
  </div>
</a><br>
<a href="/alumnos/especialidad">
  <div class="ui segment">
    <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
    <span>Mecatrónica</span>
  </div>
</a><br>
<a href="/alumnos/especialidad">
  <div class="ui segment">
    <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
    <span>Transformación de Plásticos</span>
  </div>
</a>
</div>
  </body>
</html>
