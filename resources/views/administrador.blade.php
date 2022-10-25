@extends('layouts.appadmin')
@section('content')
<div class="container">
    @if($success)
          <div class="alert alert-success alert-block" 
               style='background-color:#FCDF87;border:none' >               
               <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $success }}</strong>
          </div>
     @endif
     <div>Administrador del Sistema CLIMA ORGANIZACIONAL: </div>
     <div>{{$usuario}} </div>
     <div>{{$email}}</div> 
     <div>Versión de la Aplicación: 1.4.6, fecha 09/09/22</div> 
     <div>Versión de Laravel: {{app()->version()}}</div>
     <div>Versión de PHP: {{phpversion()}}</div>
     <div>Versión de SQL: {{ DB::select('select version()')[0]->{'version()'};}}</div>
</div>
@endsection
