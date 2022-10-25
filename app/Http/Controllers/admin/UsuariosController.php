<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\UsuariosRepository;

class UsuariosController extends Controller
{
    private $usuariosRepository; 
    public function __construct( UsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
        $this->middleware('auth');
    }    
    public function index()
    {   
        return $this->usuariosRepository->index();
    }
    public function create( Request $request)
    {          
        return $this->usuariosRepository->create( $request);        
    }
    public function store(Request $request)
    {        
        return $this->usuariosRepository->store( $request);   
    }
    public function destroy(Request $request, $id)
    {        
        return $this->usuariosRepository->destroy($request, $id);
    }
    public function edit(Request $request, $id)
    {
        return $this->usuariosRepository->edit($request, $id);        
    }
    public function update(Request $request, $id)
    {   
        return $this->usuariosRepository->update($request, $id);        
    }
    function indeximport(Request $request)
    {
        return $this->usuariosRepository->indeximport( $request);
    }
    public function import(Request $request)    
    {
      return $this->usuariosRepository->import( $request);
    }
}