@extends('templates.template')

@section('content')
    <h1 class="text-center">Visualizar Livro</h1>
    <hr>
    @if(isset($errors) && count($errors)>0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
                {{$erro}}<br>
            @endforeach
        </div>
    @endif
    <div class="text-center container-sm">
        <img src="{{url('storage/Cap-Books/'.$book->image)}}" alt="Capa-Livro" width="200px">
    </div>
    <div class="col-8 m-auto">
        @php
            $model_clientes=$book->find($book->id)->relCliente;
        @endphp

        <h4>Id: {{$book->id}}</h4> <br>
        <h4>Título: {{$book->title}}</h4> <br>
        <h4>Descrição: {{$book->description}}</h4><br>
        <h4>Páginas: {{$book->pages}}</h4> <br>
        <h4>Preço: {{'R$ '.number_format($book->price, 2, ',', '.')}}</h4> <br>
        <h4>Data de Criação: {{$book->created_at}}</h4> <br>
    </div>
    <hr>
    <p class="text-center">
        <div class="text-center">
            <form action="{{url("/Cart")}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$book->id}}">
                <input type="submit" class="btn btn-success" value="Comprar">
            </form>
        </div>
    </p>
    <div class="text-center">
    <a href="{{url("Books")}}">
        <button class="btn btn-outline-info">Voltar</button>
    </a>
    </div>
@endsection