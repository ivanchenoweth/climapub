<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PerfilclimasRepository;

class PerfilclimasController extends Controller
{
    private $perfilclimasRepository; 
    public function __construct( PerfilclimasRepository $perfilclimasRepository)
    {
        $this->perfilclimasRepository = $perfilclimasRepository;
        $this->middleware('auth');
    }
    public function index()
    {           
        return $this->perfilclimasRepository->index();
    }
    public function create( Request $request)
    {                
        return $this->perfilclimasRepository->create( $request);
    }
    public function store(Request $request)
    {        
        return $this->perfilclimasRepository->store( $request);        
    }
    public function show(Request $request)
    {   
        return $this->perfilclimasRepository->show( $request);
    }
    public function edit(Request $request, $id)
    {                
        return $this->perfilclimasRepository->edit($request, $id);
    }
    public function update(Request $request, $id)
    {   
        return $this->perfilclimasRepository->update( $request, $id);
    }
    public function destroy(Request $request, $id)
    {
        return $this->perfilclimasRepository->destroy( $request, $id);
    }
}