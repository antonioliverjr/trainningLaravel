<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    private $objUser;

    public function __construct()
    {
        $this->objUser = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user())
        {
            $user=$this->objUser->all();
            return view('auth.users', compact('user'));
        } else {
            return redirect('/');
        }
    }

    public function inactive()
    {
        $inactive=$this->objUser->onlyTrashed()->get();
        return view('auth.inactive', compact('inactive'));
        
    }

    public function restoreUser($id)
    {
        User::onlyTrashed()->where(['id'=>$id])->restore();
        return redirect('/User');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cadUser=$this->objUser->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if($cadUser){
            return redirect('/User');
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
        $user=$this->objUser->find($id);
        return view('auth.createUser')->with('user', $user);
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
        $newpassword = $request->password;
        if($newpassword <> ""){
            $this->objUser->where(['id'=>$id])->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($newpassword)
            ]);
        } else {
            $this->objUser->where(['id'=>$id])->update([
                'name'=>$request->name,
                'email'=>$request->email
               ]);
        }
        return redirect('/User'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=$this->objUser->destroy($id);
        return($del)?"Sim":"Não";
    }
}
