@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/admin/Climas/'.$climas->id) }}" 
    method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH')}}
    @include('/admin/Climas.form',['modo'=>'Editar'])
</form>
</div>
@endsection