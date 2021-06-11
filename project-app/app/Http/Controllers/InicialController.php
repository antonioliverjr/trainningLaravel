<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\Models\Models\ModelClientes;
use App\Models\User;

class InicialController extends Controller
{

    private $objUser;
    private $objModelCliente;

    public function __construct()
    {
        $this->objUser=new User();
        $this->objModelCliente=new ModelClientes();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente=$this->objModelCliente->all();
        return view('index', compact('cliente'));
        $cliente=$this->objModelCliente->all()->sortBy('name');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=$this->objUser->all();
        return view('create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $cadcliente=$this->objModelCliente->create([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        if($cadcliente){
            return redirect('Models');
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
        $Model_Clientes=$this->objModelCliente->find($id);
        return view('show', compact('Model_Clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Model_Clientes=$this->objModelCliente->find($id);
        return view('create', compact('Model_Clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
        $this->objModelCliente->where(['id'=>$id])->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        return redirect('Models');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=$this->objModelCliente->destroy($id);
        return($del)?"Sim":"Não";
    }
}