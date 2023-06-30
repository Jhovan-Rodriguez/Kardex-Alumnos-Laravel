<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
<script type="text/javascript" src="{{ URL::asset('js/5_C.js') }}"></script>
<body>
  <?php
  // dd($grupo);
  $users = DB::table('alumnos')
  ->join('alumnos_grupos', 'alumnos_grupos.curp_alumno', '=', 'alumnos.CURP')
  ->select('alumnos.CURP', 'alumnos.Numero_lista', 'alumnos.Nombre','alumnos.Apellido_P','alumnos.Apellido_M','alumnos_grupos.curp_alumno')
  ->where('alumnos_grupos.id_grupo','=',$grupo)
  ->get();
  // dd($grupo);
  $data=DB::table('grupos')
  ->select('grupos.Nombre')
  ->where('grupos.id',$grupo)
  ->first();
  // dd($data);
  ?>
  <div class="ui container">
    <br><br>
    <div class="ui header">
      ALUMNOS
    </div><br>
    <div class="ui breadcrumb">
      <a class="section">Menú</a>
      <i class="right chevron icon divider"></i>
      <a class="section" href="/alumnos">Especialidades</a>
      <i class="right chevron icon divider"></i>
      <a class="section" href="/alumnos/especialidad/1">Programación</a>
      <i class="right arrow icon divider"></i>
      <div class="active section"><?php echo $data->Nombre; ?></div>
    </div><br><br>
    <table class="ui celled table">
      <thead class="ui center aligned">
        <tr><th>Numero de Lista</th>
          <th>CURP</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Acciones</th>
        </tr></thead>
        <tbody class="ui center aligned" id="tabla">
          <tr>
            <?php
            foreach ($users as $value) {
              ?>
              <td><?php echo $value->Numero_lista ?></td>
              <td><?php echo $value->CURP ?></td>
              <td><?php echo $value->Nombre ?></td>
              <td><?php echo $value->Apellido_P ?></td>
              <td><?php echo $value->Apellido_M ?></td>
              <td><div class="ui icon dropdown">
                <i class="bars icon"></i>
                <div class="menu">
                  <div class="item" onclick="reporte('<?php echo $value->CURP; ?>')"><i class="attention icon red"></i>Reportar</div>
                  <a href="/alumnos/perfil/<?php echo $value->CURP; ?>" class="item"><i class="user icon blue"></i>Perfil</a>
                </div>
              </div></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="ui modal" id="modalReporte">
        <div class="header">
          Reportar Alumno
        </div>
        <div class="content">
          <div class="description">
            <div class="ui red message">Campos que contengan (*) son obligatorios.</div>
            <form class="ui form" id="FormReporte">
              <div class="field required">
                <label>Padre de Familia</label>
                <input type="text" name="Padre" placeholder="Padre de Familia" readonly id="Nombre_Padre">
                <input type="hidden" name="correopadre" value="" id="correoPadre">
                <input type="hidden" name="IdCorreoPadre" value="" id="IdCorreoPadre">
              </div>
              <div class="field required">
                <label>CURP del Alumno</label>
                <input type="text" name="curp" placeholder="CURP del alumno" readonly id="curp">
              </div>
              <div class="two fields">
                <div class="field required">
                  <label>Nombre del Alumno</label>
                  <input type="text" name="Alumno" placeholder="Nombre del Alumno" readonly id="NombreAlumno">
                </div>
                <div class="field required">
                  <label>Semestre y Grupo</label>
                  <input type="text" name="Semestre" placeholder="Semestre" readonly id="Semestre">
                </div>
              </div>
              <div class="two fields">
                <div class="field required">
                  <label>Numero de Reporte:</label>
                  <input type="text" name="Numero_Reporte" placeholder="Numero de Reporte" id="Numero_Reporte" value="1" readonly>
                </div>
                <div class="field required">
                  <label>Fecha:</label>
                  <input type="date" name="fecha" value="" id="fecha">
                </div>
              </div>
              <div class="two fields">
                <div class="field required" id="opciones">
                  <label>Causas del reporte:</label>
                  <select class="ui fluid dropdown" id="causas">
                    <option value="">Causas</option>

                    <?php
                    $causas=DB::table('causas')
                    ->select('*')
                    ->get();
                    foreach ($causas as $value) {
                      ?>
                      <option value="<?php echo $value->id; ?>"><?php echo $value->causa; ?></option>
                    <?php } ?>
                  </select>
                </div><br><br>
                <div class="field">
                  <div class="ui checkbox" id="checkbox" >
                    <input type="checkbox" name="OtroTipo">
                    <label>Otra Causa</label>
                  </div>
                </div>
              </div>
              <div class="field required" style="display:none" id="Otro">
                <label>Otro:</label>
                <input type="text" name="OtroTipo" placeholder="Otro.." id="OtroTipo">
              </div>
            </form>
          </div>
        </div>
        <div class="actions">
          <div class="ui left floated icon button green" id="suspencion" onclick="suspencion()" style="display:none">Enviar aviso de Suspención</div>
          <div class="ui deny button red" id="cancelar" onclick="cancelar()">
            Cancelar
          </div>
          <div class="ui right labeled icon button green" onclick="aduana()" id="validar">
            Reportar y Enviar correo
            <i class="checkmark icon"></i>
          </div>
        </div>
      </div>
      <div class="ui basic modal" id="pdf">
        <br><br><br><br><br><br><br><br>
        <div class="ui icon header">
          <i class="file pdf outline icon"></i>
          ¿Convertir reporte en PDF?
          <form class="" action="/pdf" method="post" style="display:none" id="FormPdf">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="text" name="Nombre_Padre" value="" id="Nomb_padre">
            <input type="text" name="curp" value="" id="curp_al">
            <input type="text" name="id_correoPadre" value="" id="idcorreo_padre">
            <input type="text" name="nombre_alumno" value="" id="nomAlumno">
            <input type="text" name="semestre" value="" id="semes">
            <input type="text" name="numero_reporte" value="" id="num_reporte">
            <input type="text" name="fecha" value="" id="date">
            <input type="text" name="causas" value="" id="cau">
            <input type="text" name="otra_causa" value="" id="otra_cau">
            <button type="submit" name="button" id="submit"></button>
          </form>
        </div>
        <div class="content">
          <p>El correo mandado será convertido a PDF</p>
        </div>
        <div class="actions">
          <div class="ui red basic cancel inverted button">
            <i class="remove icon"></i>
            No
          </div>
          <div class="ui green ok inverted button">
            <i class="checkmark icon"></i>
            Yes
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
