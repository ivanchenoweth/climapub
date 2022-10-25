<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\ClimasRepository;

class ClimasController extends Controller
{
    private $climasRepository; 
    public function __construct( ClimasRepository $climasRepository)
    {
        $this->climasRepository = $climasRepository;
        $this->middleware('auth');
    }    
    // Menu de Administrador
    public function indexAdmin()
    {   
        //dd("indexAdmin");
        return $this->climasRepository->indexAdmin();
    }
    // Menu del Capturista
    public function index()
    { 
        //dd("index cap");
        return $this->climasRepository->index();
    }
    public function create( Request $request )
    {
        return $this->climasRepository->create( $request);
    }    
    // aqui brinca el boton de grabar
    public function store( Request $request)
    {         
        return $this->climasRepository->store( $request);
    }
    public function destroy(Request $request, $id)
    {         
        return $this->climasRepository->destroy($request, $id);
    }
    public function edit(Request $request, $id)
    {
        return $this->climasRepository->edit($request, $id);        
    }
    public function update(Request $request, $id)
    {
        return $this->climasRepository->update( $request, $id);         
    }
    public function import(Request $request)
    {
        return $this->climasRepository->import( $request);      
    }
    public function indeximport(Request $request)
    { 
        return $this->climasRepository->indeximport( $request);
    }
    // reportes 1= Usuarios, 2 = Clima, 3= Plantrillas
    public function repo( Request $request, $repo)
    { 
        return $this->climasRepository->repo( $request, $repo);
    }
    public function exp( Request $request, $exp)
    {
        return $this->climasRepository->exp($request, $exp);        
    }
    // Detallado o por Dependencia
    public function climasrepo( Request $request)
    {
        return $this->climasRepository->climasrepo( $request);
    }
    public function show( Request $request)
    {
        return $this->climasRepository->show( $request);
    } 
    public function search(Request $request)
    {
        return $this->climasRepository->search( $request);
    }
    public function cons2(Request $request)
    {
        return $this->climasRepository->cons2( $request);
    }
    public function cons1(Request $request)
    {
        return $this->climasRepository->cons1( $request);
    }
}