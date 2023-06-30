<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
<body>
  <div class="ui container">
    <?php
    $consulta=DB::table('alumnos')
    ->join('alumnos_padres', 'alumnos_padres.curp_alumno', '=', 'alumnos.CURP')
    ->join('padres', 'padres.id', '=', 'alumnos_padres.id_padre')
    ->join('alumnos_grupos', 'alumnos_grupos.curp_alumno', '=', 'alumnos.CURP')
    ->join('grupos', 'grupos.id', '=', 'alumnos_grupos.id_grupo')
    ->join('padres_correos','padres_correos.id_padre','=','padres.id')
    ->join('correos','correos.id','=','padres_correos.id_correo')
    ->select('alumnos.CURP',DB::raw("CONCAT (alumnos.Nombre,' ',alumnos.Apellido_P,' ',alumnos.Apellido_M) as Nombre"),
    DB::raw("CONCAT (padres.Nombre,' ',padres.Apellido_P,' ',padres.Apellido_M) as Nombre_Padre"),
    'alumnos_padres.curp_alumno','alumnos_padres.id_padre','alumnos_grupos.id_grupo',
    'grupos.Nombre AS Nombre_Grupo','correos.correo','padres_correos.id_correo')
    ->where('alumnos.CURP','=',$curp)
    ->get();
    // dd($consulta);
    foreach ($consulta as $value) {
      $data=$value;
    }
    // dd($data);
    ?>
    <br><br>
    <h2 class="ui center aligned icon header">
      <i class="circular user icon"></i>
      <?php echo $data->Nombre; ?>
    </h2>
    <h4 class="ui horizontal divider header">
      <i class="info circle icon"></i>
      Información del Alumno
    </h4>
    <div class="ui middle aligned divided list">
      <div class="item"><br>
        <div class="right floated content">
          <div><?php echo $data->CURP; ?></div>
        </div>
        <i class="address card outline large icon"></i>
        <strong class="content">
          CURP
        </strong>
      </div>
      <div class="item"><br>
        <div class="right floated content">
          <div><?php echo $data->Nombre_Padre; ?></div>
        </div>
        <i class="user outline large icon"></i>
        <div class="content">
          Nombre del Padre de Familia
        </div>
      </div>
      <div class="item"><br>
        <div class="right floated content">
          <div><?php echo $data->Nombre_Grupo; ?></div>
        </div>
        <i class="graduation cap large icon"></i>
        <div class="content">
          Semestre y Grupo
        </div>
      </div>
      <div class="item"><br>
        <div class="right floated content">
          <div><?php echo $data->correo; ?></div>
        </div>
        <i class="google plus large icon"></i>
        <div class="content">
          Correo del Padre de Familia
        </div>
      </div>
    </div>
    <h4 class="ui horizontal divider header">
      <i class="clipboard outline icon"></i>
      Reportes del Alumno
    </h4>
    <table class="ui celled table">
  <thead>
    <tr><th>Numero de reporte</th>
    <th>Causa</th>
    <th>Fecha de realización</th>
  </tr></thead>
  <tbody>
    <?php
    $reporte=DB::table('alumnos')
    ->join('alumnos_padres', 'alumnos_padres.curp_alumno', '=', 'alumnos.CURP')
    ->join('padres', 'padres.id', '=', 'alumnos_padres.id_padre')
    ->join('alumnos_grupos', 'alumnos_grupos.curp_alumno', '=', 'alumnos.CURP')
    ->join('grupos', 'grupos.id', '=', 'alumnos_grupos.id_grupo')
    ->join('padres_correos','padres_correos.id_padre','=','padres.id')
    ->join('correos','correos.id','=','padres_correos.id_correo')
    ->join('reportes_alumnos','reportes_alumnos.curp_alumno','=','alumnos.CURP')
    ->join('causas','causas.id','=','reportes_alumnos.id_causa')
    ->select('alumnos.CURP',DB::raw("CONCAT (alumnos.Nombre,' ',alumnos.Apellido_P,' ',alumnos.Apellido_M) as Nombre"),
    DB::raw("CONCAT (padres.Nombre,' ',padres.Apellido_P,' ',padres.Apellido_M) as Nombre_Padre"),
    'alumnos_padres.curp_alumno','alumnos_padres.id_padre','alumnos_grupos.id_grupo',
    'grupos.Nombre AS Nombre_Grupo','correos.correo','padres_correos.id_correo',
    'reportes_alumnos.id','reportes_alumnos.id_causa','reportes_alumnos.fecha',
    'reportes_alumnos.numero_reporte','causas.causa')
    ->where('alumnos.CURP','=',$data->CURP)
    ->get();
    // dd($reporte);
    foreach ($reporte as $value) {
      $datos=$value;

     ?>
    <tr>
      <td><?php echo $datos->numero_reporte; ?></td>
      <td><?php echo $datos->causa; ?></td>
      <td><?php echo $datos->fecha; ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<a href="javascript:window.history.back();" class="ui labeled icon button blue">
  <i class="reply icon"></i>
   Volver atrás</a>

  </div>
</body>
</html>
