@extends('templates.template')
@section('content')
    <h1 class="text-center">Usuarios</h1>
    <hr>

    <div class="text-center mt-3 mb-4">
        <a href="{{url("User/create")}}">
            <button class="btn btn-success">Cadastrar</button>
        </a>
        <a href="{{url("Inactive")}}" class="ml-5">
            <button class="btn btn-danger">Inativos</button>
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
                <th scope="col">Data Cadastro</th>
                <th scope="col">Data Atualização</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach($user as $users)
                <tr>
                    <th scope="row">{{$users->id}}</th>
                    <td>{{$users->name}}</td>
                    <td>{{$users->email}}</td>
                    <td>{{$users->created_at}}</td>
                    <td>{{$users->updated_at}}</td>
                    <td class="btn-group">
                        <a href="{{url("User/$users->id/edit")}}" class="mr-1">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                        <a href="{{url("User/$users->id")}}" class="js-del mr-1">
                            <button class="btn btn-danger">Bloquear</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{url("assets/js/jsDelUser.js")}}"></script>
@endsection