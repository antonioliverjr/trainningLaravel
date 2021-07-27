@extends('templates.template')
@section('content')
    <h1 class="text-center">Livros</h1>
    <hr>
    @if(isset($errors) && count($errors)>0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
                {{$erro}}<br>
            @endforeach
        </div>
    @endif
    <div class="text-center mt-3 mb-4">
        <a href="{{url("Books/create")}}">
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
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach($book as $books)
                @php
                    $cliente=$books->find($books->id)->relCliente;
                @endphp
                <tr>
                    <th scope="row">{{$books->id}}</th>
                    <td>{{$books->title}}</td>
                    <td>{{$books->pages}}</td>
                    <td>{{'R$ '.number_format($books->price, 2, ',', '.')}}</td>
                    <td class="btn-group">
                        <a href="{{url("Books/$books->id")}}" class="mr-1">
                            <button class="btn btn-dark">Visualizar</button>
                        </a>
                        <a href="{{url("Books/$books->id/edit")}}" class="mr-1">
                            <button class="btn btn-primary">Editar</button>
                        </a>
                        <a href="{{url("Books/$books->id")}}" class="js-del mr-1">
                            <button class="btn btn-danger">Excluir</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$book->links('pagination::bootstrap-4')}}    
    </div>

    <script src="{{url("assets/js/jsDelBook.js")}}"></script>
@endsection