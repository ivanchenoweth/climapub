<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perfilclimas;

class PerfilclimasRepository extends Controller
{
    private $model;
    public function __construct()
    {        
        $this->model = New Perfilclimas();
    }
    public function index()
    {
        $datos['Perfilclimas'] = $this->all();
        return view('admin/Perfilclimas.index', $datos);
    }
    public function create( Request $request)
    {
        //dd($request);
        $perfilclimas = $this->perfilclimas_blank();        
        return view('admin/Perfilclimas.create', compact('perfilclimas','request'));
    }   
    public function store( Request $request)
    {        
        $this->insert( $request);
        return redirect("/admin/Perfilclimas")->with('mensaje','Nuevo Perfil de Clima Agergado.');
    }  
    public function show(Request $request)
    {
        dd("show");
    }
    public function edit(Request $request, $id)
    {           
        $this->model = $this->model->FindOrFail($id);
        $perfilclimas = $this->model;
        return view('admin/Perfilclimas.edit', compact('perfilclimas','request'));
    }    
    public function update( Request $request, $id)
    {
        $this->save( $request, $id);         
        return redirect("/admin/Perfilclimas")->with('mensaje','Perfil de Clima Actualizado.');
    }
    public function destroy( Request $request, $id)
    {
        $this->model->destroy( $id);        
        return redirect("/admin/Perfilclimas")->with('mensaje','Perfil de Clima Borrado.');
    }       
    // para arriba todas las funciones vienen del controller, deben ser publica
    // es index(), create(), store(), show(), edit(), update(), destroy()
    private function all()
    {        
        return $this->model->orderBy('cve_perfil_clima', 'asc')->paginate(5);
    }
    private function perfilclimas_blank(){                    
        $perfilclimas = Perfilclimas::FindOrFail(1);
        $perfilclimas->cve_perfil_clima = "001";
        $perfilclimas->descripcion = "";
        return ( $perfilclimas);
    }
    private function save(Request $request, $id)
    {                
        $campos   = $this->get_campos_save();
        $mensajes = $this->get_mensajes_save();
        $this->validate( $request, $campos, $mensajes);  
        $datos_perfilclimas = $this->fix_datos_perfilclimas( $request);                
        $this->model->where('id','=',$id)->update( $datos_perfilclimas);
    }
    private function fix_datos_perfilusers( Request $request) 
    {
       // elimina la variables _token , _method, y activao, activa
       $datos_perfilclimas = request()->except('_token', '_method', "activao","activa");
       unset($datos_perfilusers['btn_ok']);
       if ( $request->activao) {
           $datos_perfilusers['activo'] = true;
       } else {
           $datos_perfilusers['activo'] = false;
       };
       return ($datos_perfilclimas);
    }
    private function get_campos_save()
    {
        return [            
            'cve_perfil_clima'=> 'required|string|max:3',
            'descripcion'=> 'required|string|max:40|min:5',
            'pregunta_inicio'=> 'required|numeric|max:999|min:1',
            'pregunta_fin'=> 'required|numeric|max:999|min:1',
        ];
    }
    // la validacion al modificar , no es tran estricta como al agregar
    private function get_mensajes_save()
    {
        return [
            'cve_perfil_clima.required'=> 'La Clave del Perfil de Usuario es requerida, al menos 1 caracter.',            
            'cve_perfil_clima.max'=>'La Clave del Perfil de Usuario debe tener 3 caracteres máximo.',
            'descripcion.required'=> 'La Descripción del Perfil de Usuario es requerida, al menos 1 caracter.',
            'descripcion.min'=>'La Descripción del Perfil de Usuario debe tener 5 caracteres como minimo.',
            'descripcion.max'=>'La Descripción del Perfil de Usuario debe tener 40 caracteres máximo.',
            'pregunta_inicio.required'=> 'El numero de la pregunta de inicio es requerido.',
            'pregunta_inicio.min'=>'El numero de la pregunta de inicio debe ser al menos 1.',
            'pregunta_inicio.max'=>'El numero de la pregunta de inicio debe ser maximo 999.',
            'pregunta_fin.required'=> 'El numero de la pregunta final es requerido.',
            'pregunta_fin.min'=>'El numero de la pregunta final debe ser al menos 1.',
            'pregunta_fin.max'=>'El numero de la pregunta final debe ser maximo 999.',
        ];     
    }
    private function get_campos()
    {
        return [
            'cve_perfil_clima'=> 'required|string|unique:perfilclima|max:3',
            'descripcion'=> 'required|string|unique:perfilclima|max:40',
        ];
    }
    private function get_mensajes()
    {
        return [
            'cve_perfil_clima.required'=> 'La Clave del Perfil de Usuario es requerida, al menos 1 caracter.',            
            'cve_perfil_clima.max'=>'La Clave del Perfil de Usuario debe tener 3 caracteres como máximo.',
            'cve_perfil_clima.unique'=>'La Clave del Perfil de Usuario no se debe reprtir.',
            'descripcion.required'=> 'La Descripción del Perfil del Clima es requerida, al menos 1 caracter.',
            'descripcion.max'=>'La Descripción del Perfil del Clima debe tener 40 caracteres máximo.',            
            'descripcion.unique'=>'La Descripción del Perfil del Clima ya existe',
        ];     
    }
    private function insert( Request $request)
    {   
        $campos  = $this->get_campos();      
        $mensajes= $this->get_mensajes();        
        $this->validate( $request, $campos, $mensajes);
        $datos_perfilclimas= $this->fix_datos_perfilclimas( $request);
        $this->model->insert( $datos_perfilclimas);
    }
}