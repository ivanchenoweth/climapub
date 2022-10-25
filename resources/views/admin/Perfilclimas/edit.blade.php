@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/admin/Perfilclimas/'.$perfilclimas->id) }}" 
    method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH')}}
    @include('/admin/Perfilclimas.form',['modo'=>'Editar'])
</form>
</div>
@endsection