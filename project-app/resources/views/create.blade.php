@extends('templates.template')

@section('content')
    <h1 class="text-center">@if(isset($Model_Clientes)) Editar @else Cadastrar @endif</h1>
    <hr>

    <div class="col-8 m-auto">
        @if(isset($errors) && count($errors)>0)
            <div class="text-center mt-4 mb-4 p-2 alert-danger">
                @foreach($errors->all() as $erro)
                    {{$erro}}<br>
                @endforeach
            </div>
        @endif
        @if(isset($Model_Clientes))
            <form name="formEdit" id="formEdit" method="post" action="{{url("Models/$Model_Clientes->id")}}">
                @method('PUT')
        @else
            <form name="formCad" id="formCad" method="post" action="{{url('Models')}}">
        @endif
                @csrf
                <input class="form-Control" type="text" name="name" id="name" placeholder="Nome Cliente:" value="{{$Model_Clientes->name ?? ''}}" required><br>
                <input class="form-Control" type="text" name="email" id="email" placeholder="Email Cliente:" value="{{$Model_Clientes->email ?? ''}}" required><br>
                <div class="text-center">
                <input class="btn btn-primary" type="submit" value="@if(isset($Model_Clientes)) Atualizar @else Cadastrar @endif">
                </div>
            </form>
            <div class="text-center">
            <a href="{{url("Models")}}">
                <button class="btn btn-outline-info">Voltar</button>
            </a>
            </div>
    </div>
@endsection