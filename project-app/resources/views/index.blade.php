@extends('templates.template')
@section('content')
    <h1 class="text-center">Crud</h1>
    <hr>

    <div class="text-center mt-3 mb-4">
        <a href="">
            <button class="btn btn-success">Cadastrar</button>
        </a>
    </div>

    <div class="col-8 m-auto">
        <table class="table table-success table-striped text-center">
            <thead class="">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
            </tr>
            </thead>
            <tbody>
                @foreach($cliente as $model_clientes)
                @php
                    $user=$model_clientes->find($model_clientes->id)->relUser;
                @endphp
                <tr>
                    <th scope="row">{{$model_clientes->id}}</th>
                    <td>{{$model_clientes->name}}</td>
                    <td>{{$model_clientes->email}}</td>
                    <td>
                        <a href="">
                            <button class="btn btn-dark">Visualizar</button>
                        </a>
                        <a href="">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                        <a href="">
                            <button class="btn btn-danger">Excluir</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection