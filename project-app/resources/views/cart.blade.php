@extends('templates.template')
@section('content')
    <h1 class="text-center">Carrinho de Compras</h1>
    <hr>
    <div class="container">
        <div class="row">
            <h3 class="col-12 text-center">Produtos do carrinho</h3>
            <hr>
            @forelse($purchases as $purchase)
                <h5 class="col-6 text-left">Pedido: {{$purchase->id}}</h5>
                <h5 class="col-6 text-right">Criado em: {{$purchase->created_at->format('d/m/Y H:i')}}</h5>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col-2">Capa</th>
                            <th scope="col-2">Qtd</th>
                            <th scope="col-2">Livro</th>
                            <th scope="col-2">Valor</th>
                            <th scope="col-2">Desconto</th>
                            <th scope="col-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_purchase = 0;
                        @endphp
                        @foreach ($purchase->RelPurchaseBook as $purchase_book)
                        <tr>
                            <th scope="row align-middle">
                                <img src="{{url('storage/Cap-Books/'.$purchase_book->RelBooks->image)}}" alt="capa" width="50px">
                            </th>
                            <td class="align-middle">
                                <div>
                                    <a href="" class="col-4 text-info"><i class="fas fa-minus-circle"></i></a>
                                    <span class="col-4">{{$purchase_book->quantity}}</span>
                                    <a href="" class="col-4 text-info"><i class="fas fa-plus-circle"></i></a>
                                </div>
                                <hr>
                                <a href="" class="text-danger" style="text-decoration: none">Retirar produto</a>
                            </td>
                            <td class="align-middle">
                                {{$purchase_book->relBooks->title}}
                            </td>
                            <td class="align-middle">
                                R$ {{number_format($purchase_book->relBooks->price, 2, '.', ',')}}
                            </td>
                            <td class="align-middle">
                                R$ {{number_format($purchase_book->discount, 2, '.', ',')}}
                            </td>
                            @php
                                $total_purchase_book = ($purchase_book->relBooks->price * $purchase_book->quantity) - $purchase_book->discount;
                                $total_purchase += $total_purchase_book;
                            @endphp
                            <td class="align-middle">
                                R$ {{number_format($total_purchase_book, 2, '.', ',')}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-12 text-right">
                    <p>
                        <strong>Total do pedido: </strong>
                        <span>R$ {{number_format($total_purchase, 2, '.', ',')}}</span>
                    </p>
                </div>
                <div class="col-6 text-right">
                    <p>
                        <a href="{{url("/Books")}}" class="btn btn-primary">Continuar Compras</a>
                    </p>
                </div>
                <div class="col-6 text-left">
                    <p>
                        <a href="{{url("")}}" class="btn btn-success">Finalizar Compra</a>
                    </p>
                </div>
            @empty
                <h5>Não há nenhum pedido o carrinho</h5>
            @endforelse
        </div>
    </div>
@endsection