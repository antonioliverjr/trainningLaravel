@extends('templates.template')
@section('content')
<h1 class="text-center">Historico de Vendas</h1>
    <hr>
    <div class="col-12 m-auto">
        @if(isset($errors) && count($errors)>0)
            <div class="text-center mt-4 mb-4 p-2 alert-danger">
                @foreach($errors->all() as $erro)
                    {{$erro}}<br>
                @endforeach
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            <h3 class="col-12 text-center">Vendas Finalizadas</h3>
            <hr>
            @forelse($purchases_paid as $purchase)
                <h5 class="col-6 text-left">Pedido: {{$purchase->id}}</h5>
                <h5 class="col-6 text-right">Criado em: {{$purchase->created_at->format('d/m/Y')}}</h5>
                <form action="{{url("Canceled")}}" method="post">
                    @csrf
                    <input type="hidden" name="id_purchase" value="{{$purchase->id}}">
                <table class="table table-success table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col-1"></th>
                            <th scope="col-1">Capa</th>
                            <th scope="col-1">Livro</th>
                            <th scope="col-3">Valor</th>
                            <th scope="col-3">Desconto</th>
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
                                @if($purchase_book->status == 'paid')
                                <p>
                                    <label for="id_book">Selecionar</label><br>
                                    <input type="checkbox" name="id_book[]" id="item-{{$purchase_book->id}}" value="{{$purchase_book->id}}">
                                </p>
                                @else
                                    <strong>Cancelado</strong>
                                @endif
                            </th>
                            <td>
                                <img src="{{url('storage/Cap-Books/'.$purchase_book->RelBooks->image)}}" alt="capa" width="80px">
                            </td>
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
                            <td class="text-center" colspan="2">
                                <button type="submit" class="btn btn-danger">Cancelar Itens</button>
                            </td>
                            <td class="text-center" colspan="2"><strong>Total do pedido: </strong></td>
                            <td class="text-center" colspan="2">R$ {{number_format($total_purchase, 2, '.', ',')}}</td>
                        </tr>
                    </tfoot>
                </table>
                </form>
            @empty
            <div class="col-12 container text-center">
            <hr>
            @if(sizeof($purchases_cancel) == 0))
            <p>
                <h5>Não foi realizada nenhuma venda!</h5>
            </p>
            @else
            <p>
                <h5>No momento não há nenhuma venda valida!</h5>
            </p>
            @endif 
            
            @endforelse
        </div>
        {{$purchases_paid->links('pagination::bootstrap-4')}} 
    </div>
    
    <div class="container">
        <div class="row">
            <h3 class="col-12 text-center">Vendas Canceladas</h3>
            <hr>
            @forelse($purchases_cancel as $purchase)
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
            @if(sizeof($purchases_paid) == 0))
            <p>
                <h5>No momento não há nenhuma venda valida!</h5>
            </p>
            @else
            <p>
                <h5>Nenhuma venda foi cancelada!</h5>
            </p>
            @endif 
            
            @endforelse
        </div>
        {{$purchases_cancel->links('pagination::bootstrap-4')}} 
    </div>

    <div class="col-12 container text-center">
    <hr>
        <p>
            <a href="{{url("Cart")}}" class="btn btn-outline-info">Voltar</a>
        </p>
    </div>
@endsection