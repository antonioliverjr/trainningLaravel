<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchases\purchase;
use App\Models\Purchases\purchase_book;
use App\Models\Books\ModelBook;
use App\Models\Clientes\ModelClientes;
use phpDocumentor\Reflection\Types\Boolean;

class CartController extends Controller
{
    public function __construct()
    {
        $this->objPurchase = new purchase();
        $this->objPurchaseBook = new purchase_book();
        $this->objModelCliente = new ModelClientes();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = $this->objPurchase->where(['status' => 'reserved','id_user' => Auth::id()])->get();
        $model_clientes = $this->objModelCliente->all()->sortBy('name');
        return view('cart', compact('purchases', 'model_clientes'));
    }

    /**
     * Display a listing of the get
     *
     * @return \Illuminate\Http\Response
     */
    public function purchases()
    {
        $role = auth()->user()->id_roles;
        if ($role == 1 || $role == 2) {
            $purchases_paid = $this->objPurchase->where(['status' => 'paid'])
                                                ->orderBy('created_at', 'desc')
                                                ->paginate(5);
            $purchases_cancel = $this->objPurchase->Where(['status' => 'canceled'])
                                                    ->orderBy('updated_at', 'desc')
                                                    ->paginate(5);

            if (sizeof($purchases_paid) == 0 && sizeof($purchases_cancel) == 0) {
                return back()->withErrors('Não há historico de pedidos para exibir');
            } else {
                return view('carthistory', compact('purchases_paid', 'purchases_cancel'));
            }
        } else {
            $purchases_paid = $this->objPurchase->where(['status' => 'paid','id_user' => Auth::id()])
                                                ->orderBy('created_at', 'desc')
                                                ->paginate(5);
            $purchases_cancel = $this->objPurchase->Where(['status' => 'canceled','id_user' => Auth::id()])
                                                    ->orderBy('updated_at', 'desc')
                                                    ->paginate(5);

            if (sizeof($purchases_paid) == 0 && sizeof($purchases_cancel) == 0) {
                return back()->withErrors('Não há historico de pedidos para exibir');
            } else {
                return view('carthistory', compact('purchases_paid', 'purchases_cancel'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_book = $request->id;

        $book = ModelBook::find($id_book);
        $id_user = Auth::id();

        $purchase_exist = $this->objPurchase->where(['id_user' => $id_user, 'status' => 'reserved'])->get();

        if (sizeof($purchase_exist) == 0) {
            $purchase_new = $this->objPurchase->create([
                'id_user' => $id_user
            ]);
        } else {
            $id_purchase = $purchase_exist[0]->id;
        }

        if (empty($id_purchase)) {
            $id_purchases = $this->objPurchase->where(['id_user' => $id_user, 'status' => 'reserved'])->get();
            $id_purchase = $id_purchases[0]->id;
        }

        if (!empty($book) && !empty($id_purchase)) {
            $purchase_book_new = $this->objPurchaseBook->create([
                'id_purchase' => $id_purchase,
                'id_book' => $book->id,
                'price_book' => $book->price,
            ]);
        }

        return redirect('Cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_cliente = $request->id_cliente;
        $id_purchase = $id;

        if ($id_cliente == "Selecionar Cliente") {
            return back()->withErrors('Para finalizar o pedido deve selecionar um cliente!');
        }

        $purchase_pay = $this->objPurchase->where('id', '=', $id_purchase)
                                            ->update([
                                                'id_cliente' => $request->id_cliente,
                                                'status' => 'paid']);
        $purchase_items_pay = $this->objPurchaseBook->where('id_purchase', '=', $id_purchase)
                                                    ->update(['status' => 'paid']);

        $consulta_purchase_pay = $this->objPurchaseBook->where('id_purchase', '=', $id_purchase)
                                                        ->where('status', '=', 'paid')->get();

        if (sizeof($consulta_purchase_pay) == 0) {
            return back()->withErrors('Ocorreu uma erro na execução do pagamento do pedido!');
        }

        return redirect('Cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id_user = Auth::id();
        $id_book = $request->id;
        $id_purchase = $request->idPurchase;
        $id_purchase_books = $this->objPurchaseBook->where('id_book', '=', $id_book)
                                                    ->where('id_purchase', '=', $id_purchase)
                                                    ->where('status', '=', 'reserved')->get();
        $remove_item = (bool)$request->item;
        $id_purchase_book = $this->objPurchaseBook->where('id_book', '=', $id_book)
                                                    ->where('id_purchase', '=', $id_purchase)
                                                    ->where('status', '=', 'reserved')
                                                    ->orderBy('id', 'desc')->get();

        if (sizeof($id_purchase_books) == 0) {
            return redirect('Cart');
        } elseif ($remove_item) {
            $id_purchase_item = $id_purchase_book[0]->id;
            $purchase_book_del = $this->objPurchaseBook->where('id', '=', $id_purchase_item)->delete();
        } else {
            $purchase_books_del = $this->objPurchaseBook->where('id_book', '=', $id_book)
                                                        ->where('id_purchase', '=', $id_purchase)
                                                        ->where('status', '=', 'reserved')->delete();
        }

        $purchase_books_items = $this->objPurchaseBook->where('id_purchase', '=', $id_purchase)->get();

        if (sizeof($purchase_books_items) == 0) {
            $purchase_del = $this->objPurchase->where('id', '=', $id_purchase)->delete();
            return redirect('Books');
        } else {
            return redirect('Cart');
        }
    }

    public function canceled(Request $request)
    {
        $id_purchase = $request->id_purchase;
        $id_books = $request->id_book;
        $id_user = Auth::id();

        $role = auth()->user()->id_roles;
        if ($role == 1 || $role == 2) {
            if (empty($id_books)) {
                return back()->withErrors('Selecione os livros a serem cancelados!');
            }

            $purchase = $this->objPurchase->where(['id' => $id_purchase, 'status' => 'paid'])->exists();
            $purchase_books = $this->objPurchaseBook->where(['id_purchase' => $id_purchase, 'status' => 'paid'])
                                                    ->whereIn('id', $id_books)->exists();

            if (!$purchase) {
                return back()->withErrors('O pedido não foi finalizado!');
            } elseif (!$purchase_books) {
                if (count($id_books) > 1) {
                    return back()->withErrors('Os itens não foram finalizados!');
                } else {
                    return back()->withErrors('Os itens não foram finalizados!');
                }
            } else {
                $purchase_book_cancel = $this->objPurchaseBook->where(['id_purchase' => $id_purchase, 'status' => 'paid'])
                                                            ->whereIn('id', $id_books)
                                                            ->update(['status' => 'canceled']);
            }

            $purchase_books = $this->objPurchaseBook->where(['id_purchase' => $id_purchase, 'status' => 'paid'])
                                                    ->exists();

            if (!$purchase_books) {
                $purchase_cancel = $this->objPurchase->where(['id' => $id_purchase])
                                                    ->update(['status' => 'canceled']);
                return redirect('History');
            } else {
                return redirect('History');
            }
        } else {
            return back()->withErrors('O usuário não tem permissão para cancelar o pedido!');
        }
    }
}