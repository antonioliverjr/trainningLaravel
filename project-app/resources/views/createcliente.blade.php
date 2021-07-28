@extends('templates.template')

@section('content')
    <h1 class="text-center">@if(isset($Model_Clientes)) Editar @else Cadastrar @endif</h1>
    <hr>

    <div class="col-8 m-auto">
        @if(isset($errors) && count($errors)>0)
            <div class="text-center mt-4 mb-4 p-2 alert-danger">
                @foreach($errors->all() as $erro)
                    {{$erro}}<br>
                @endforeach
            </div>
        @endif
        @if(isset($Model_Clientes))
            <form name="formEdit" id="formEdit" method="post" action="{{url("Clientes/$Model_Clientes->id")}}">
                @method('PUT')
        @else
            <form name="formCad" id="formCad" method="post" action="{{url('Clientes')}}">
        @endif
                @csrf
                <input class="form-Control" type="text" name="name" id="name" placeholder="Nome Cliente:" value="{{$Model_Clientes->name ?? ''}}" required><br>
                <input class="form-Control" type="text" name="email" id="email" placeholder="Email Cliente:" value="{{$Model_Clientes->email ?? ''}}" required><br>
                <div class="d-flex">
                    <input class="form-Control w-25" type="text" name="cep" id="cep" placeholder="Digite CEP" value="{{$Model_Clientes->cep ?? ''}}" required>
                    <a class="btn btn-success mr-2" onclick="consultaCep()"><i class="fas fa-search text-white"></i></a>
                    <input class="form-Control mr-2" type="text" name="address" id="address" placeholder="Endereço" value="{{$Model_Clientes->address ?? ''}}" readonly>
                    <input class="form-Control w-25" type="text" name="number" id="number" placeholder="Informe Nº" value="{{$Model_Clientes->number ?? ''}}" required>
                </div><br>
                <div class="d-flex">
                    <input class="form-Control mr-2 w-75" type="text" name="note" id="note" placeholder="Complemento" value="{{$Model_Clientes->note ?? ''}}">
                    <input class="form-Control mr-2 w-25" type="text" name="district" id="district" placeholder="Bairro" value="{{$Model_Clientes->district ?? ''}}" readonly>
                    <input class="form-Control mr-2 w-25" type="text" name="city" id="city" placeholder="Cidade" value="{{$Model_Clientes->city ?? ''}}" readonly>
                    <input class="form-Control w-25" type="text" name="uf" id="uf" placeholder="Estado" value="{{$Model_Clientes->uf ?? ''}}" readonly>
                </div><br>
                <div class="text-center">
                <input class="btn btn-primary" type="submit" value="@if(isset($Model_Clientes)) Atualizar @else Cadastrar @endif">
                </div>
            </form>
            <div class="text-center">
            <a href="{{url("Clientes")}}">
                <button class="btn btn-outline-info">Voltar</button>
            </a>
            </div>
    </div>
    <script type="text/javascript" src="{{url("assets/js/jsSearchCep.js")}}"></script>
@endsection