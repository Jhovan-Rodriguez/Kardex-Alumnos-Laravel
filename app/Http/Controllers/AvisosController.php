<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;
use PDF;
use Fpdf;


abstract class Controller extends BaseController
{
  use DispatchesJobs, ValidatesRequests;
}

class AvisosController extends Controller {
  public function aviso(Request $request){
    $nombre_aviso=$request->nombre;
    // dd($nombre_aviso);
    $fecha=$request->fecha;
    $aviso=$request->aviso;
    $consulta=DB::table('avisos')
    ->insert(['Nombre_aviso'=>$nombre_aviso,'fecha'=>$fecha,'aviso'=>$aviso]);
    $consulta2=DB::table('avisos')
    ->select('*')
    ->get();
    $tabla="<table>";
    foreach ($consulta2 as $value) {
      $tabla.="<tr>";
    $tabla.="<td>".$value->id."</td>";
    $tabla.="<td>".$value->Nombre_aviso."</td>";
    $tabla.="<td>".$value->fecha."</td>";
    $tabla.= "<td><div class='ui icon dropdown'>
                  <i class='bars icon'></i>
                  <div class='menu'>
                  <div class='item' onclick='mandar(".$value->id.")'><i class='envelope icon green'></i>Mandar a Padres</div>
                  <div class='item' onclick='editar(".$value->id.")'><i class='attention icon'></i>Ver Aviso</div>
                  <div class='item' onclick='eliminar(".$value->id.")'><i class='trash icon red'></i>Eliminar</div>
                  </div>
                </div></td>";
                $tabla.="<tr>";
    }
    $tabla.="</table>";
    $correcto = array('response' =>true,'tabla'=>$tabla);
    $incorrecto = array('response' =>false);
    if ($consulta==true) {
      return JSON_encode($correcto);
    }else {
      return JSON_encode($incorrecto);
    }
  }
  public function mandar(Request $request){
    $id=$request->id;
    $consulta=DB::table('correos')
    ->select('correo')
    ->get();
    $aviso=DB::table('avisos')
    ->select('*')
    ->where('avisos.id',$id)
    ->get();
    // dd($aviso);
    foreach ($aviso as $value) {
      $datos=$value;
    }
    $contador=count($consulta);
    // dd($contador);
    for ($i=0; $i <$contador ; $i++) {
      $subject = "Aviso CBTis";
      $for = $consulta[$i]->correo;
      Mail::send('correoAviso',['aviso'=>$value->aviso,'fecha'=>$value->fecha,'nombre_aviso'=>$value->Nombre_aviso], function($msj) use($subject,$for){
        $msj->from("jrdzmoreno1@gmail.com","Centro de Bachillerato Tecnológico Industrial 271 Plus");
        $msj->subject($subject);
        $msj->to($for);
      });
    }
    return redirect()->back();
  }
  public function editar(Request $request){
    $id=$request->id;
    $consulta=DB::table('avisos')
    ->select('*')
    ->where('avisos.id',$id)
    ->get();
    foreach ($consulta as $value) {
      $datos=$value;
    }
    return JSON_encode($value);
  }
  public function actualizar(Request $request){
    $nombre_aviso=$request->nombre;
    // dd($nombre_aviso);
    $fecha=$request->fecha;
    $aviso=$request->aviso;
    $id=$request->id;
    $update=DB::table('avisos')
            ->where('avisos.id', $id)
            ->update(['aviso' => $aviso,'fecha'=>$fecha,'Nombre_aviso'=>$nombre_aviso]);
            $consulta2=DB::table('avisos')
            ->select('*')
            ->get();
            $tabla="<table>";
            foreach ($consulta2 as $value) {
              $tabla.="<tr>";
            $tabla.="<td>".$value->id."</td>";
            $tabla.="<td>".$value->Nombre_aviso."</td>";
            $tabla.="<td>".$value->fecha."</td>";
            $tabla.= "<td><div class='ui icon dropdown'>
                          <i class='bars icon'></i>
                          <div class='menu'>
                            <div class='item' onclick='mandar(".$value->id.")'><i class='attention icon red'></i>Reportar</div>
                            <div class='item' onclick='editar(".$value->id.")'><i class='attention icon'></i>Editar</div>
                            <div class='item' onclick='eliminar(".$value->id.")'><i class='trash icon red'></i>Eliminar</div>
                          </div>
                        </div></td>";
                        $tabla.="<tr>";
            }
            $tabla.="</table>";
            $correcto = array('response' =>true,'tabla'=>$tabla);
            $incorrecto = array('response' =>false);

            if ($update==true) {
              return JSON_encode($correcto);
            }else {
              return JSON_encode($incorrecto);
            }

  }
  public function borrar(Request $request){
    $id=$request->id;
    $consulta=DB::table('avisos')->where('avisos.id','=',$id)->delete();
    $consulta2=DB::table('avisos')
    ->select('*')
    ->get();
    $tabla="<table>";
    foreach ($consulta2 as $value) {
      $tabla.="<tr>";
    $tabla.="<td>".$value->id."</td>";
    $tabla.="<td>".$value->Nombre_aviso."</td>";
    $tabla.="<td>".$value->fecha."</td>";
    $tabla.= "<td><div class='ui icon dropdown'>
                  <i class='bars icon'></i>
                  <div class='menu'>
                  <div class='item' onclick='mandar(".$value->id.")'><i class='envelope icon green'></i>Mandar a Padres</div>
                  <div class='item' onclick='editar(".$value->id.")'><i class='attention icon'></i>Ver Aviso</div>
                  <div class='item' onclick='eliminar(".$value->id.")'><i class='trash icon red'></i>Eliminar</div>
                  </div>
                </div></td>";
                $tabla.="<tr>";
    }
    $tabla.="</table>";
    $correcto = array('response' =>true,'tabla'=>$tabla);
    $incorrecto = array('response' =>false);
    if ($consulta==true) {
      return JSON_encode($correcto);
    }else {
      return JSON_encode($incorrecto);
    }
  }
}
