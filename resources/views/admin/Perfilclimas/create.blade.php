@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/admin/Perfilclimas')}}" method="post" enctype="multipart/form-data">
@csrf
@include('/admin/Perfilclimas.form',['modo'=>'Crear'])
</form>
</div>
@endsection