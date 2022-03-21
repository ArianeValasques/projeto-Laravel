<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RequestCliente;
use App\Cliente;
use Redirect;
use DataTables;
// use Illuminate\Support\Facades\Session;
use DB;
use Session;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCliente $request)
    {
        try {
            $cliente = new Cliente();
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->telefone = $request->telefone;
            $cliente->nascimento = $request->nascimento;
            $cliente->email = $request->email;

            DB::transaction(function() use ($cliente) {
                $cliente->save();
            });
            
            Session::flash('mensagem','Cliente Cadastrado!');
            return Redirect::to('/cliente');
        }
        catch(\Exception $error){
            Session::flash('mensagem', 'Erro"');
            return back()->withInput();
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
        $cliente = Cliente::get();
            return Datatables::of($cliente)
            ->editColumn('acao', function($cliente){
                return '
                    <div class="btn-group btn-group-sm">
                        <a href="/cliente/'.$cliente->id.'/edit"
                            class="btn btn-info"
                            title="Editar" data-toggle="tooltip">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="#"
                            class="btn btn-danger btnExcluir"
                            data-id="'.$cliente->id.'"
                            title="Excluir" data-toggle="tooltip">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>';
            })
            ->escapeColumns([0])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('Cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestCliente $request, $id)
    {
        try {
            $cliente = Cliente::find($id);
            $cliente->nome = $request->nome;
            $cliente->cpf = $request->cpf;
            $cliente->telefone = $request->telefone;
            $cliente->nascimento = $request->nascimento;
            $cliente->email = $request->email;

            DB::transaction(function() use ($cliente) {
                $cliente->save();
            });
            
            Session::flash('mensagem','Cadastro Alterado!');
            return Redirect::to('/cliente');
        }
        catch(\Exception $error){
            Session::flash('mensagem', 'Erro"');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        
        return Redirect::to('/cliente');
    }
}
