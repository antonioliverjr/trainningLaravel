@extends('templates.template')

@section('content')
    <h1 class="text-center">@if(isset($book)) Editar Livro @else Cadastrar Livro @endif</h1>
    <hr>
    <div class="col-8 m-auto">
        @if(isset($errors) && count($errors)>0)
            <div class="text-center mt-4 mb-4 p-2 alert-danger">
                @foreach($errors->all() as $erro)
                    {{$erro}}<br>
                @endforeach
            </div>
        @endif
        @if(isset($book))
            <form name="editBook" id="editBook" method="post" action="{{url("Books/$book->id")}}">
                @method('PUT')
        @else
            <form name="cadBook" id="cadBook" method="post" action="{{url('Books')}}">
        @endif
                @csrf
                <input class="form-Control" type="text" name="title" id="title" placeholder="Título do Livro:" value="{{$book->title ?? ''}}" required><br>
                <input class="form-Control" type="text" name="pages" id="pages" placeholder="Páginas do Livro:" value="{{$book->pages ?? ''}}" required><br>
                <input class="form-Control" type="text" name="price" id="price" placeholder="Preço do Livro:" value="{{$book->price ?? ''}}" required><br>
                <select class="form-Control" name="id_cliente" id="id_cliente">
                    <option value="{{$book->relCliente->id ?? ''}}">{{$book->relCliente->name ?? 'Cliente'}}</option>
                    @foreach($model_clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->name}}</option>
                    @endforeach
                </select><br>                
                <div class="text-center">
                <input class="btn btn-primary" type="submit" value="@if(isset($book)) Atualizar @else Cadastrar @endif">
                </div>
            </form>
            <div class="text-center">
            <a href="{{url("Books")}}">
                <button class="btn btn-outline-info">Voltar</button>
            </a>
            </div>
    </div>
@endsection