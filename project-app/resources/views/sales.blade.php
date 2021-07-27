@extends('templates.template')
@section('content')
    <h1 class="text-center">Livros Disponíveis</h1>
    <hr>
    @if(isset($errors) && count($errors)>0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
                {{$erro}}<br>
            @endforeach
        </div>
    @endif
    <div class="m-auto mb-5">
        <div class="container mb-3">
            <div class="row">
                @foreach($book as $books)
                    <div class="col-md-4">
                        <div class="card">
                                <div class="card-img-top text-center mt-2">
                                    <img src="{{url('storage/Cap-Books/'.$books->image)}}" alt="Capa-Livro" style="width: 200px">
                                </div>
                                <div class="card-body">
                                <p class="card-title text-center">{{$books->title}}</p>
                                <p class="card-text text-center">{{'R$ '.number_format($books->price, 2, ',', '.')}}</p>
                                <p class="text-center">
                                    <div class="text-center">
                                        <form action="{{url("/Cart")}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$books->id}}">
                                            <input type="submit" class="btn btn-success" value="Comprar">
                                        </form>
                                    </div>
                                </p>
                                <p class="text-center"><a href="{{url("Books/$books->id")}}" class="mr-1">
                                <button class="btn btn-dark">Visualizar</button>
                                </a></p>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{$book->links('pagination::bootstrap-4')}}
    </div>
@endsection