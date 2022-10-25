<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\PerfilusersRepository;

class PerfilusersController extends Controller
{
    private $perfilusersRepository; 
    public function __construct( PerfilusersRepository $perfilusersRepository)
    {
        $this->perfilusersRepository = $perfilusersRepository;
        $this->middleware('auth');
    }
    public function index()
    {           
        return $this->perfilusersRepository->index();
    }
    public function create( Request $request)
    {                
        return $this->perfilusersRepository->create( $request);
    }
    public function store(Request $request)
    {        
        return $this->perfilusersRepository->store( $request);        
    }
    public function show(Request $request)
    {   
        return $this->perfilusersRepository->show( $request);
    }
    public function edit(Request $request, $id)
    {                
        return $this->perfilusersRepository->edit($request, $id);
    }
    public function update(Request $request, $id)
    {   
        return $this->perfilusersRepository->update( $request, $id);
    }
    public function destroy(Request $request, $id)
    {
        return $this->perfilusersRepository->destroy( $request, $id);
    }
}