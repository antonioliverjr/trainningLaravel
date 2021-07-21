<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchases\purchase;
use App\Models\Purchases\purchase_book;
use App\Models\Books\ModelBook;


class CartController extends Controller
{
    public function __construct()
    {
        $this->objPurchase=new purchase();
        $this->objPurchaseBook=new purchase_book();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases=$this->objPurchase->where(['status'=>'reserved','id_user'=>Auth::id()])->get();
        return view('cart', compact('purchases'));
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
        
        $book=ModelBook::find($id_book);
        $id_user=Auth::id();
        
        $purchase_exist=$this->objPurchase->where('id_user','=',$id_user)->where('status','=','reserved')->get();
        
        if(sizeof($purchase_exist) == 0)
        {
            $purchase_new=$this->objPurchase->create([
                'id_user'=>$id_user
            ]);
        } else{
            $id_purchase=$purchase_exist[0]->id;
        }

        if(empty($id_purchase))
        {
            $id_purchase=$this->objPurchase->where('id_user','=',$id_user)->where('status','=','reserved')->get();
        }
        
        if(!empty($book) && !empty($id_purchase))
        {
            $purchase_book_new=$this->objPurchaseBook->create([
                'id_purchase'=>$id_purchase,
                'id_book'=>$book->id,
                'price_book'=>$book->price,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
