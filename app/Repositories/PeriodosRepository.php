<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Periodos;

class PeriodosRepository extends Controller
{
    private $model;
    public function __construct()
    {        
        $this->model = New Periodos();
    }
    // viene desde el controller
    public function index()
    {        
        $datos['Periodos'] = $this->All();        
        return view('admin/Periodos.index', $datos);
    }
    // viene desde el controller
    public function create( Request $request)
    {
        $Periodo = $this->periodo_blank();  
        return view('admin/Periodos.create', compact('Periodo','request'));
    }
    // viene desde el controller
    public function store( Request $request)
    {
        //$this->insert( $request);
        $campos    = $this->get_campos();
        $mensajes  = $this->get_mensajes();             
        $validated = $this->validate( $request, $campos, $mensajes);        
        $datos_periodo= $this->fix_datos_periodo( $request);
        $this->model->insert( $datos_periodo);
        return redirect("/admin/Periodos")->with('mensaje','Nuevo Periodo Agergado.');  
    }
    // viene desde el controller
    public function show( Request $request)
    {
        dd("show");
    }
    // viene desde el controller
    public function edit( Request $request, $id)
    {        
        $this->model =  $this->model->FindOrFail( $id);
        $Periodo = $this->model;
        return view('admin/Periodos.edit', compact('Periodo','request'));
    }
    // viene desde el controller
    public function update(Request $request, $id)
    {        
        $this->save( $request, $id);
        return redirect("/admin/Periodos")->with('mensaje','Periodo Actualizado.');    
    }
    // viene desde el controller
    public function destroy(Request $request, $id)
    {        
        $this->model->destroy( $id);
        return redirect("/admin/Periodos")->with('mensaje','Periodo Borrado.');
    }
    private function periodo_blank(){
        $periodo = Periodos::FindOrFail(1);
        $periodo->cve_periodo = "";
        $periodo->descripcion = "";
        $periodo->fecha_ini = "";
        $periodo->fecha_fin = "";
        return ($periodo);
    }
    private function all()
    {
        return( $this->model->orderBy('cve_periodo', 'asc')->paginate(5));
    }
    private function save(Request $request, $id)
    {        
        $campos   = $this->get_campos_save();
        $mensajes = $this->get_mensajes_save();
        $this->validate( $request, $campos, $mensajes);  
        $datos_periodo = $this->fix_datos_periodo( $request);
        $this->model->where('id','=',$id)->update( $datos_periodo);
    }
    private function fix_datos_periodo($request) 
    {
        // elimina la variables _token , _method, y activao, activa
       $datos_periodo = request()->except('_token', '_method', "activao","activa");
       unset($datos_periodo['btn_ok']);
       if ( $request->activao) {
           $datos_periodo['activo'] = true;
       } else {
           $datos_periodo['activo'] = false;
       };
       return ($datos_periodo);
    }
    // vslidcion de save, eliminar los unique
    private function get_campos_save()
    {
        return [
            'cve_periodo'=> 'required|string|max:3|min:1',
            'descripcion'=> 'required|string|max:120|min:1',
            'fecha_ini'=> 'required|date|after:1 January 2001',
            'fecha_fin'=> 'required|date|after_or_equal:fecha_ini',
        ];
    }
    private function get_mensajes_save()
    {
        return [            
            'cve_periodo.required'=>'La Clave del Periodo es requerido, al menos 1 caracter.',            
            'cve_periodo.max'=>'La Clave del Periodo debe tener 3 caracteres máximo.',
            'descripcion.required'=> 'La Descripción del Periodo es requerida, al menos 1 caracter.',
            'descripcion.max'=>'La Descripción del Periodo debe tener 120 caracteres máximo.',
            'fecha_ini.required'=> 'Es necesario capturar la fecha de inicio del Periodo.',
            'fecha_ini.after'=> 'Es necesario que la fecha de inicio del Periodo sea mayor que 1/1/2001.',
            'fecha_fin.required'=> 'Es necesario capturar la fecha final del Periodo.',
            'fecha_fin.after_or_equal'=> 'Es necesario que la fecha final sea mayor o igual que la inicial.',
        ];
    }
    // validacion estricta
    private function get_campos_e()
    {
        return [
            'cve_periodo'=> 'required|string|unique:periodos|max:3|min:1',
            'descripcion'=> 'required|string|unique:periodos|max:120|min:1',
            'fecha_ini'=> 'required|date|unique:periodos|after:1 January 2001',
            'fecha_fin'=> 'required|date|unique:periodos|after_or_equal:fecha_ini',
        ];
    }
    private function get_mensajes_e()
    {
        return [            
            'cve_periodo.required'=>'La Clave del Periodo es requerido, al menos 1 caracter.',
            'cve_periodo.max'=>'La Clave del Periodo debe tener 3 caracteres máximo.',
            'cve_periodo.unique'=>'La Clave del periodo ya existe',
            'descripcion.required'=> 'La Descripción del Periodo es requerida, al menos 1 caracter.',
            'descripcion.unique'=> 'La Descripción del Periodo ya existe.',
            'descripcion.max'=>'La Descripción del Periodo debe tener 120 caracteres máximo.',
            //'fecha_ini.gt'=>'La fecha inicial del periodo debe ser menor que la final.',
            'fecha_ini.required'=> 'Es necesario capturar la fecha de inicio del Periodo.',
            'fecha_ini.unique'=> 'La fecha de inicio ya existe.',
            'fecha_fin.required'=> 'Es necesario capturar la fecha final del Periodo.',
            'fecha_fin.unique'=> 'La fecha final ya existe.',
        ];
    }
    private function get_campos()
    {
        return [
            'cve_periodo'=> 'required|string|unique:periodos|max:3|min:1',
            'descripcion'=> 'required|string|unique:periodos|max:120|min:1',
            'fecha_ini'=> 'required|date|unique:periodos|after:1 January 2001',
            'fecha_fin'=> 'required|date|unique:periodos|after_or_equal:fecha_ini',
        ];
    }
    private function get_mensajes()
    {
        return [            
            'cve_periodo.required'=>'La Clave del Periodo es requerido, al menos 1 caracter.',
            'cve_periodo.max'=>'La Clave del Periodo debe tener 3 caracteres máximo.',
            'cve_periodo.unique'=>'La Clave del periodo ya existe',
            'descripcion.required'=> 'La Descripción del Periodo es requerida, al menos 1 caracter.',
            'descripcion.unique'=> 'La Descripción del Periodo ya existe.',
            'descripcion.max'=>'La Descripción del Periodo debe tener 120 caracteres máximo.',
            'fecha_ini.required'=> 'Es necesario capturar la fecha de inicio del Periodo.',
            'fecha_ini.unique'=> 'La fecha de inicio ya existe.',
            'fecha_ini.after'=> 'Es necesario que la fecha de inicio del Periodo sea mayor que 1/1/2001.',
            'fecha_fin.required'=> 'Es necesario capturar la fecha final del Periodo.',
            'fecha_fin.after_or_equal'=> 'Es necesario que la fecha final sea mayor o igual que la inicial.',
            'fecha_fin.unique'=> 'La fecha final ya existe.',
        ];
    }    
}