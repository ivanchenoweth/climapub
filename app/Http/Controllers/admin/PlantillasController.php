<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PlantillasRepository;

class PlantillasController extends Controller
{
    private $plantillasRepository; 
    public function __construct( PlantillasRepository $plantillasRepository)
    {
        $this->plantillasRepository = $plantillasRepository;
        $this->middleware('auth');
    }    
    public function index()
    {
        //dd("index cap");
        return  $this->plantillasRepository->index();
    }
    public function create( Request $request)
    {
        return $this->plantillasRepository->create( $request);
    }  
    public function store( Request $request)
    {        
        return $this->plantillasRepository->store( $request);        
    }
    public function destroy( Request $request, $id)
    {        
        return $this->plantillasRepository->destroy( $request, $id);
    }
    public function edit( Request $request, $id)
    {        
        return $this->plantillasRepository->edit( $request, $id);
    }
    public function update(Request $request, $id)
    {   
        return $this->plantillasRepository->update( $request, $id);        
    }
    function import(Request $request)
    {      
        return  $this->plantillasRepository->import( $request);
    }
    function indeximport( Request $request)
    {
       return $this->plantillasRepository->indeximport( $request);
    }
    public function show(Request $request)
    {         
        return $this->plantillasRepository->show( $request);
    } 
}