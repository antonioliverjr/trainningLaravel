<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\Models\Clientes\ModelClientes;
use App\Models\Purchases\purchase;
use App\Models\User;

class ClienteController extends Controller
{

    private $objUser;
    private $objModelCliente;

    public function __construct()
    {
        $this->objUser = new User();
        $this->objModelCliente = new ModelClientes();
        $this->objPurchase = new Purchase();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cliente = $this->objModelCliente->all()->sortBy('name');
        return view('index', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $exist_email = $this->objModelCliente->withTrashed()->where(['email' => $request->email])->exists();

        if (!$exist_email) {
            $cadcliente = $this->objModelCliente->create([
                'name' => $request->name,
                'email' => $request->email,
                'cep'=>$request->cep,
                'address'=>$request->address,
                'number'=>$request->number,
                'note'=>$request->note,
                'district'=>$request->district,
                'city'=>$request->city,
                'uf'=>$request->uf,
            ]);
        } elseif ($exist_email) {
            $email_bloq = ModelClientes::onlyTrashed()->where(['email' => $request->email])->exists();
            if ($email_bloq) {
                ModelClientes::onlyTrashed()->where(['email' => $request->email])->restore();
                return redirect('Clientes');
            } else {
                return back()->withErrors('N??o ?? poss??vel realizar o cadastro de e-mail ativo!');
            }
        }

        if ($cadcliente) {
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
        $Model_Clientes = $this->objModelCliente->find($id);
        $purchases = $this->objPurchase->where(['id_cliente' => $id])->orderBy('id')->paginate(1);
        return view('show', compact('Model_Clientes', 'purchases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Model_Clientes = $this->objModelCliente->find($id);
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
        $this->objModelCliente->where(['id' => $id])->update([
            'name' => $request->name,
            'email' => $request->email,
            'cep'=>$request->cep,
            'address'=>$request->address,
            'number'=>$request->number,
            'note'=>$request->note,
            'district'=>$request->district,
            'city'=>$request->city,
            'uf'=>$request->uf,
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
        $role = auth()->user()->id_roles;
        if ($role == 1 || $role == 2) {
            $cliente_purchases = $this->objPurchase->where(['id_cliente' => $id])->exists();

            if ($cliente_purchases) {
                $del = $this->objModelCliente->destroy($id);
                return($del) ? "Sim" : "N??o";
            } else {
                $force_del = $this->objModelCliente->deletedAtNull($id);
                return ($force_del) ? "Sim" : "N??o";
            }
        }
            return back()->withErrors('O usu??rio n??o tem permiss??o!');
    }
}
