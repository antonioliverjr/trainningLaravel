<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\Models\Clientes\ModelClientes;
use App\Models\User;

class ClienteController extends Controller
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
        $cliente=$this->objModelCliente->all()->sortBy('name');
        return view('index', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**$user=$this->objUser->all();*/
        return view('createcliente');
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
            return redirect('Clientes');
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
        return view('createcliente', compact('Model_Clientes'));
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
        return redirect('Clientes');
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
