@extends('templates.template')

@section('content')
    <h1 class="text-center">Visualizar</h1>
    <hr>

    <div class="col-8 m-auto">
        @php
            $user=$Model_Clientes->find($Model_Clientes->id)->relUser;
        @endphp

        <h4>Id: {{$Model_Clientes->id}}</h4> <br>
        <h4>Nome: {{$Model_Clientes->name}}</h4> <br>
        <h4>E-mail: {{$Model_Clientes->email}}</h4> <br>
        <h4>Data de Criação: {{$Model_Clientes->created_at}}</h4> <br>
    </div>
    <hr>
    <div class="text-center">
    <a href="{{url("Models")}}">
        <button class="btn btn-outline-info">Voltar</button>
    </a>
    </div>
@endsection