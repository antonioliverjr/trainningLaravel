@extends('templates.template')
@section('content')
    <h1 class="text-center">Clientes</h1>
    <hr>
    @if(isset($errors) && count($errors)>0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
                {{$erro}}<br>
            @endforeach
        </div>
    @endif
    <div class="text-center mt-3 mb-4">
        <a href="{{url("Clientes/create")}}">
            <button class="btn btn-success">Cadastrar</button>
        </a>
    </div>

    <div class="col-8 m-auto">
        @csrf
        <table class="table table-success table-striped text-center">
            <thead class="">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach($cliente as $model_clientes)
                <tr>
                    <th scope="row">{{$model_clientes->id}}</th>
                    <td>{{$model_clientes->name}}</td>
                    <td>{{$model_clientes->email}}</td>
                    <td>
                        <a href="{{url("Clientes/$model_clientes->id")}}">
                            <button class="btn btn-dark">Visualizar</button>
                        </a>
                        <a href="{{url("Clientes/$model_clientes->id/edit")}}">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                        <a href="{{url("Clientes/$model_clientes->id")}}" class="js-del">
                            <button class="btn btn-danger">Excluir</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{url("assets/js/jsDelCliente.js")}}"></script>
@endsection