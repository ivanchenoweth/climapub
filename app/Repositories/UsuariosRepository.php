<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Excel;
use Auth;
use Exception;

use App\Imports\UsersImport;

use App\Models\User;
use App\Models\Perfilusers;

class UsuariosRepository
{
    private $model;
    public function __construct()
    {        
        $this->model = New User();
    }
    public function index()
    {           
        $datos['usuarios'] = $this->all(); 
        $datos['perfil_usuarios'] = $this->perfil_usuarios();
        return view('admin/Usuarios.index', $datos);
    }
    public function create( Request $request)
    {
        $datos['perfil_usuarios'] = $this->perfil_usuarios();
        $datos['usuarios'] = $this->Usuario_blank();
        $datos['request'] = $request;
        //dd($usuarios);
        return view('admin/Usuarios.create', $datos);
    }
    public function store(Request $request)
    {        
      $campos   = $this->get_campos_restricted();
      $mensajes = $this->get_mensajes_restricted();
      $this->validate( $request, $campos, $mensajes);
      $datos_usuario= $this->fix_datos_usuario( $request);
      //dd($datos_usuarios);
      $this->model->insert( $datos_usuario);
      return redirect("/admin/Usuarios")->with('mensaje','Nuevo Usuario Agergado.');        
    }
    public function destroy(Request $request, string $id)
    {        
        $this->model->destroy( $id);
        return redirect("/admin/Usuarios")->with('mensaje','Usuario Borrado.');
    }
    public function edit(Request $request, string $id)
    {
        $datos['perfil_usuarios'] = $this->perfil_usuarios();
        $datos['usuarios'] = $this->model->FindOrFail( $id);
        $datos['request'] = $request;
        return view('admin/Usuarios.edit', $datos);
    }
    public function update(Request $request, string $id)
    {   
      $campos   = $this->get_campos();
      $mensajes = $this->get_mensajes();
      $this->validate( $request, $campos, $mensajes);
      $datos_usuario = $this->fix_datos_usuario( $request);
      try{
        $this->model->where('id', '=', $id)->update( $datos_usuario);
        return redirect("/admin/Usuarios")->with('mensaje','Usuario Actualizado.');
      }catch(Exception $e){              
          $campos            = $this->get_campos_restricted();        
          $mensajes          = $this->get_mensajes_restricted(); 
          $this->validate($request, $campos, $mensajes);
        //return redirect("admin/Areas")->with('mensaje','ERROR!, Clave de Area Duplicada, intente de nuevo.');            
      }
    }
    public function indeximport( Request $request)
    {
      //dd("aqui");      
      if ( $this->es_administrador() == "Si") 
      {          
          $datos['usuarios'] = $this->all();
          $datos['request'] = $request;
          return view('/admin/Usuarios/Import', $datos);
      }
      else { return $this->get_user_data(); }
    }
    public function import(Request $request)    
    {
      if ( $this->es_administrador() == "Si") { return $this->import2( $request); }
      else { return $this->get_user_data(); }
    }
    private function es_administrador() 
    {
      if (Auth::user()->fk_cve_perfil_usuario != "A") { 
        return back()->with('success', 'Error, solo pueden ingresar los Administradores.');  
      }
      return "Si";
    }
    private function perfil_usuarios()
    {
        return Perfilusers::all()->SortBy('cve_perfil_usuario');
    }
    private function usuario_blank()
    {
        $usuario = User::FindOrFail(1);
        $usuario->fk_cve_perfil_usuario = "U";
        $usuario->name = "";
        $usuario->email = "";
        $usuario->password = "";
        $usuario->activo = true;
        return $usuario;
    }
    private function all()
    {                      
        return $this->model->orderBy('email', 'asc')->paginate(5);
    }
    private function import2(Request $request) 
    {
      $datos= $this->get_user_data();      
      $clean = $request->clean;
      if ( $clean == 'Limpiar')
      {
          DB::table('users')->where('id', '>', 2)->delete();
          return back()->with('success', 'Base de datos limpiada, excepto los primeros 2 registros.');  
      } // end if ($clean
      else 
      {
        $this->validate($request, 
          [ 'select_file'  => 'required|mimes:xls,xlsx'   ], 
          [ 'select_file.required'=>'Se pide un archivo de Excel con extensión .xls o .xlsx' ]
        );
        $path1 = $request->file('select_file')->store('temp'); 
        $path = storage_path('app').'/'.$path1;          
        try 
        {
          //dd($path1);
          $data = Excel::toCollection(new UsersImport, $path);
          //$this->importUsuariosRepository->          
          $existentes = 0;
          if($data->count() > 0)
          {
           foreach($data->toArray() as $key => $value)
           {
            foreach($value as $row)
            {
              //dd($insert_data);
              if (! (               
                isset($row['nombre']) &&
                isset($row['correo']) &&
                isset($row['contrasenia']) 
                ))
              {
                  return back()->with('success', 
                  'Error: El archivo de Excel de Usuarios debe tener las columnas siguientes : '.
                  "nombre, correo y contrasenia. Alguno de ellos esta faltando."
                );
              } // end if(!)
              $users = DB::table('users')->where('name', $row['nombre'])->get();              
              if ($users->isNotEmpty()) 
              {
                $existentes= $existentes + 1;
              } // end if ($users
              else
              {                
               $insert_data[] = array(                
                'name'   => $row['nombre'],
                'password'   => Hash::make($row['contrasenia']),
                'email'   => $row['correo']
               );
              } // end else
            } // end foreach($value as $row)
           } // end foreach($data->toArray() as $key => $value)
           $suma = 0;
           if(!empty($insert_data))
           {
            //dd($insert_data);
            $suma = count($insert_data);
            DB::table('users')->insert($insert_data);
           } // end if(!empty)
          } // end if($data)
          return back()->with('success', 'El archivo de Usuarios de Excel se subió con éxito. '.
            "Se repitieron ".$existentes." registros".
            " y se subieron ".$suma. " registro(s).");         
          //$data = Excel::import(new UsersImport,$path);
          //return back()->with('success', 'El archivo de Uusarios de Excel se subió con éxito.');
        } // end try
        catch (Exception $e) 
        {
            return back()->with('success', 'Ocurrió un error:  '.$e->errorInfo[2]);
        } // end catch    
      } // end else $clean == 'Limpiar'      
  } // end function
  private function get_user_data() 
  {
    $datos=[
      "usuario"=>Auth::user()->name,
      "email"=>Auth::user()->email,
      "success"=>"Error, Solo pueden entrar Administradores a esta opción"
    ]; 
    return $datos;
  }
  private function perfiles()
  {
    return DB::table('perfilusers')->orderBy('descripcion', 'ASC')->get();
  }
  private function fix_datos_usuario( $request) 
  {
      // elimina la variables _token , _method, y activao
      $datos_usuario = request()->except('_token', '_method', "activao","activa",'btn_ok');
      $datos_usuario['activo'] = filter_var($request->activao, FILTER_VALIDATE_BOOLEAN);    
      $datos_usuario['password'] = Hash::make($datos_usuario['password']);
      return $datos_usuario;
  }
  private function get_campos()
  {
      return [
        'fk_cve_perfil_usuario'=> 'required|string|max:1|min:1',
        'name'=> 'required|string|max:80|min:1',
        'email'=> 'required|string|max:80|min:1',
        'password'=> 'required|string|max:80|min:1',
      ];
  }
  private function get_mensajes()
  {
    return [            
      'fk_cve_perfil_usuario.required'=>'La Clave del Perfil de Usuario es requerida, al menos 1 caracter.',
      'name.required'=> 'El Nombre del Usuario es requerido.',
      'name.min'=> 'El Nombre del Usuario debe tener 1 caracteres como mínimo.',
      'name.max'=> 'El Nombre del Usuario debe tener 80 caracteres como máximo.',
      'email.required'=> 'El Correo del Usuario es requerido.',
      'email.min'=> 'El Correo del Usuario debe tener 1 caracteres como mínimo.',
      'email.max'=> 'El Correo del Usuario debe tener 80 caracteres como máximo.',
      'password.required'=> 'La Contraseña del Usuario es requerida.',
      'password.min'=> 'La Contraseña del Usuario debe tener 1 caracteres como mínimo.',
      'password.max'=> 'La Contraseña del Usuario debe tener 80 caracteres como máximo.',
    ];
  }
  private function get_campos_restricted()
  {
      $campos                     = $this->get_campos();        
      $campos["name"]= 'required|unique:users|max:80|min:1';
      $campos["email"]= 'required|unique:users|max:80|min:1';
      $campos["password"]= 'required|unique:users|max:80|min:1';
      return $campos;
  }    
  private function get_mensajes_restricted()
  {
      $mensajes          = $this->get_mensajes();
      $mensajes['name.unique']= 'El nombre del Usuario ya existe.';
      $mensajes['email.unique']= 'El Correo del Usuario ya existe.';
      $mensajes['password.unique']= 'La Contraseña ya existe.';      
      return $mensajes;
  }
}