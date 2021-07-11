@extends('templates.template')
@section('content')
    <h1 class="text-center">Usuarios Inativos</h1>
    <hr>

    <div class="text-center mt-3 mb-4">
        <a href="{{url("User")}}">
            <button class="btn btn-success">Cadastros Ativos</button>
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
                @foreach($inactive as $inactives)
                <tr>
                    <th scope="row">{{$inactives->id}}</th>
                    <td>{{$inactives->name}}</td>
                    <td>{{$inactives->email}}</td>
                    <td>{{$inactives->created_at}}</td>
                    <td>{{$inactives->updated_at}}</td>
                    <td class="btn-group">
                        <a href="{{url("Inactive/Restore/$inactives->id")}}" class="mr-1">
                            <button class="btn btn-success">Ativar</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{url("assets/js/jsDelUser.js")}}"></script>
@endsection