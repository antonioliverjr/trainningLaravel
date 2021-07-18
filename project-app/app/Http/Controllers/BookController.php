<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Books\ModelBook;
use App\Models\Clientes\ModelClientes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;




class BookController extends Controller
{
    private $objBook;
    private $objModelCliente;

    public function __construct()
    {
        $this->objBook=new ModelBook();
        $this->objModelCliente=new ModelClientes();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $book=$this->objBook->paginate(9);
        return view('sales', compact('book'));
    }

    public function searchBook(Request $request)
    {
        $search = $request->search;
        $book=$this->objBook->where('title', 'ILIKE', '%'.$search.'%')->orWhere('description', 'ILIKE', '%'.$search.'%')->paginate(9);
        return view('sales', compact('book'));
    }

    public function records()
    {
        $book=$this->objBook->paginate(10);
        return view('book', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model_clientes=$this->objModelCliente->all();
        return view('createbook', compact('model_clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $name = Str::lower($request->title);
            $name = Str::of($name)->remove(':', '/', '!', '(', ')','&', '@', '#', '*', '-', 'ª', 'º','{', '}', '[', ']', '.')->kebab();
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
        } else {
            $nameFile = "";
        }

        $cadBook=$this->objBook->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'pages'=>$request->pages,
            'price'=>$request->price,
            'id_cliente'=>$request->id_cliente,
            'image'=>$nameFile
        ]);

        if($nameFile <> ""){
            $request->image->storeAs('Cap-Books', $nameFile);
        }

        if($cadBook){
            return redirect('Books');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=$this->objBook->find($id);
        return view('showbook', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book=$this->objBook->find($id);
        $model_clientes=$this->objModelCliente->all();
        return view('createbook')->with('book',$book)->with('model_clientes',$model_clientes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $name = Str::lower($request->title);
            $name = Str::of($name)->remove(':', '/', '!', '(', ')','&', '@', '#', '*', '-', 'ª', 'º','{', '}', '[', ']', '.')->kebab();
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
        } else {
            $book=$this->objBook->find($id);
            $nameFile=$book->image;
        }

        $this->objBook->where(['id'=>$id])->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'pages'=>$request->pages,
            'price'=>$request->price,
            'id_cliente'=>$request->id_cliente,
            'image'=>$nameFile
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            Storage::disk('public')->delete('Cap-Books/'.$nameFile);
            $request->image->storeAs('Cap-Books', $nameFile);
        }

        return redirect('Books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=$this->objBook->find($id);
        $nameFile=$book->image;
        Storage::delete('Cap-Books/'.$nameFile);
        
        $del=$this->objBook->destroy($id);
        return($del)?"Sim":"Não";
        //return($delCapa)?"Sim":"Não";
    }
}
