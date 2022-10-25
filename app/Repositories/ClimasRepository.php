<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// Necesario para la clase Session
use Session;
use Auth;
use Excel;

use App\Models\Climas;
use App\Models\Plantillas;
use App\Models\Perfilusers;
use App\Models\Perfilclimas;
use App\Models\User;
use App\Models\Periodos;

use App\Imports\ClimasImport;
use App\Exports\UsersExport;
use App\Exports\ClimasExport;
use App\Exports\PlantillasExport;

class ClimasRepository extends Controller
{
    private $model;
    private $plantilla;
    private $ultimo_periodo;
    public function __construct()
    {        
        $this->model = New Climas();
        $this->plantilla = DB::table('plantillas')                                
            ->where('plantillas.id', '=', "1")
            ->get();
        $this->ultimo_periodo = $this->ultimo_periodo();
    }
    // completa la vista del Administrador, viene de controller
    public function indexAdmin()
    {        
        $datos = [
            "usuario"=>Auth::user()->name,
            "cve_perfil_usuario"=>Auth::user()->fk_cve_perfil_usuario,
            "email"=>Auth::user()->email,            
            "success"=>""
        ];
        $datos['success']  = "Tenga cuidado con estas opciones";
        $vista = view('administrador',$datos);        
        return $vista;
    }
    
    // viene desde sel controller
    public function create( Request $request )
    {     
        $perfil_usuarios    = $this->perfil_usuarios();
        $usuarios           = $this->usuarios();
        $periodos           = $this->periodos();
        $climas             = $this->clima_blank();
        return view('admin/Climas.create', compact(
            'usuarios',
            'perfil_usuarios',
            'periodos',
            'climas'));
    }
    // viene del controller
    public function store(Request $request)
    {    
        $this->agrega( $request);
        $get_last_id = $this->get_last_id()->id;        
        return redirect("/cons1")->with('mensaje',
            'Nuevo Formato de Clima Organizacional Agergado con el Folio No.'.$get_last_id.
        ', favor de anotarlo.');
    }
    // viene del controller
    public function destroy( Request $request, $id)
    {
        $this->model->destroy( $id);        
        return redirect("/admin/Climas")->with('mensaje','Formato de Clima Org. Borrado.');
    }
    // viene del controller, al dar clic en Editar
    public function edit( Request $request, $id)
    {        
        $perfil_usuarios    = $this->perfil_usuarios();
        $usuarios           = $this->usuarios();
        $periodos           = $this->periodos();
        $climas             = $this->editclima( $id);
        $plantilla          = $this->get_plantilla( $id);        
        return view('admin/Climas.edit', compact(
            'usuarios',
            'perfil_usuarios',
            'periodos',
            'plantilla',
            'climas'));
    }
    // boton Grabar datos - Editar, viene del controller
    public function update(Request $request, $id)
    {        
        $this->save( $request, $id); 
        return redirect("/admin/Climas")->with('mensaje','Formato Clima Organizacional Actualizado.');
    } 
    // viene del controller       
    public function import(Request $request)    
    {
      if ( $this->es_administrador() == "Si")   { return $this->importclima( $request); }
      else { return $this->get_user_data(); }
    } 
    // viene del controller
    public function indeximport(Request $request)
    {
        if ( $this->es_administrador() == "Si")  {
            $periodos           = $this->periodos();
            $climas             = $this->all();
            return view('/admin/Climas/Import', compact('climas','periodos')); }
        else { return $this->get_user_data(); }
    }
    // reportes 1,2 o 3, viene del controller
    public function repo(Request $request, $repo)
    {
        if ( $this->es_administrador() == "Si") { return $this->reportes( $request, $repo); }
        else { return $this->get_user_data(); }
    }
    // viene del controller
    public function exp(Request $request, $exp)
    {
        if ( $this->es_administrador() == "Si")  { return $this->export( $request, $exp); }
        else { return $this->get_user_data(); }
    }
    // viene del controller Reporte Detallado o por Dependencia
    public function climasrepo( Request $request)
    {        
        // clic en reporte detallado?
        if (isset($request->repodet)) { 
            return $this->climasrepodet( $request);
        } else { 
            if (isset($request->repodep)) {
                return $this->climasrepodep( $request); 
            } else{
                return $this->climasrepoper( $request); 
            }
        }   
    }      
    // no hereda Request, viene del controller
    public function show( Request $request)
    {        
        if ( $this->es_administrador() == "Si")  {  return redirect("/admin/Climas/create"); }
        else
        {    
            if (Session::has('model'))
            {            
                $this->session_to_model();
            }
            //$request = $this->model_to_request();
        return $this->createval2( $request);
        }
    }    
    // CRUD CLima Organizacional Menu del Capturista, viene de controller
    public function index()
    {       
      if ( $this->es_administrador() == "Si")  {   return $this->indexcrud(); }
      else  {   $vista= view('consideraciones'); return $vista; }       
    }
    // viene del controller, boton de Buscar
    public function search(Request $request) 
    {      
      $num_emp = trim($request->num_emp);
      $dep_o_ent = trim($request->dependencia);
      $plan = DB::table('plantillas')
        ->orderBy('plantillas.num_emp', 'ASC')
        ->where('plantillas.dependencia', '=', $dep_o_ent)
        ->where('plantillas.num_emp', '=', $num_emp)
        ->get();      
      // SE ENCONTRÓ EN PLANTILLAS?
      if( count( $plan) > 0)
      {
        $this->plantilla = $plan;
        $this->model->fk_id_plantillas  = $this->plantilla[0]->id;
        $this->model->num_emp           = $this->plantilla[0]->num_emp;
        $this->model->nombre_completo   = $this->plantilla[0]->nombre_completo;
        $this->model->dep_o_ent         = $this->plantilla[0]->dependencia;
        $this->model->unidad_admva      = $this->plantilla[0]->unidad_admva;        
        $uclima = DB::table('climas') 
            ->join('periodos', 'periodos.cve_periodo', '=', 'climas.fk_cve_periodo')
            ->join('plantillas', 'plantillas.id', '=', 'climas.id')
            ->select( $this->get_campos_clima() )
            ->orderBy('plantillas.num_emp', 'ASC')
            ->orderBy('climas.fk_cve_periodo', 'DESC')
            ->where('plantillas.dependencia', '=', $dep_o_ent)
            ->where('climas.deleted_at', '=', NULL)
            ->where('plantillas.num_emp', '=', $num_emp)
            ->get();        
        //$this->model_to_session();        
        // existe ak menos 1 formato Climas      
        if( count($uclima) > 0)
        {                               
            if( $uclima[0]->fk_cve_periodo == $this->ultimo_periodo->cve_periodo )
            {                
                $err = 
                "Ya existe un formato capturado para el periodo ='". $this->ultimo_periodo->descripcion.
                "' y empleado numero = '".$num_emp. 
                "' y dependencia = '".$dep_o_ent. "'.";
                //Session::has('')
                session(['num_emp' => $num_emp]);
                session(['dependencia' => $dep_o_ent]);                
                return back()->with('mensaje', $err);
            }
            else
            {
                // pasa los datos de la ultimo formato clima
                $this->model->fk_cve_periodo     = $this->ultimo_periodo->cve_periodo;
                $this->model->fk_id_plantillas   = $uclima[0]->fk_id_plantillas;
                $this->model->fecha              = $uclima[0]->fecha;
                $this->model->area               = $uclima[0]->area;
                $this->model->r1                 = $uclima[0]->r1;
                $this->model->r2                 = $uclima[0]->r2;
                $this->model->r3                 = $uclima[0]->r3;
                $this->model->r4                 = $uclima[0]->r4;
                $this->model->r5                 = $uclima[0]->r5;
                $this->model->r6                 = $uclima[0]->r6;
                $this->model->r7                 = $uclima[0]->r7;
                $this->model->r8                 = $uclima[0]->r8;
                $this->model->r9                 = $uclima[0]->r9;
                $this->model->r10                = $uclima[0]->r10;
                $this->model->r11                = $uclima[0]->r11;
                $this->model->r12                = $uclima[0]->r12;
                $this->model->r13                = $uclima[0]->r13;
                $this->model->r14                = $uclima[0]->r14;
                $this->model->r15                = $uclima[0]->r15;
                $this->model->r16                = $uclima[0]->r16;
                $this->model->r17                = $uclima[0]->r17;
                $this->model->r18                = $uclima[0]->r18;
                $this->model->r19                = $uclima[0]->r19;
                $this->model->r20                = $uclima[0]->r20;
                $this->model->r21                = $uclima[0]->r21;
                $this->model->r22                = $uclima[0]->r22;
                $this->model->r23                = $uclima[0]->r23;
                $this->model->r24                = $uclima[0]->r24;
                $this->model->r25                = $uclima[0]->r25;
                $this->model->r26                = $uclima[0]->r26;
                $this->model->r27                = $uclima[0]->r27;
                $this->model->r28                = $uclima[0]->r28;
                $this->model->r29                = $uclima[0]->r29;
                $this->model->r30                = $uclima[0]->r30;
                $this->model->r31                = $uclima[0]->r31;
                $this->model->r32                = $uclima[0]->r32;
                $this->model->r33                = $uclima[0]->r33;
                $this->model->r34                = $uclima[0]->r34;
                $this->model->r35                = $uclima[0]->r35;
                $this->model->r36                = $uclima[0]->r36;
                $this->model->r37                = $uclima[0]->r37;
                $this->model->r38                = $uclima[0]->r38;
                $this->model->r39                = $uclima[0]->r39;
                $this->model->r40                = $uclima[0]->r40;
                $this->model->r41                = $uclima[0]->r41;
                $this->model->r42                = $uclima[0]->r42;
                $this->model->r43                = $uclima[0]->r43;
                $this->model->r44                = $uclima[0]->r44;
                $this->model->r45                = $uclima[0]->r45;
                $this->model->r46                = $uclima[0]->r46;
                $this->model->r47                = $uclima[0]->r47;
                $this->model->r48                = $uclima[0]->r48;
                $this->model->r49                = $uclima[0]->r49;
                $this->model->r50                = $uclima[0]->r50;
                $this->model->r51                = $uclima[0]->r51;
                $this->model->r52                = $uclima[0]->r52;
                $this->model->r53                = $uclima[0]->r53;
                $this->model->r54                = $uclima[0]->r54;
                $this->model->r55                = $uclima[0]->r55;
                $this->model->r56                = $uclima[0]->r56;
                $this->model->r57                = $uclima[0]->r57;
                $this->model->r58                = $uclima[0]->r58;
                $this->model->r59                = $uclima[0]->r59;
                $this->model->r60                = $uclima[0]->r60;
                $this->model->r61                = $uclima[0]->r61;
                $this->model->r62                = $uclima[0]->r62;
                $this->model->r63                = $uclima[0]->r63;
                $this->model->r64                = $uclima[0]->r64;
                $this->model->r65                = $uclima[0]->r65;
                $this->model->r66                = $uclima[0]->r66;
                $this->model->r67                = $uclima[0]->r67;
                $this->model->r68                = $uclima[0]->r68;
                $this->model->r69                = $uclima[0]->r69;
                $this->model->r70                = $uclima[0]->r70;
                $this->model->r71                = $uclima[0]->r71;
                $this->model->r72                = $uclima[0]->r72;
                $this->model->r73                = $uclima[0]->r73;
                $this->model->r74                = $uclima[0]->r74;
                $this->model->r75                = $uclima[0]->r75;
                $this->model->r76                = $uclima[0]->r76;
                $this->model->r77                = $uclima[0]->r77;
                $this->model->r78                = $uclima[0]->r78;
                $this->model->r79                = $uclima[0]->r79;
                $this->model->r80                = $uclima[0]->r80;
                $this->model->r81                = $uclima[0]->r81;
                $this->model->r82                = $uclima[0]->r82;
                $this->model->r83                = $uclima[0]->r83;
                $this->model->r84                = $uclima[0]->r84;
                $this->model->r85                = $uclima[0]->r85;
                $this->model->r86                = $uclima[0]->r86;
                $this->model->r87                = $uclima[0]->r87;
                $this->model->r88                = $uclima[0]->r88;
                $this->model->r89                = $uclima[0]->r89;
                $this->model->r90                = $uclima[0]->r90;
                $this->model->r91                = $uclima[0]->r91;
                $this->model->r92                = $uclima[0]->r92;
                $this->model->r93                = $uclima[0]->r93;
                $this->model->r94                = $uclima[0]->r94;
                $this->model->r95                = $uclima[0]->r95;
                $this->model->r96                = $uclima[0]->r96;
                $this->model->r97                = $uclima[0]->r97;
                $this->model->r98                = $uclima[0]->r98;
                $this->model->r99                = $uclima[0]->r99;
                $this->model->r100               = $uclima[0]->r100;
                $this->model->r101               = $uclima[0]->r101;
                $this->model->r102               = $uclima[0]->r102;
                $this->model->r103               = $uclima[0]->r103;
                $this->model->r104               = $uclima[0]->r104;
                $this->model->activo             = true;
                $this->pon_atributos();
                // pone el ultimo periodo activo registrado
                //$this->model_to_session();                                
                return $this->createval2( $request);
            }
        }
        // no existe formato Clima
        $clima_nvo =   $this->clima_blank();
        $this->model = $clima_nvo;

        $this->model->fk_id_plantillas  = $this->plantilla[0]->id;
        $this->model->num_emp           = $this->plantilla[0]->num_emp;
        $this->model->nombre_completo   = $this->plantilla[0]->nombre_completo;
        $this->model->dep_o_ent         = $this->plantilla[0]->dependencia;
        $this->model->unidad_admva      = $this->plantilla[0]->unidad_admva;

        //$this->model_to_session();        
        return $this->createval2( $request);
      }
      // ELSE  if( count($plan) > 0), no se enocntr+o en plantilla
      else  
      {       
        $msg = "El Número de Empleado = '".$num_emp. 
        "' y dependencia = '".$dep_o_ent .
        "', no pudo ser localizado en plantillas.";    
        return redirect("/cons1")
            ->with('mensaje', $msg)
            ->with('num_emp',$num_emp)
            ->with('dependencia',$dep_o_ent)
            ;            
      }
    }
    // viene del controller    
    public function cons2(Request $request) 
    {   
        $vista= view('consideraciones2');
        return $vista;                
    }
    // viene del controller
    public function cons1(Request $request) 
    {   
        $vista= $this->indexblank2( $request);
        return $vista;        
    }
    //////////////////////////////////////////////
    private function get_last_id() 
    {
        $last = DB::table('climas')->latest('id')->first();       
        return $last;
    }
    private function get_user_data() 
    {
      $datos=[
        "usuario"=>Auth::user()->name,
        "email"=>Auth::user()->email,
        "success"=>"Error, Solo pueden entrar Administradores a esta opción"
      ]; 
      return $datos;
    }
    private function es_administrador() 
    {
      if (Auth::user()->fk_cve_perfil_usuario != "A") 
      {
        return back()->with('success', 'Error, solo pueden ingresar los Administradores.');  
      }
      return "Si";
    }        
    private function perfil_usuarios()
    {
        return( Perfilusers::all()->SortBy('cve_perfil_usuario'));
    }
    private function perfil_climas()
    {
        return( Perfilclimas::all()->SortBy('id'));
    }
    private function usuarios()
    {        
        return( User::all()->SortBy('email'));
    }
    private function periodos()
    {        
        return( Periodos::all()->SortBy('cve_periodo'));
    }
    private function ultimo_periodo()
    {                
        return( DB::table('periodos')->orderBy('cve_periodo', 'DESC')
        ->where('periodos.activo', '=', true)
        ->first());
    }
    private function dependencias_de_plantillas()
    {                
        return Plantillas::select('dependencia')->
            distinct()->
            orderBy('dependencia','ASC')->
            get();
    }
    private function all()
    {
        return $this->model->orderBy('id', 'asc')->paginate(5);
    }
    private function clima_blank(){
        $climas = Climas::FindOrFail(1);
        // obtiene el ultimo periodo de la tabla
        $climas->fk_cve_periodo= $this->ultimo_periodo()->cve_periodo;
        $climas->fecha= date("Y-m-d");
        $climas->area= '';
        $climas->r1                 = '';
        $climas->r2                 = '';
        $climas->r3                 = '';
        $climas->r4                 = '';
        $climas->r5                 = '';
        $climas->r6                 = '';
        $climas->r7                 = '';
        $climas->r8                 = '';
        $climas->r9                 = '';
        $climas->r10                = '';
        $climas->r11                = '';
        $climas->r12                = '';
        $climas->r13                = '';
        $climas->r14                = '';
        $climas->r15                = '';
        $climas->r16                = '';
        $climas->r17                = '';
        $climas->r18                = '';
        $climas->r19                = '';
        $climas->r20                = '';
        $climas->r21                = '';
        $climas->r22                = '';
        $climas->r23                = '';
        $climas->r24                = '';
        $climas->r25                = '';
        $climas->r26                = '';
        $climas->r27                = '';
        $climas->r28                = '';
        $climas->r29                = '';
        $climas->r30                = '';
        $climas->r31                = '';
        $climas->r32                = '';
        $climas->r33                = '';
        $climas->r34                = '';
        $climas->r35                = '';
        $climas->r36                = '';
        $climas->r37                = '';
        $climas->r38                = '';
        $climas->r39                = '';
        $climas->r40                = '';
        $climas->r41                = '';
        $climas->r42                = '';
        $climas->r43                = '';
        $climas->r44                = '';
        $climas->r45                = '';
        $climas->r46                = '';
        $climas->r47                = '';
        $climas->r48                = '';
        $climas->r49                = '';
        $climas->r50                = '';
        $climas->r51                = '';
        $climas->r52                = '';
        $climas->r53                = '';
        $climas->r54                = '';
        $climas->r55                = '';
        $climas->r56                = '';
        $climas->r57                = '';
        $climas->r58                = '';
        $climas->r59                = '';
        $climas->r60                = '';
        $climas->r61                = '';
        $climas->r62                = '';
        $climas->r63                = '';
        $climas->r64                = '';
        $climas->r65                = '';
        $climas->r66                = '';
        $climas->r67                = '';
        $climas->r68                = '';
        $climas->r69                = '';
        $climas->r70                = '';
        $climas->r71                = '';
        $climas->r72                = '';
        $climas->r73                = '';
        $climas->r74                = '';
        $climas->r75                = '';
        $climas->r76                = '';
        $climas->r77                = '';
        $climas->r78                = '';
        $climas->r79                = '';
        $climas->r80                = '';
        $climas->r81                = '';
        $climas->r82                = '';
        $climas->r83                = '';
        $climas->r84                = '';
        $climas->r85                = '';
        $climas->r86                = '';
        $climas->r87                = '';
        $climas->r88                = '';
        $climas->r89                = '';
        $climas->r90                = '';
        $climas->r91                = '';
        $climas->r92                = '';
        $climas->r93                = '';
        $climas->r94                = '';
        $climas->r95                = '';
        $climas->r96                = '';
        $climas->r97                = '';
        $climas->r98                = '';
        $climas->r99                = '';
        $climas->r100               = '';
        $climas->r101               = '';
        $climas->r102               = '';
        $climas->r103               = '';
        $climas->r104               = '';
        $climas->activo             = true;
        $this->model = $climas;
        return ( $climas);
    }   
    private function fix_datos_climas(Request $request)
    {        
        // elimina la variables _token , _method, y activao
        $datos_climas = request()->except('_token', '_method', "activao","activa");
        $datos_climas['activo'] = filter_var($request->activao, FILTER_VALIDATE_BOOLEAN);
        $datos_climas['fk_cve_periodo'] = $this->ultimo_periodo->cve_periodo;
        unset($datos_climas['btn_ok']);
        unset($datos_climas['num_emp']);
        unset($datos_climas['nombre_completo']);
        unset($datos_climas['dep_o_ent']);
        unset($datos_climas['unidad_admva']);
        for ($i = 1; $i <= 104; $i++) 
        {
            $is = strval($i);
            if ($datos_climas['r'.$is] == null){ $datos_climas['r'.$is] = 0;}
            if (strlen($is)==1){ $is= "00".$is;}
            if (strlen($is)==2){ $is= "0".$is;}             
            unset($datos_climas['r'.$is.'_1']);
            unset($datos_climas['r'.$is.'_2']);
            unset($datos_climas['r'.$is.'_3']);
            unset($datos_climas['r'.$is.'_4']);
        }        
        return ($datos_climas);
    }
    private function pon_atributos()
    {
        // es de Laravel getAttrinutes()
        $arreglo = $this->model->getAttributes();
        for ($i = 1; $i <= 104; $i++) {
            $is = strval($i);
            $tis = $is;
            if (strlen($is)==1){ $tis= "00".$is;}
            if (strlen($is)==2){ $tis= "0".$is;} 
            if ($arreglo['r'.$is]=="1") 
            {
                $this->model->setAttribute("r".$tis."_1", "on");
                //$this->model->setAttribute("r".$tis."_2", "on");
                //$this->model->setAttribute("r".$tis."_3", "on");
                //$this->model->setAttribute("r".$tis."_4", "on");
            } elseif ($arreglo['r'.$is]=="2") 
            {
                $this->model->setAttribute("r".$tis."_2", "on");
            }
            elseif ($arreglo['r'.$is]=="3")
            {
                $this->model->setAttribute("r".$tis."_3", "on");
            }
            elseif ($arreglo['r'.$is]=="4")
            {
                $this->model->setAttribute("r".$tis."_4", "on");
            }
        }        
    }
    private function editclima( $id)
    {        
        $this->model = $this->model->FindOrFail( $id);        
        $this->pon_atributos();
        return $this->model;
    }
    private function save(Request $request, $id)
    {
        $campos=        $this->get_campos_val();
        $mensajes=      $this->get_mensajes_val();
        $this->validate( $request, $campos, $mensajes);
        $datos_climas = $this->fix_datos_climas( $request);        
        $this->model->where('id', '=', $id)->update( $datos_climas);
    }
    private function get_campos_clima()
    {
        $campos=[         
            'climas.id',
            'climas.fk_id_plantillas',
            'climas.fk_cve_periodo',
            'climas.fecha',
            'climas.area',
'climas.r1', 'climas.r2', 'climas.r3', 'climas.r4', 'climas.r5', 'climas.r6', 'climas.r7', 'climas.r8', 'climas.r9', 'climas.r10', 
'climas.r11', 'climas.r12', 'climas.r13', 'climas.r14', 'climas.r15', 'climas.r16', 'climas.r17', 'climas.r18', 'climas.r19', 'climas.r20', 
'climas.r21', 'climas.r22', 'climas.r23', 'climas.r24', 'climas.r25', 'climas.r26', 'climas.r27', 'climas.r28', 'climas.r29', 'climas.r30', 
'climas.r31', 'climas.r32', 'climas.r33', 'climas.r34', 'climas.r35', 'climas.r36', 'climas.r37', 'climas.r38', 'climas.r39', 'climas.r40', 
'climas.r41', 'climas.r42', 'climas.r43', 'climas.r44', 'climas.r45', 'climas.r46', 'climas.r47', 'climas.r48', 'climas.r49', 'climas.r50', 
'climas.r51', 'climas.r52', 'climas.r53', 'climas.r54', 'climas.r55', 'climas.r56', 'climas.r57', 'climas.r58', 'climas.r59', 'climas.r60', 
'climas.r61', 'climas.r62', 'climas.r63', 'climas.r64', 'climas.r65', 'climas.r66', 'climas.r67', 'climas.r68', 'climas.r69', 'climas.r70', 
'climas.r71', 'climas.r72', 'climas.r73', 'climas.r74', 'climas.r75', 'climas.r76', 'climas.r77', 'climas.r78', 'climas.r79', 'climas.r80', 
'climas.r81', 'climas.r82', 'climas.r83', 'climas.r84', 'climas.r85', 'climas.r86', 'climas.r87', 'climas.r88', 'climas.r89', 'climas.r90', 
'climas.r91', 'climas.r92', 'climas.r93', 'climas.r94', 'climas.r95', 'climas.r96', 'climas.r97', 'climas.r98', 'climas.r99', 'climas.r100', 
'climas.r101', 'climas.r102', 'climas.r103', 'climas.r104', 
            'climas.activo',                 
            'periodos.descripcion as periodo_descripcion',
            'periodos.activo as periodo_activo',
            'plantillas.num_emp as plantilla_num_emp',
            'plantillas.nombre_completo as plantilla_nombre_completo',
            'plantillas.sexo as plantilla_sexo',
            'plantillas.nivel as plantilla_nivel',
            'plantillas.dependencia as plantilla_dependencia',
            'plantillas.unidad_admva as plantilla_unidad_admva',
            'plantillas.puesto as plantilla_puesto',
            'plantillas.activo as plantilla_activo'
        ];
        return $campos;
    }
    private function get_campos_val()
    {
        $campos=[
            'fk_cve_periodo'=> 'required|string|max:3|min:1',
            'area'=> 'required|string|max:180|min:5', 
            'r1'=> 'required|string|max:1|min:1|gt:0|lt:5',
            /*
            'r2'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r3'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r4'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r5'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r6'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r7'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r8'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r9'=> 'required|string|max:1|min:1|gt:0|lt:5',
            'r10'=> 'required|string|max:1|min:1|gt:0|lt:5',
            */
        ];
        return $campos;
    }
    private function get_mensajes_val()
    {
        $mensajes=[            
            'fk_cve_periodo.required'=>'El Periodo es requerido, debe contener al menos 1 caracter.',
            'fk_cve_periodo.min'=>'El Periodo debe contener al menos 1 caracter.',
            'fk_cve_periodo.max'=>'El Periodo debe contener máximo 3 caracteres.',            
            'area.required'=>'El Area es requerida',
            'area.min'=>'El Area debe tener al menos 5 caracteres.',
            'area.max'=>'El Area debe tener como máximo 180 caracteres.',  
            'r1.required'=>'La respuesta 1 es requerida, este error no debe pasar, reportar a Sistemas',
            'r1.gt'=>'La respuesta 1 debe ser mayor que cero, este error no debe pasar, reportar a Sistemas',
            'r1.lt'=>'La respuesta 1 debe ser menor que cinco, este error no debe pasar, reportar a Sistemas',
        ];
        return $mensajes;
    }    
    private function importclima(Request $request) 
    {
      $datos= $this->get_user_data();              
      $clean = $request->clean;
      if ($clean == 'Limpiar')
      {
          DB::table('climas')->where('id', '>', 1)->delete();
          return back()->with('success', 'Tabla de Formatos de Clima Organizacional limpiada, excepto el primer registro.');
      } // end if ($clean)
      else 
      {
        $this->validate($request, 
          [ 'select_file'  => 'required|mimes:xls,xlsx'   ], 
          [ 'select_file.required'=>'Se pide un archivo de Excel con extensión .xls o .xlsx' ]
        );
         $path1 = $request->file('select_file')->store('temp'); 
         $path = storage_path('app').'/'.$path1;          
         try {          
          $data = Excel::toCollection(new ClimasImport, $path);
          $existentes = 0;          
          if($data->count() > 0)
          {
           foreach($data->toArray() as $key => $value)
           {            
            foreach($value as $row)
            {              
              if (! (               
                isset($row['cve_plantilla']) &&
                isset($row['cve_periodo']) &&  
                isset($row['fecha']) &&  
                isset($row['area']) 
                ))
              {                 
                  return back()->with('success', 
                  'Error: El archivo de Excel de Formatos de Clima Organizacional debe tener las columnas siguientes : '.
                  "cve_plantilla, cve_periodo, fecha y area. ".
                  "Alguno de ellos esta faltando. ".
                  "Vea la documentación Técnica para importar formatos Clima Organizacional llenos y vacíos."
                   );                
              } // end if(!)              
              $climas = DB::table('climas')
                ->where('fk_id_plantillas', $row['cve_plantilla'])
                ->where('fk_cve_periodo', $row['cve_periodo'])
                ->get();
              if ( $climas->isNotEmpty()) {
                $existentes= $existentes + 1;
              }
              else 
              { 
               if (isset($row['r1'])) 
               {
                $insert_data[] = array(                
                    'fk_id_plantillas' => $row['cve_plantilla'],
                    'fk_cve_periodo'   => $row['cve_periodo'], 
                    'fecha'            => $row['fecha'], 
                    'area'             => $row['area'],
'r1'=>$row['r1'], 'r2'=>$row['r2'], 'r3'=>$row['r3'],'r4'=>$row['r4'], 'r5'=>$row['r5'], 'r6'=> $row['r6'], 'r7'               => $row['r7'],
                    'r8'               => $row['r8'],
                    'r9'               => $row['r9'],
                    'r10'              => $row['r10'],
                    'r11'              => $row['r11'],
                    'r12'              => $row['r12'],
                    'r13'              => $row['r13'],
                    'r14'              => $row['r14'],
                    'r15'              => $row['r15'],
                    'r16'              => $row['r16'],
                    'r17'              => $row['r17'],
                    'r18'              => $row['r18'],
                    'r19'              => $row['r19'],
                    'r20'              => $row['r20'],
                    'r21'              => $row['r21'],
                    'r22'              => $row['r22'],
                    'r23'              => $row['r23'],
                    'r24'              => $row['r24'],
                    'r25'              => $row['r25'],
                    'r26'              => $row['r26'],
                    'r27'              => $row['r27'],
                    'r28'              => $row['r28'],
                    'r29'              => $row['r29'],
                    'r30'              => $row['r30'],
                    'r31'              => $row['r31'],
                    'r32'              => $row['r32'],
                    'r33'              => $row['r33'],
                    'r34'              => $row['r34'],
                    'r35'              => $row['r35'],
                    'r36'              => $row['r36'],
                    'r37'              => $row['r37'],
                    'r38'              => $row['r38'],
                    'r39'              => $row['r39'],
                    'r40'              => $row['r40'],
                    'r41'              => $row['r41'],
                    'r42'              => $row['r42'],
                    'r43'              => $row['r43'],
                    'r44'              => $row['r44'],
                    'r45'              => $row['r45'],
                    'r46'              => $row['r46'],
                    'r47'              => $row['r47'],
                    'r48'              => $row['r48'],
                    'r49'              => $row['r49'],
                    'r50'              => $row['r50'],
                    'r51'              => $row['r51'],
                    'r52'              => $row['r52'],
                    'r53'              => $row['r53'],
                    'r54'              => $row['r54'],
                    'r55'              => $row['r55'],
                    'r56'              => $row['r56'],
                    'r57'              => $row['r57'],
                    'r58'              => $row['r58'],
                    'r59'              => $row['r59'],
                    'r60'              => $row['r60'],
                    'r61'              => $row['r61'],
                    'r62'              => $row['r62'],
                    'r63'              => $row['r63'],
                    'r64'              => $row['r64'],
                    'r65'              => $row['r65'],
                    'r66'              => $row['r66'],
                    'r67'              => $row['r67'],
                    'r68'              => $row['r68'],
                    'r69'              => $row['r69'],
                    'r70'              => $row['r70'],
                    'r71'              => $row['r71'],
                    'r72'              => $row['r72'],
                    'r73'              => $row['r73'],
                    'r74'              => $row['r74'],
                    'r75'              => $row['r75'],
                    'r76'              => $row['r76'],
                    'r77'              => $row['r77'],
                    'r78'              => $row['r78'],
                    'r79'              => $row['r79'],
                    'r80'              => $row['r80'],
                    'r81'              => $row['r81'],
                    'r82'              => $row['r82'],
                    'r83'              => $row['r83'],
                    'r84'              => $row['r84'],
                    'r85'              => $row['r85'],
                    'r86'              => $row['r86'],
                    'r87'              => $row['r87'],
                    'r88'              => $row['r88'],
                    'r89'              => $row['r89'],
                    'r90'              => $row['r90'],
                    'r91'              => $row['r91'],
                    'r92'              => $row['r92'],
                    'r93'              => $row['r93'],
                    'r94'              => $row['r94'],
                    'r95'              => $row['r95'],
                    'r96'              => $row['r96'],
                    'r97'              => $row['r97'],
                    'r98'              => $row['r98'],
                    'r99'              => $row['r99'],
                    'r100'             => $row['r100'],
                    'r101'             => $row['r101'],
                    'r102'             => $row['r102'],
                    'r103'             => $row['r103'],
                    'r104'             => $row['r104'],
                    );                  
               } // end if isset($row['word_int'])
               else
               {
                $insert_data[] = array(                
                    'fk_id_plantillas' => $row['cve_plantilla'],
                    'fk_cve_periodo'   => $row['cve_periodo'], 
                    'fecha'            => $row['fecha'], 
                    'area'             => $row['area']
                );
               } //end else isset($row['word_int'])
              } // end if (isset($row['r1'])) 
            } // end foreach($value as $row)
           } // end foreach($data->toArray() as $key => $value)
           $suma = 0;
           if(!empty($insert_data))
           {            
            $suma = count($insert_data);
            //DB::table('climas')->insert($insert_data);
            foreach (array_chunk($insert_data,1000) as $t) 
            {
                DB::table('climas')->insert($t);
            }
           } // end if(!empty)
          } // end if($data)
          return back()->with('success', 
            'El archivo de Formatos Clima Organizacional de Excel se subió con éxito. '.
            "Se repitieron ".$existentes." registro(s)".
            " y se subieron ".$suma. " registro(s).");         
          //$data = Excel::import(new UsersImport,$path);
          //return back()->with('success', 'El archivo de Uusarios de Excel se subió con éxito.');
        } 
        catch (\Illuminate\Database\QueryException $e) 
        {
            return back()->with('success', 'Ocurrió un error:  '.$e->errorInfo[2]);
        } // end catch
      } // end else $clean == 'Limpiar'
    } // end import function   
    private function export( Request $request, $action) 
    {
        if ($action== "1") {
            return Excel::download(new UsersExport, 'usuarios.xlsx');
        }
        if ($action== "2") {
            return Excel::download(new ClimasExport, 'climas.xlsx');
        }
        if ($action== "3") {
            
            return Excel::download(new PlantillasExport, 'plantillas.xlsx');        
        }
        return ('Opción Inválida'); 
    }
    private function reportes( Request $request, $repo) 
    {
    $periodos           = $this->periodos();    
    if ($repo == "1") { return "En proceso reporte de Usuarios"; }
    if ($repo == "2") { return $this->repo_climas(); }
    if ($repo == "3") { return "En proceso reporte de Plantillas"; }          
    }
    private function dependencias()
    {           
        return Climas::all()->sortBy("plantillas.dependencia")->unique("plantillas.dependencia");
    }
    private function unidades()
    {   
        return Climas::all()->sortBy("plantillas.unidad_admva")->unique("plantillas.unidad_admva");
    }
    private function areas()
    {   
        return Climas::all()->sortBy("area")->unique("area");
    }
    private function First()
    {             
        return( $this->model->First());    
    }
    private function get_all_climas( Request $request)
    {
        $climas = DB::table('climas')
            ->join('plantillas', 'plantillas.id', '=', 'climas.fk_id_plantillas')
            ->join('periodos', 'periodos.cve_periodo', '=', 'climas.fk_cve_periodo')            
            ->orderBy('plantillas.num_emp', 'ASC')
            ->orderBy('climas.fk_cve_periodo', 'DESC')
            ->where('climas.fk_cve_periodo', '>=',$request->periodoini)
            ->where('climas.fk_cve_periodo', '<=',$request->periodofin)
            ->where('plantillas.dependencia', '>=',$request->dependenciaini)
            ->where('plantillas.dependencia', '<=',$request->dependenciafin)
            ->where('plantillas.unidad_admva', '>=',$request->unidadini)
            ->where('plantillas.unidad_admva', '<=',$request->unidadfin)
            ->where('area', '>=',$request->areaini)
            ->where('area', '<=',$request->areafin)
            ->select( $this->get_campos_clima())
            ->get();
        return $climas;
    }
    private function climasrepodet( Request $request)
    {        
        if ($request->num_emp> "0") 
        {            
            $climas = DB::table('climas')
            ->join('plantillas', 'plantillas.id', '=', 'climas.fk_id_plantillas')
            ->join('periodos', 'periodos.cve_periodo', '=', 'climas.fk_cve_periodo')            
            ->orderBy('plantillas.num_emp', 'ASC')
            ->orderBy('climas.fk_cve_periodo', 'DESC')
            ->where('climas.fk_cve_periodo', '>=',$request->periodoini)
            ->where('climas.fk_cve_periodo', '<=',$request->periodofin)
            ->where('plantillas.dependencia', '>=',$request->dependenciaini)
            ->where('plantillas.dependencia', '<=',$request->dependenciafin)
            ->where('plantillas.unidad_admva', '>=',$request->unidadini)
            ->where('plantillas.unidad_admva', '<=',$request->unidadfin)
            ->where('climas.area', '>=',$request->areaini)
            ->where('climas.area', '<=',$request->areafin)
            ->where('plantillas.num_emp', '=',$request->num_emp)
            ->select($this->get_campos_clima())                
            ->get();
        } else 
        {
            $climas= $this->get_all_climas( $request);
        } // ENDIF
        if(count($climas) < 1) 
        {
            $err = 'Error: No se encontró ningún Formato de CLima Org. con las condiciones: No. de empleado='. 
                $request->num_emp. 
                ", dependencia>=". $request->dependenciaini.
                " y dependencia<=".$request->dependenciafin. 
                ", UA >=".$request->unidadini.
                "y  UA <=".$request->unidadfin.
                ", area >=".$request->areani.
                "y  area <=".$request->areafin.
                ", periodo inicial >=".
                $request->periodoini." y periodo final<=".$request->periodofin;
            session(['num_emp'          => $request->num_emp]);
            session(['dependenciaini'   => $request->dependenciaini]);
            session(['dependenciafin'   => $request->dependenciafin]);
            session(['unidadini'        => $request->unidadini]);
            session(['unidadfin'        => $request->unidadfin]);
            session(['areaini'          => $request->areaini]);
            session(['areafin'          => $request->areafin]);
            session(['periodoini'       => $request->periodoini]);
            session(['periodofin'       => $request->periodofin]);

            return back()->with('mensaje', $err);
        } else 
        {            
            return view('admin/Climasreporte',compact('climas'));
        }
    }
    // aux reporte por dependencia
    private function perfiles_climas()
    {
        return Perfilclimas::all()->sortBy("id")->unique("id");
    }
    // aux reporte por dependencia
    private function climasrepodep_cli( Request $request)
    {       
       $climas = DB::table('climas')
            ->join('plantillas', 'plantillas.id', '=', 'climas.fk_id_plantillas')
            ->join('periodos', 'periodos.cve_periodo', '=', 'climas.fk_cve_periodo')     
            ->where('climas.fk_cve_periodo', '>=',$request->periodoini)
            ->where('climas.fk_cve_periodo', '<=',$request->periodofin)
            ->where('plantillas.dependencia', '>=',$request->dependenciaini)
            ->where('plantillas.dependencia', '<=',$request->dependenciafin)
            ->where('unidad_admva', '>=',$request->unidadini)
            ->where('unidad_admva', '<=',$request->unidadfin)
            ->where('climas.area', '>=',$request->areaini)
            ->where('climas.area', '<=',$request->areafin)
            ->GroupBy('plantillas.dependencia')
            ->selectRaw('count(climas.id) as totalp, count(climas.id) as total, plantillas.dependencia')
            ->get();
        return $climas; 
    }
    // aux 2 reporte por dependencia
    private function climasrepodep_error( Request $request)
    {
        $err = 'Error: No se encontró ningún Formato de Clima Org. con las condiciones: '.
        " dependencia>=". $request->dependenciaini.
        " y dependencia<=".$request->dependenciafin. 
        ", UA >=".$request->unidadini.
        "y  UA <=".$request->unidadfin.
        ", area >=".$request->areani.
        "y  area <=".$request->areafin.
        ", periodo inicial >=".
        $request->periodoini." y periodo final<=".$request->periodofin;            
        session(['dependenciaini'   => $request->dependenciaini]);
        session(['dependenciafin'   => $request->dependenciafin]);
        session(['unidadini'        => $request->unidadini]);
        session(['unidadfin'        => $request->unidadfin]);
        session(['areaini'          => $request->areaini]);
        session(['areafin'          => $request->areafin]);
        session(['periodoini'       => $request->periodoini]);
        session(['periodofin'       => $request->periodofin]);
        return back()->with('mensaje', $err);
    }
    // aux 3 reporte por dependencia
    private function climasrepodep_pla( Request $request)
    {
        $plantillas = DB::table('plantillas')
        ->where('dependencia', '>=',$request->dependenciaini)
        ->where('dependencia', '<=',$request->dependenciafin)
        ->where('unidad_admva', '>=',$request->unidadini)
        ->where('unidad_admva', '<=',$request->unidadfin)
        ->GroupBy('dependencia')
        ->selectRaw('count(id) as totalp, 0 as total, dependencia')
        ->get();
        return $plantillas;
    }
    // reporte por dependencia
    private function climasrepodep( Request $request)
    {        
        $climas = $this->climasrepodep_cli( $request);        
        if(count($climas) < 1) 
        {
            return $this->climasrepodep_error( $request);            
        } 
        else 
        {
            $plantillas= $this->climasrepodep_pla( $request);
            foreach($climas as $clima)
            {
                foreach($plantillas as $plantilla) 
                {
                    if($plantilla->dependencia == $clima->dependencia) 
                    {
                        $clima->totalp = $plantilla->totalp;
                    }
                    else
                    {
                        $climas->push($plantilla);
                    }
                }
            }
            return view('admin/Climasrepodep',compact('climas','plantillas'));
        }
    }    
    private function plantilla()
    {
        return $this->plantilla;
    }
    private function get_model() 
    {
        return $this->model;
    }
    private function searchmain()
    {        
        if ($this->search($request)=="SI" ) {
            $perfil_usuarios    = $this->perfil_usuarios();
            $usuarios           = $this->usuarios();
            $periodos           = $this->periodos();
            // pone el ultimo periodo activo registrado
            // y agrega los datos de la plabtilla
            $climas               = $this->get_model();
            return view('admin/Climas.createval', compact(
                'usuarios',
                'perfil_usuarios',
                'periodos',
                'climas'
              ));
          }
          else {
            return redirect("/admin/Climas")->with('mensaje','Empleado no localizado.');
          }
    } 
    private function session_to_model()
    {
        $model = Session::get('model');
        Session::forget('model');
        $this->model->fk_cve_periodo           = $model['fk_cve_periodo'];
        $this->model->fk_id_plantillas         = $model['fk_id_plantillas'];
        $this->model->fecha                    = $model['fecha'];
        $this->model->area                     = $model['area'];
        $this->model->r1                       = $model['r1'];
        $this->model->r2                       = $model['r2'];
        $this->model->r3                       = $model['r3'];
        $this->model->r4                       = $model['r4'];
        $this->model->r5                       = $model['r5'];
        $this->model->r6                       = $model['r6'];
        $this->model->r7                       = $model['r7'];
        $this->model->r8                       = $model['r8'];
        $this->model->r9                       = $model['r9'];
        $this->model->r10                      = $model['r10'];
        $this->model->r11                      = $model['r11'];
        $this->model->r12                      = $model['r12'];
        $this->model->r13                      = $model['r13'];
        $this->model->r14                      = $model['r14'];
        $this->model->r15                      = $model['r15'];
        $this->model->r16                      = $model['r16'];
        $this->model->r17                      = $model['r17'];
        $this->model->r18                      = $model['r18'];
        $this->model->r19                      = $model['r19'];
        $this->model->r20                      = $model['r20'];
        $this->model->r21                      = $model['r21'];
        $this->model->r22                      = $model['r22'];
        $this->model->r23                      = $model['r23'];
        $this->model->r24                      = $model['r24'];
        $this->model->r25                      = $model['r25'];
        $this->model->r26                      = $model['r26'];
        $this->model->r27                      = $model['r27'];
        $this->model->r28                      = $model['r28'];
        $this->model->r29                      = $model['r29'];
        $this->model->r30                      = $model['r30'];
        $this->model->r31                      = $model['r31'];
        $this->model->r32                      = $model['r32'];
        $this->model->r33                      = $model['r33'];
        $this->model->r34                      = $model['r34'];
        $this->model->r35                      = $model['r35'];
        $this->model->r36                      = $model['r36'];
        $this->model->r37                      = $model['r37'];
        $this->model->r38                      = $model['r38'];
        $this->model->r39                      = $model['r39'];
        $this->model->r40                      = $model['r40'];
        $this->model->r41                      = $model['r41'];
        $this->model->r42                      = $model['r42'];
        $this->model->r43                      = $model['r43'];
        $this->model->r44                      = $model['r44'];
        $this->model->r45                      = $model['r45'];
        $this->model->r46                      = $model['r46'];
        $this->model->r47                      = $model['r47'];
        $this->model->r48                      = $model['r48'];
        $this->model->r49                      = $model['r49'];
        $this->model->r50                      = $model['r50'];
        $this->model->r51                      = $model['r51'];
        $this->model->r52                      = $model['r52'];
        $this->model->r53                      = $model['r53'];
        $this->model->r54                      = $model['r54'];
        $this->model->r55                      = $model['r55'];
        $this->model->r56                      = $model['r56'];
        $this->model->r57                      = $model['r57'];
        $this->model->r58                      = $model['r58'];
        $this->model->r59                      = $model['r59'];
        $this->model->r60                      = $model['r60'];
        $this->model->r61                      = $model['r61'];
        $this->model->r62                      = $model['r62'];
        $this->model->r63                      = $model['r63'];
        $this->model->r64                      = $model['r64'];
        $this->model->r65                      = $model['r65'];
        $this->model->r66                      = $model['r66'];
        $this->model->r67                      = $model['r67'];
        $this->model->r68                      = $model['r68'];
        $this->model->r69                      = $model['r69'];
        $this->model->r70                      = $model['r70'];
        $this->model->r71                      = $model['r71'];
        $this->model->r72                      = $model['r72'];
        $this->model->r73                      = $model['r73'];
        $this->model->r74                      = $model['r74'];
        $this->model->r75                      = $model['r75'];
        $this->model->r76                      = $model['r76'];
        $this->model->r77                      = $model['r77'];
        $this->model->r78                      = $model['r78'];
        $this->model->r79                      = $model['r79'];
        $this->model->r80                      = $model['r80'];
        $this->model->r81                      = $model['r81'];
        $this->model->r82                      = $model['r82'];
        $this->model->r83                      = $model['r83'];
        $this->model->r84                      = $model['r84'];
        $this->model->r85                      = $model['r85'];
        $this->model->r86                      = $model['r86'];
        $this->model->r87                      = $model['r87'];
        $this->model->r88                      = $model['r88'];
        $this->model->r89                      = $model['r89'];
        $this->model->r90                      = $model['r90'];
        $this->model->r91                      = $model['r91'];
        $this->model->r92                      = $model['r92'];
        $this->model->r93                      = $model['r93'];
        $this->model->r94                      = $model['r94'];
        $this->model->r95                      = $model['r95'];
        $this->model->r96                      = $model['r96'];
        $this->model->r97                      = $model['r97'];
        $this->model->r98                      = $model['r98'];
        $this->model->r99                      = $model['r99'];
        $this->model->r100                     = $model['r100'];
        $this->model->r101                     = $model['r101'];
        $this->model->r102                     = $model['r102'];
        $this->model->r103                     = $model['r103'];
        $this->model->r104                     = $model['r104'];
        $this->model->activo                   = $model['activo'];
        $this->model->activao                  = $model['activao'];
    }
    private function request_to_model( $request)
    {            
        $this->model->fk_cve_periodo = $request->fk_cve_periodo;
        $this->model->fk_id_plantillas = $request->fk_id_plantillas;
        $this->model->fecha = $request->fecha;
        $this->model->area = $request->area;
        $this->model->r1                       = $request->r1;
        $this->model->r2                       = $request->r2;
        $this->model->r3                       = $request->r3;
        $this->model->r4                       = $request->r4;
        $this->model->r5                       = $request->r5;
        $this->model->r6                       = $request->r6;
        $this->model->r7                       = $request->r7;
        $this->model->r8                       = $request->r8;
        $this->model->r9                       = $request->r9;
        $this->model->r10                      = $request->r10;
        $this->model->r11                      = $request->r11;
        $this->model->r12                      = $request->r12;
        $this->model->r13                      = $request->r13;
        $this->model->r14                      = $request->r14;
        $this->model->r15                      = $request->r15;
        $this->model->r16                      = $request->r16;
        $this->model->r17                      = $request->r17;
        $this->model->r18                      = $request->r18;
        $this->model->r19                      = $request->r19;
        $this->model->r20                      = $request->r20;
        $this->model->r21                      = $request->r21;
        $this->model->r22                      = $request->r22;
        $this->model->r23                      = $request->r23;
        $this->model->r24                      = $request->r24;
        $this->model->r25                      = $request->r25;
        $this->model->r26                      = $request->r26;
        $this->model->r27                      = $request->r27;
        $this->model->r28                      = $request->r28;
        $this->model->r29                      = $request->r29;
        $this->model->r30                      = $request->r30;
        $this->model->r31                      = $request->r31;
        $this->model->r32                      = $request->r32;
        $this->model->r33                      = $request->r33;
        $this->model->r34                      = $request->r34;
        $this->model->r35                      = $request->r35;
        $this->model->r36                      = $request->r36;
        $this->model->r37                      = $request->r37;
        $this->model->r38                      = $request->r38;
        $this->model->r39                      = $request->r39;
        $this->model->r40                      = $request->r40;
        $this->model->r41                      = $request->r41;
        $this->model->r42                      = $request->r42;
        $this->model->r43                      = $request->r43;
        $this->model->r44                      = $request->r44;
        $this->model->r45                      = $request->r45;
        $this->model->r46                      = $request->r46;
        $this->model->r47                      = $request->r47;
        $this->model->r48                      = $request->r48;
        $this->model->r49                      = $request->r49;
        $this->model->r50                      = $request->r50;
        $this->model->r51                      = $request->r51;
        $this->model->r52                      = $request->r52;
        $this->model->r53                      = $request->r53;
        $this->model->r54                      = $request->r54;
        $this->model->r55                      = $request->r55;
        $this->model->r56                      = $request->r56;
        $this->model->r57                      = $request->r57;
        $this->model->r58                      = $request->r58;
        $this->model->r59                      = $request->r59;
        $this->model->r60                      = $request->r60;
        $this->model->r61                      = $request->r61;
        $this->model->r62                      = $request->r62;
        $this->model->r63                      = $request->r63;
        $this->model->r64                      = $request->r64;
        $this->model->r65                      = $request->r65;
        $this->model->r66                      = $request->r66;
        $this->model->r67                      = $request->r67;
        $this->model->r68                      = $request->r68;
        $this->model->r69                      = $request->r69;
        $this->model->r70                      = $request->r70;
        $this->model->r71                      = $request->r71;
        $this->model->r72                      = $request->r72;
        $this->model->r73                      = $request->r73;
        $this->model->r74                      = $request->r74;
        $this->model->r75                      = $request->r75;
        $this->model->r76                      = $request->r76;
        $this->model->r77                      = $request->r77;
        $this->model->r78                      = $request->r78;
        $this->model->r79                      = $request->r79;
        $this->model->r80                      = $request->r80;
        $this->model->r81                      = $request->r81;
        $this->model->r82                      = $request->r82;
        $this->model->r83                      = $request->r83;
        $this->model->r84                      = $request->r84;
        $this->model->r85                      = $request->r85;
        $this->model->r86                      = $request->r86;
        $this->model->r87                      = $request->r87;
        $this->model->r88                      = $request->r88;
        $this->model->r89                      = $request->r89;
        $this->model->r90                      = $request->r90;
        $this->model->r91                      = $request->r91;
        $this->model->r92                      = $request->r92;
        $this->model->r93                      = $request->r93;
        $this->model->r94                      = $request->r94;
        $this->model->r95                      = $request->r95;
        $this->model->r96                      = $request->r96;
        $this->model->r97                      = $request->r97;
        $this->model->r98                      = $request->r98;
        $this->model->r99                      = $request->r99;
        $this->model->r100                     = $request->r100;
        $this->model->r101                     = $request->r101;
        $this->model->r102                     = $request->r102;
        $this->model->r103                     = $request->r103;
        $this->model->r104                     = $request->r104;
        $this->model->activo = $request->activo;  
        $this->model->activao = $request->activao;
        
    }    
    // aqui brinca el boton de grabar/agregar
    private function model_to_session()
    {
        Session::forget('model');
        Session::put('model', $this->model);
    }
    private function model_to_request()
    {
        $request = new Request();
        $request->fk_cve_periodo = $this->model->fk_cve_periodo ;
        $request->fk_id_plantillas = $this->model->fk_id_plantillas ; 
        $request->fecha = $this->model->fecha;
        $request->area = $this->model->area;       
        $request->r1 = $this->model->r1;
        $request->r2 = $this->model->r2;
        $request->r3 = $this->model->r3;
        $request->r4 = $this->model->r4;
        $request->r5 = $this->model->r5;
        $request->r6 = $this->model->r6;
        $request->r7 = $this->model->r7;
        $request->r8 = $this->model->r8;
        $request->r9 = $this->model->r9;
        $request->r10 = $this->model->r10;
        $request->r11 = $this->model->r11;
        $request->r12 = $this->model->r12;
        $request->r13 = $this->model->r13;
        $request->r14 = $this->model->r14;
        $request->r15 = $this->model->r15;
        $request->r16 = $this->model->r16;
        $request->r17 = $this->model->r17;
        $request->r18 = $this->model->r18;
        $request->r19 = $this->model->r19;
        $request->r20 = $this->model->r20;
        $request->r21 = $this->model->r21;
        $request->r22 = $this->model->r22;
        $request->r23 = $this->model->r23;
        $request->r24 = $this->model->r24;
        $request->r25 = $this->model->r25;
        $request->r26 = $this->model->r26;
        $request->r27 = $this->model->r27;
        $request->r28 = $this->model->r28;
        $request->r29 = $this->model->r29;
        $request->r30 = $this->model->r30;
        $request->r31 = $this->model->r31;
        $request->r32 = $this->model->r32;
        $request->r33 = $this->model->r33;
        $request->r34 = $this->model->r34;
        $request->r35 = $this->model->r35;
        $request->r36 = $this->model->r36;
        $request->r37 = $this->model->r37;
        $request->r38 = $this->model->r38;
        $request->r39 = $this->model->r39;
        $request->r40 = $this->model->r40;
        $request->r41 = $this->model->r41;
        $request->r42 = $this->model->r42;
        $request->r43 = $this->model->r43;
        $request->r44 = $this->model->r44;
        $request->r45 = $this->model->r45;
        $request->r46 = $this->model->r46;
        $request->r47 = $this->model->r47;
        $request->r48 = $this->model->r48;
        $request->r49 = $this->model->r49;
        $request->r50 = $this->model->r50;
        $request->r51 = $this->model->r51;
        $request->r52 = $this->model->r52;
        $request->r53 = $this->model->r53;
        $request->r54 = $this->model->r54;
        $request->r55 = $this->model->r55;
        $request->r56 = $this->model->r56;
        $request->r57 = $this->model->r57;
        $request->r58 = $this->model->r58;
        $request->r59 = $this->model->r59;
        $request->r60 = $this->model->r60;
        $request->r61 = $this->model->r61;
        $request->r62 = $this->model->r62;
        $request->r63 = $this->model->r63;
        $request->r64 = $this->model->r64;
        $request->r65 = $this->model->r65;
        $request->r66 = $this->model->r66;
        $request->r67 = $this->model->r67;
        $request->r68 = $this->model->r68;
        $request->r69 = $this->model->r69;
        $request->r70 = $this->model->r70;
        $request->r71 = $this->model->r71;
        $request->r72 = $this->model->r72;
        $request->r73 = $this->model->r73;
        $request->r74 = $this->model->r74;
        $request->r75 = $this->model->r75;
        $request->r76 = $this->model->r76;
        $request->r77 = $this->model->r77;
        $request->r78 = $this->model->r78;
        $request->r79 = $this->model->r79;
        $request->r80 = $this->model->r80;
        $request->r81 = $this->model->r81;
        $request->r82 = $this->model->r82;
        $request->r83 = $this->model->r83;
        $request->r84 = $this->model->r84;
        $request->r85 = $this->model->r85;
        $request->r86 = $this->model->r86;
        $request->r87 = $this->model->r87;
        $request->r88 = $this->model->r88;
        $request->r89 = $this->model->r89;
        $request->r90 = $this->model->r90;
        $request->r91 = $this->model->r91;
        $request->r92 = $this->model->r92;
        $request->r93 = $this->model->r93;
        $request->r94 = $this->model->r94;
        $request->r95 = $this->model->r95;
        $request->r96 = $this->model->r96;
        $request->r97 = $this->model->r97;
        $request->r98 = $this->model->r98;
        $request->r99 = $this->model->r99;
        $request->r100 = $this->model->r100;
        $request->r101 = $this->model->r101;
        $request->r102 = $this->model->r102;
        $request->r103 = $this->model->r103;
        $request->r104 = $this->model->r104;
        $request->activo = $this->model->activo ;
        $request->activao = $this->model->activao ;        
        return $request;
    }    
    private function get_plantilla( $id)
    {
        $this->plantilla = DB::table('plantillas')                                
            ->where('plantillas.id', '=', $id)
            ->get();
        return $this->plantilla;
    }        
    // CRUD CLima Organizacional, Nivel Administrador
    public function indexcrud()
    {        
        $perfil_usuarios    = $this->perfil_usuarios();
        $usuarios           = $this->usuarios();
        $periodos           = $this->periodos();
        $datos['climas']    = $this->all();        
        return view('admin/Climas.index', $datos, compact(
          'perfil_usuarios',
          'periodos',
          'usuarios'));      
    }
    private function unidades_de_plantillas()
    {
    return Plantillas::select('unidad_admva')->
        distinct()->
        orderBy('unidad_admva','ASC')->
        get();
    }
    private function repo_climas()
    {        
        $climas =  $this->First();
        $dependencia = $this->dependencias_de_plantillas();     
        $unidad = $this->unidades_de_plantillas();
        $area = $this->areas();
        $periodo = $this->periodos();            
        $periodo_ini = $periodo->First()->cve_periodo;
        $periodo_fin = $periodo->Last()->cve_periodo;    
        $dependencia_ini = $dependencia->First()->dependencia;
        $dependencia_fin = $dependencia->Last()->dependencia;        
        $unidad_ini = $unidad->First()->unidad_admva;
        $unidad_fin = $unidad->Last()->unidad_admva;    
        $area_ini = $area->First()->area;
        $area_fin = $area->Last()->area;        
        return view('admin/Climasrepos',
            compact('dependencia','unidad','area','climas','periodo',
            'periodo_ini','periodo_fin',
            'dependencia_ini','dependencia_fin',
            'unidad_ini','unidad_fin',
            'area_ini','area_fin'
            ));        
    }    
    private function createval() 
    {        
        $vista= view('consideraciones');
        return $vista;        
    }
    private function indexblank2()
    {
      $perfil_usuarios          = $this->perfil_usuarios();
      $usuarios                 = $this->usuarios();
      $periodos                 = $this->periodos();
      $dependencias             = $this->dependencias_de_plantillas();      
      $clima                    = $this->clima_blank();
      $clima->fk_cve_periodo    = $this->ultimo_periodo()->cve_periodo;      
      return view('admin/Climas.blank', compact(
        'perfil_usuarios',
        'periodos',
        'usuarios',
        'dependencias',
        'clima'
      ));
    }
    private function createval2( Request $request) 
    {        
        $periodos           = $this->periodos();
        $des_uper           = $this->ultimo_periodo->descripcion;
        // y agrega los datos de la plabtilla
        $climas             = $this->model;
        $habilitado         = "No";        
        if ( $this->es_administrador() == "Si") {
            $habilitado = "Si";
        }
        return view('admin/Climas.createval', compact(
            'periodos',
            'des_uper',
            'habilitado',
            'climas'
        ));      
    }
    // aqui brinca el boton de grabar/agregar
    private function agrega( Request $request)
    {           
           $this->request_to_model( $request);
           //$this->model_to_session();
           $campos=        $this->get_campos_val();
           $mensajes=      $this->get_mensajes_val();              
           $this->model_to_session();
           // IMPORTANTE!!! brinca al metodo show() si hay error
           $this->validate( $request, $campos, $mensajes);           
           $climas= $this->fix_datos_climas( $request);           
           $this->model->insert( $climas);
    }
   // completa la vista del Usuario normal, viene de ??
   private function indexclima()
   {       
       $datos = [
           "usuario"=>Auth::user()->name,
           "cve_perfil_usuario"=>Auth::user()->fk_cve_perfil_usuario,
           "email"=>Auth::user()->email,
           "success"=>""
       ];       
       $clima = DB::table('climas')
            ->join('periodos', 'periodos.cve_periodo', '=', 'climas.fk_cve_periodo')
            ->join('plantillas', 'plantillas.id', '=', 'climas.id')
            ->orderBy('id', 'ASC')
            ->select( $this->get_campos_clima())
            ->where('climas.activo',true)
            ->where('periodos.activo',true)
            ->where('plantillas.activo',true)
            ->get();
       if ($clima->isEmpty())
       { 
           //session(['num_emp'   => $request->num_emp]);        
           $vista= back()->with("Error, tabla clima vacía o periodo inactivo o empleado(a) inactivo(a).");
           return $vista;
       };
        $vista= view('consideraciones',$datos);
        return $vista;
   }
   // reporte por perfil
   private function climasrepoper( Request $request)
   {       
      $perfil_climas    = $this->perfil_climas();
      $plantillas       = $this->dependencias_de_plantillas();
      DB::table('tempdep_climas')->truncate();
      //dd( $perfil_climas);
      foreach($plantillas as $plantilla)      
      {
         foreach($perfil_climas as $perfil_clima)
         {
            DB::table('tempdep_climas')->insert([                
                'dependencia' => $plantilla->dependencia,
                'cve_perfil_clima' => $perfil_clima->cve_perfil_clima,
                'descripcion_clima' => $perfil_clima->descripcion,
                'porcentaje' => '0.0',
                'pregunta_inicio' => $perfil_clima->pregunta_inicio,
                'pregunta_fin' => $perfil_clima->pregunta_fin,
                'ponderacion_1' => $perfil_clima->ponderacion_1,
                'ponderacion_2' => $perfil_clima->ponderacion_2,
                'ponderacion_3' => $perfil_clima->ponderacion_3,
                'ponderacion_4' => $perfil_clima->ponderacion_4,
                'porcentaje_minimo' => $perfil_clima->porcentaje_minimo,                
            ]);           
         }
      }      
      $tempdeps = DB::table('tempdep_climas')
            ->orderBy('dependencia', 'ASC')
            ->orderBy('cve_perfil_clima', 'ASC')            
            ->get();
      //dd($tempdeps);
      $climas= $this->get_all_climas( $request);
      foreach($climas as $clima)
      {
        foreach($tempdeps as $tempdep)
        {
            if($clima->plantilla_dependencia == $tempdep->dependencia)
            {
                $ini = $tempdep->pregunta_inicio;
                $fin = $tempdep->pregunta_fin;
                //dd("Ini=".strval($ini).", Fin=".strval($fin));
                $suma = 0;
                for ($i = $ini; $i <= $fin; $i++) {
                    $valor  = 0;
                    $cadena = '$valor = $clima->r' . strval( $i).";";                    
                    eval($cadena);
                    if ($valor == "1")
                    {
                        $valor= $tempdep->ponderacion_1;
                    }
                    if ($valor == "2")
                    {
                        $valor= $tempdep->ponderacion_2;
                    }
                    if ($valor == "3")
                    {
                        $valor= $tempdep->ponderacion_3;
                    }
                    if ($valor == "4")
                    {
                        $valor= $tempdep->ponderacion_4;
                    }                     
                    $suma= $suma + $valor;                    
                }
                $porcentaje = $suma * 1.0 / ( $fin - $ini + 1);                
                $rows= DB::table('tempdep_climas')
                    ->where('dependencia',$tempdep->dependencia)
                    ->where('cve_perfil_clima',$tempdep->cve_perfil_clima)
                    ->update(['porcentaje' => $porcentaje]);
                //dd($rows);
            }
        }
      }
      //dd("listo");
      $tempdeps = DB::table('tempdep_climas')
            ->orderBy('dependencia', 'ASC')
            ->orderBy('cve_perfil_clima', 'ASC')            
            ->get();
      return view('admin/Climasrepoper',compact('tempdeps'));
   }    
}