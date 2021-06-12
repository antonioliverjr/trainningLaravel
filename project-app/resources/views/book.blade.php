@extends('templates.template')
@section('content')
    <h1 class="text-center">Livros</h1>
    <hr>

    <div class="text-center mt-3 mb-4">
        <a href="{{url("Models/create")}}">
            <button class="btn btn-success">Cadastrar</button>
        </a>
    </div>

    <div class="col-8 m-auto">
        @csrf
        <table class="table table-success table-striped text-center">
            <thead class="">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Título</th>
                <th scope="col">Páginas</th>
                <th scope="col">Preço</th>
            </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                @php
                    $user=$book->find($book->id)->relUser;
                @endphp
                <tr>
                    <th scope="row">{{$book->id}}</th>
                    <td>{{$book->name}}</td>
                    <td>{{$book->email}}</td>
                    <td>
                        <a href="{{url("Models/$book->id")}}">
                            <button class="btn btn-dark">Visualizar</button>
                        </a>
                        <a href="{{url("Models/$book->id/edit")}}">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                        <a href="{{url("Models/$book->id")}}" class="js-del">
                            <button class="btn btn-danger">Excluir</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection