<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PeriodosRepository;

class PeriodosController extends Controller
{
    private $objectRepository; 
    public function __construct( PeriodosRepository $objectRepository)
    {
        $this->objectRepository = $objectRepository;
        $this->middleware('auth');
    }
    public function index()
    {   
       return $this->objectRepository->index();
    }
    public function create(Request $request)
    {                
        return $this->objectRepository->create( $request);
    }
    public function store(Request $request)
    {     
        return $this->objectRepository->store( $request);
    }
    public function show(Request $request)
    {              
        return $this->objectRepository->show( $request);
    }
    public function edit(Request $request, string $id)
    {  
        return $this->objectRepository->edit( $request, $id);
    }
    public function update(Request $request, string $id)
    {
        return $this->objectRepository->update( $request, $id);
    }
    public function destroy(Request $request, string $id)
    { 
        return $this->objectRepository->destroy( $request, $id);
    }
}