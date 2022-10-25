<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Perfilusers;

class PerfilusersRepository extends Controller
{
    private $model;
    public function __construct()
    {        
        $this->model = New Perfilusers();
    }
    public function index()
    {
        $datos['Perfilusers'] = $this->all();
        return view('admin/Perfilusers.index', $datos);
    }
    public function create( Request $request)
    {
        //dd($request);
        $perfilusers = $this->perfilusers_blank();        
        return view('admin/Perfilusers.create', compact('perfilusers','request'));
    }   
    public function store( Request $request)
    {        
        $this->insert( $request);
        return redirect("/admin/Perfilusers")->with('mensaje','Nuevo Perfil de Usuario Agergado.');
    }  
    public function show(Request $request)
    {
        dd("show");
    }
    public function edit(Request $request, $id)
    {   
        //dd( $request);
        $this->model = $this->model->FindOrFail($id);
        $perfilusers = $this->model;
        return view('admin/Perfilusers.edit', compact('perfilusers','request'));
    }    
    public function update( Request $request, $id)
    {
        $this->save( $request, $id); 
        //dd("update");
        return redirect("/admin/Perfilusers")->with('mensaje','Perfil de Usuario Actualizado.');
    }
    public function destroy( Request $request, $id)
    {
        $this->model->destroy( $id);        
        return redirect("/admin/Perfilusers")->with('mensaje','Perfil de Usuario Borrado.');
    }       
    // para arriba todas las funciones vienen del controller, deben ser publica
    // es index(), create(), store(), show(), edit(), update(), destroy()
    private function all()
    {        
        return $this->model->orderBy('cve_perfil_usuario', 'asc')->paginate(5);
    }
    private function perfilusers_blank(){                    
        $perfilusers = Perfilusers::FindOrFail(1);
        $perfilusers->cve_perfil_usuario = "";
        $perfilusers->descripcion = "";
        return ($perfilusers);
    }
    private function save(Request $request, $id)
    {                
        $campos   = $this->get_campos_save();
        $mensajes = $this->get_mensajes_save();
        $this->validate( $request, $campos, $mensajes);  
        $datos_perfilusers = $this->fix_datos_perfilusers( $request);                
        $this->model->where('id','=',$id)->update( $datos_perfilusers);
    }
    private function fix_datos_perfilusers( Request $request) 
    {
       // elimina la variables _token , _method, y activao, activa
       $datos_perfilusers = request()->except('_token', '_method', "activao","activa");
       unset($datos_perfilusers['btn_ok']);
       if ( $request->activao) {
           $datos_perfilusers['activo'] = true;
       } else {
           $datos_perfilusers['activo'] = false;
       };
       return ($datos_perfilusers);
    }
    private function get_campos_save()
    {
        return [
            'cve_perfil_usuario'=> 'required|string|max:1|min:1',
            'descripcion'=> 'required|string|max:40|min:1',
        ];
    }
    // la validacion al modificar , no es tran estricta como al agregar
    private function get_mensajes_save()
    {
        return [            
            'cve_perfil_usuario.required'=>'La Clave del Perfil de Usuario es requerido, al menos 1 caracter.',
            'cve_perfil_usuario.max'=>'La Clave del Perfil de Usuario debe tener 1 caracteres como máximo.',
            'cve_perfil_usuario.min'=>'La Clave del Perfil de Usuario debe tener 1 caracteres como mínimo.',            
            'descripcion.required'=> 'La Descripción del Perfil de Usuario es requerida, al menos 1 caracter.',
            'descripcion.max'=>'La Descripción del Perfil de Usuario debe tener 40 caracteres máximo.',            
        ];     
    }
    private function get_campos()
    {
        return [
            'cve_perfil_usuario'=> 'required|string|unique:perfilusers|max:1|min:1',
            'descripcion'=> 'required|string|unique:perfilusers|max:40|min:1',
        ];
    }
    private function get_mensajes()
    {
        return [            
            'cve_perfil_usuario.required'=>'La Clave del Perfil de Usuario es requerido, al menos 1 caracter.',
            'cve_perfil_usuario.max'=>'La Clave del Perfil de Usuario debe tener 1 caracteres como máximo.',
            'cve_perfil_usuario.min'=>'La Clave del Perfil de Usuario debe tener 1 caracteres como mínimo.',
            'cve_perfil_usuario.unique'=>'La Clave del Perfil fe Usuario ya existe',
            'descripcion.required'=> 'La Descripción del Perfil de Usuario es requerida, al menos 1 caracter.',
            'descripcion.max'=>'La Descripción del Perfil de Usuario debe tener 40 caracteres máximo.',
            'descripcion.unique'=>'La Descripción del Perfil de Usuario ya existe',
        ];     
    }
    private function insert( Request $request)
    {   
        $campos  = $this->get_campos();      
        $mensajes= $this->get_mensajes();        
        $this->validate( $request, $campos, $mensajes);
        $datos_perfilusers= $this->fix_datos_perfilusers( $request);
        $this->model->insert( $datos_perfilusers);
    }
}