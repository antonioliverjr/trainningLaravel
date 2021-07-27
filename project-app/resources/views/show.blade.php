@extends('templates.template')

@section('content')
    <h1 class="text-center">Visualizar Cliente</h1>
    <hr>
    @if(isset($errors) && count($errors)>0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger">
            @foreach($errors->all() as $erro)
                {{$erro}}<br>
            @endforeach
        </div>
    @endif
    <div class="col-8 m-auto">
        @php
            $user=$Model_Clientes->find($Model_Clientes->id)->relUser;
        @endphp

        <h4>Id: {{$Model_Clientes->id}}</h4> <br>
        <h4>Nome: {{$Model_Clientes->name}}</h4> <br>
        <h4>E-mail: {{$Model_Clientes->email}}</h4> <br>
        <h4>Data de Criação: {{$Model_Clientes->created_at}}</h4> <br>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <h3 class="col-12 text-center">Historico de Compras</h3>
            <hr>
            @forelse($purchases as $purchase)
            <h5 class="col-6 text-left">Pedido: {{$purchase->id}}</h5>
            <h5 class="col-6 text-right">Criado em: {{$purchase->created_at->format('d/m/Y')}}</h5>
                <table class="table table-success table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col-2">Capa</th>
                            <th scope="col-2">Livro</th>
                            <th scope="col-3">Valor</th>
                            <th scope="col-2">Desconto</th>
                            <th scope="col-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_purchase = 0;
                        @endphp
                        @foreach ($purchase->RelPurchaseBookItem as $purchase_book)
                        @php
                            $total_book = $purchase_book->price_book - $purchase_book->discount;
                            $total_purchase += $total_book;
                        @endphp
                        <tr>
                            <th scope="row align-middle">
                                <img src="{{url('storage/Cap-Books/'.$purchase_book->RelBooks->image)}}" alt="capa" width="80px">
                            </th>
                            <td class="align-middle">
                                {{$purchase_book->relBooks->title}}
                            </td>
                            <td class="align-middle">
                                R$ {{number_format($purchase_book->price_book, 2, '.', ',')}}
                            </td>
                            <td class="align-middle">
                                R$ {{number_format($purchase_book->discount, 2, '.', ',')}}
                            </td>
                            <td class="align-middle">
                                R$ {{number_format($total_book, 2, '.', ',')}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td class="text-right"><strong>Total do pedido: </strong></td>
                            <td></td>
                            <td>R$ {{number_format($total_purchase, 2, '.', ',')}}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            @empty
            <div class="col-12 container text-center">
            <hr>
            <p>
                <h5>No momento não há registro de venda ao cliente!</h5>
            </p>
            @endforelse
        </div>
        {{$purchases->links('pagination::bootstrap-4')}} 
    </div>
    <div class="text-center">
    <a href="{{url("Clientes")}}">
        <button class="btn btn-outline-info">Voltar</button>
    </a>
    </div>
@endsection