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

class AlumnosController extends Controller {

  public function index(){
    $users = DB::table('alumnos')->get();
    dd($users);
  }
  public function InfoAlumno(Request $request){
    $valor=$request->valor;
    $id_alumno=$request->curp;
    $reporte=DB::table('alumnos')
    ->join('alumnos_padres', 'alumnos_padres.curp_alumno', '=', 'alumnos.CURP')
    ->join('padres', 'padres.id', '=', 'alumnos_padres.id_padre')
    ->join('alumnos_grupos', 'alumnos_grupos.curp_alumno', '=', 'alumnos.CURP')
    ->join('grupos', 'grupos.id', '=', 'alumnos_grupos.id_grupo')
    ->join('padres_correos','padres_correos.id_padre','=','padres.id')
    ->join('correos','correos.id','=','padres_correos.id_correo')
    ->join('reportes_alumnos','reportes_alumnos.curp_alumno','=','alumnos.CURP')
    ->select('alumnos.CURP',DB::raw("CONCAT (alumnos.Nombre,' ',alumnos.Apellido_P,' ',alumnos.Apellido_M) as Nombre"),
    DB::raw("CONCAT (padres.Nombre,' ',padres.Apellido_P,' ',padres.Apellido_M) as Nombre_Padre"),
    'alumnos_padres.curp_alumno','alumnos_padres.id_padre','alumnos_grupos.id_grupo',
    'grupos.Nombre AS Nombre_Grupo','correos.correo','padres_correos.id_correo',
    'reportes_alumnos.id','reportes_alumnos.id_causa')
    ->where('alumnos.CURP','=',$id_alumno)
    ->count();
    // dd($reporte);
    if ($valor=="1" and $reporte==0) {
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
      ->where('alumnos.CURP','=',$id_alumno)
      ->get();
      $numero=1;
      foreach ($consulta as $value) {
        $datos=$value;
      }
      $arreglo = array($datos,$numero);
      return JSON_encode($arreglo);
    }elseif ($valor=="1" and $reporte==1) {
      $consulta2=DB::table('alumnos')
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
      ->where('alumnos.CURP','=',$id_alumno)
      ->get();
      $numero=2;
      foreach ($consulta2 as $value) {
        $datos2=$value;
      }
      $arreglo = array($datos2,$numero);
      return JSON_encode($arreglo);
    }elseif ($valor=="1" and $reporte==2) {
      $consulta3=DB::table('alumnos')
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
      ->where('alumnos.CURP','=',$id_alumno)
      ->get();
      foreach ($consulta3 as $value) {
        $datos3=$value;
      }
      $numero=3;
      $arreglo = array($datos3,$numero);
      return JSON_encode($arreglo);
    }elseif ($valor=="1" and $reporte==3) {
      $consulta4=DB::table('alumnos')
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
      ->where('alumnos.CURP','=',$id_alumno)
      ->get();
      // dd($consulta4);
      $numero=4;
      foreach ($consulta4 as $value) {
        $datos4=$value;
      }
      $arreglo = array($datos4,$numero);
      return JSON_encode($arreglo);
    }

  }

  public function correo(Request $request){
    // dd($request->arreglo);
    $otra_causa=$request->otra_causa;
    $correopadre=$request->arreglo[1];
    $nombre_padre=$request->arreglo[0];
    $nombre_alumno=$request->arreglo[3];
    $semestre=$request->arreglo[4];
    $numero_reporte=$request->arreglo[5];
    $fecha=$request->arreglo[6];
    $curp=$request->arreglo[8];
    $id_causa=$request->arreglo[7];
    $causa=DB::table('causas')
    ->select('causa')
    ->where('causas.id',$id_causa)
    ->first();
    foreach ($causa as $value) {
      $causas=$value;
    }
    // dd($causa);
    if ($otra_causa!=="1") {
      DB::table('causas')->insert(
        ['causa' =>$otra_causa]
      );
    }
    DB::table('reportes_alumnos')
    ->insert(['curp_alumno'=>$curp,'id_causa'=>$id_causa,'fecha'=>$fecha,'numero_reporte'=>$numero_reporte]);

    $subject = "Aviso de Reporte";
    $for = $correopadre;
    Mail::send('email',['correopadre'=>$correopadre,'Nombre_Padre'=>$nombre_padre,
    'NombreAlumno'=>$nombre_alumno,'semestre'=>$semestre,'fecha'=>$fecha,
    'Numero_Reporte'=>$numero_reporte,'causas'=>$causas], function($msj) use($subject,$for){
      $msj->from("jrdzmoreno1@gmail.com","Centro de Bachillerato Tecnológico Industrial 271 Plus");
      $msj->subject($subject);
      $msj->to($for);
    });
    return redirect()->back();

  }
  public function suspencion(Request $request){
    // dd($request->arreglo);
    $otra_causa=$request->otra_causa;
    $correopadre=$request->arreglo[1];
    $nombre_padre=$request->arreglo[0];
    $nombre_alumno=$request->arreglo[3];
    $semestre=$request->arreglo[4];
    $numero_reporte=$request->arreglo[5];
    $fecha=$request->arreglo[6];
    $curp=$request->arreglo[8];
    $id_causa=$request->arreglo[7];
    $subject = "Aviso de Suspención";
    $for = $correopadre;
    Mail::send('emailSuspencion',['correopadre'=>$correopadre,'Nombre_Padre'=>$nombre_padre,
    'NombreAlumno'=>$nombre_alumno,'semestre'=>$semestre,'fecha'=>$fecha,
    'Numero_Reporte'=>$numero_reporte,'curp'=>$curp], function($msj) use($subject,$for){
      $msj->from("jrdzmoreno1@gmail.com","Centro de Bachillerato Tecnológico Industrial 271 Plus");
      $msj->subject($subject);
      $msj->to($for);
    });
    return redirect()->back();
  }
  public function PDF(Request $request){
    // $data=$request->nombre_alumno;
    $data = [ 'NombreAlumno' =>$request->nombre_alumno,
  'curp'=>$request->curp,'id_correoPadre'=>$request->id_correoPadre,
  'semestre'=>$request->semestre,'numero_reporte'=>$request->numero_reporte,
'fecha'=>$request->fecha,'causas'=>$request->causas,
'otra_causa'=>$request->otra_causa,'Nomb_padre'=>$request->Nombre_Padre];
  	$pdf = PDF::loadView('pdf', $data);
  	return $pdf->stream('Reporte de '.$request->nombre_alumno.'.pdf');
  }
  public function PDF2(Request $request){
    // $data=$request->nombre_alumno;
    $data = [ 'NombreAlumno' =>$request->nombre_alumno,
  'curp'=>$request->curp,'id_correoPadre'=>$request->id_correoPadre,
  'semestre'=>$request->semestre,'numero_reporte'=>$request->numero_reporte,
'fecha'=>$request->fecha,'causas'=>$request->causas,
'otra_causa'=>$request->otra_causa,'Nomb_padre'=>$request->Nombre_Padre];
    $pdf = PDF::loadView('pdf2', $data);
    return $pdf->stream('Reporte de '.$request->nombre_alumno.'.pdf');
  }
}
