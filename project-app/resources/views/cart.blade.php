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
                                <img src="{{url('storage/Cap-Books/'.$purchase_book->RelBooks->image)}}" alt="capa" width="80px">
                            </th>
                            <td class="align-middle">
                                <div class="d-flex">
                                    <div class="col-4">
                                        <form action="{{url("Cart/Remove")}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$purchase_book->relBooks->id}}">
                                        <input type="hidden" name="idPurchase" value="{{$purchase->id}}">
                                        <input type="hidden" name="item" value="1">
                                        <input type="submit" class="btn btn-primary" value="-">
                                        </form>
                                    </div>
                                    <span class="col-4">{{$purchase_book->quantity}}</span>
                                    <div class="col-4">
                                        <form action="{{url("Cart/Add")}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$purchase_book->relBooks->id}}">
                                            <input type="submit" class="btn btn-primary" value="+">
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <form action="{{url("Cart/Remove")}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$purchase_book->relBooks->id}}">
                                    <input type="hidden" name="idPurchase" value="{{$purchase->id}}">
                                    <input type="hidden" name="item" value="0">
                                    <input type="submit" class="text-danger" style="box-shadow: 0 0 0 0; border: 0 none; outline: 0; background: none" value="Retirar produto">
                                </form>
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
    <form id="form-remove-item" method="post" action="{{url("/Cart/Remove")}}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="">
        <input type="hidden" name="idPurchase">
        <input type="hidden" name="item">
    </form>
    <form id="form-add-item" method="post" action="{{url("/Cart/Add")}}">
        @csrf
        <input type="hidden" name="id">
    </form>
@endsection