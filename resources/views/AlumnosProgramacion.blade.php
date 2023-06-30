<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js" charset="utf-8"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
  <script type="text/javascript" src="{{ URL::asset('js/Alumnos.js') }}"></script>
  <body>
    <?php
    // dd($especialidad);
    $GruposProgra = DB::table('especialidad_grupo')
    ->where('especialidad_grupo.id_especialidad',$especialidad)
    ->get();
    foreach ($GruposProgra as $value) {
    $arregloGrupos=explode(",",$value->id_grupo);
    }
     ?>
<div class="ui container">
    <br><br>
    <div class="ui header">
      PROGRAMACIÓN
  </div><br>
  <div class="ui breadcrumb">
    <a class="section">Menú</a>
    <i class="right chevron icon divider"></i>
    <a class="section" href="/alumnos">Especialidades</a>
    <i class="right arrow icon divider"></i>
    <div class="active section">Programación</div>
  </div><br><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[0]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>1° A</span>
    </div>
  </a><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[1]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>1° B</span>
    </div>
  </a><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[2]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>1° C</span>
    </div>
  </a>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[3]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>3° A</span>
    </div>
  </a><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[4]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>3° B</span>
    </div>
  </a><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[5]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>3° C</span>
    </div>
  </a><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[6]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>5° A</span>
    </div>
  </a><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[7]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>5° B</span>
    </div>
  </a><br>
  <a href="/alumnos/especialidad/1/<?php echo $arregloGrupos[8]  ?>">
    <div class="ui segment">
      <img class="ui middle aligned tiny image" src="http://simpleicon.com/wp-content/uploads/multy-user.png">
      <span>5° C</span>
    </div>
  </a><br><br>
  <a href="javascript:window.history.back();" class="ui labeled icon button blue">
    <i class="reply icon"></i>
     Volver atrás</a><br><br>
</div>
  </body>
</html>
