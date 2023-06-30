<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/avisos.js') }}"></script>
<body>
  <div class="ui container">
    <br><br>
    <div class="ui header">
      AVISOS
    </div><br>
    <div class="ui breadcrumb">
      <a class="section" href="javascript:window.history.back();">Menú</a>
      <i class="right arrow icon divider"></i>
      <div class="active section">Avisos</div>
    </div>
    <div class="ui right labeled icon right floated button blue" onclick="modal()">
      <i class="plus icon"></i>
      Nuevo Aviso
    </div><br><br><br>
    <table class="ui celled table">
      <thead>
        <tr class="ui center aligned"><th>Numero de Aviso</th>
          <th>Nombre de Aviso</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr></thead>
        <tbody class="ui center aligned" id="cuerpo">
          <?php
          $consulta=DB::table('avisos')
          ->select('*')
          ->get();
          foreach ($consulta as $value) {

           ?>
          <tr>
            <td><?php echo $value->id; ?></td>
            <td><?php echo $value->Nombre_aviso; ?></td>
            <td><?php echo $value->fecha; ?></td>
            <td><div class="ui icon dropdown">
              <i class="bars icon"></i>
              <div class="menu">
                <div class="item" onclick="mandar(<?php echo $value->id; ?>)"><i class="envelope icon green"></i>Mandar a Padres</div>
                <div class="item" onclick="editar(<?php echo $value->id; ?>)"><i class="attention icon"></i>Ver Aviso</div>
                <div class="item" onclick="eliminar(<?php echo $value->id; ?>)"><i class="trash icon red"></i>Eliminar</div>
              </div>
            </div></td>
          <?php } ?>
          </tr>
        </tbody>
      </table>
      <div class="ui modal" id="NuevoAviso">
        <i class="close icon"></i>
        <div class="header">
          Nuevo Aviso
        </div>
        <div class="content">
          <div class="description">
            <div class="ui red message">Campos que contengan (*) son obligatorios.</div>
            <form class="ui form" id="FormAviso">
              <div class="two fields">
                <div class="field required">
                  <label>Nombre del Aviso</label>
                  <input type="text" name="nombre_aviso" placeholder="Ingrese el nombre del aviso" id="nombre_aviso">
                  <input type="hidden" name="id" value="" id="id_aviso">
                </div>
                <div class="field required">
                  <label>Fecha</label>
                  <input type="date" name="fecha" placeholder="Ingrese la fecha" id="fecha">
                </div>
              </div>
              <div class="field required">
                <label>Aviso:</label>
                 <textarea style="margin-top: 0px; margin-bottom: 0px; height: 112px;" name="aviso" id="aviso"></textarea>
              </div>
            </form>
          </div>
        </div>
        <div class="actions">
          <div class="ui right labeled icon left floated button blue" style="display:none" id="volver" onclick="cancelar()">
            <i class="arrow alternate circle left outline icon"></i>
            Volver
          </div>
          <div class="ui button red" id="cancelar" onclick="cancelar()">
            Cancelar
          </div>
          <div class="ui right labeled icon button green" id="guardar" onclick="aduana()">
            Guardar Aviso
            <i class="checkmark icon"></i>
          </div>
        </div>
      </div>
      <div class="ui basic modal" id="confirmo">
        <br><br><br><br><br><br><br><br>
        <div class="ui icon header">
          <i class="envelope outline icon"></i>
          ¿Mandar correos a todos los padres?
        </div>
        <div class="content">
          <p>El correo será mandado a todos los padres de familia del plantel</p>
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
      <div class="ui basic modal" id="borrarAviso">
        <br><br><br><br><br><br><br><br>
        <div class="ui icon header">
          <i class="trash alternate icon"></i>
          ¿Seguro de eliminar este Aviso?
        </div>
        <div class="content">
          <p>El aviso de eliminará completamente</p>
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
