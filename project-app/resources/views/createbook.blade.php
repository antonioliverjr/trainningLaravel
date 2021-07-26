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
            <form name="editBook" id="editBook" method="post" action="{{url("Books/$book->id")}}" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form name="cadBook" id="cadBook" method="post" action="{{url('Books')}}" enctype="multipart/form-data">
        @endif
                @csrf
                <input class="form-Control" type="text" name="title" id="title" placeholder="Título do Livro:" value="{{$book->title ?? ''}}" required><br>
                <textarea class="form-Control" type="text" name="description" id="description" placeholder="Descrição do Livro:" value="{{$book->description ?? ''}}" row="5" required>{{$book->description ?? ''}}</textarea><br>                
                <input class="form-Control" type="text" name="pages" id="pages" placeholder="Páginas do Livro:" value="{{$book->pages ?? ''}}" required><br>
                <input class="form-Control" type="text" name="price" id="price" placeholder="Preço do Livro:" value="{{$book->price ?? ''}}" required><br>
                <div class="mb-3">
                    <label class="form-label" for="image">Capa do Livro:</label>
                    <input class="form-control" type="file" name="image" id="image" value="{{$book->image ?? ''}}">
                </div>               
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