<?php

namespace App\Repository;

use App\Cliente;
use App\Endereco;
use Illuminate\Support\Facades\Log;

class ClienteRepository extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function save($request)
    {
        $input = $request->all();
        $request->all();
        $date = new \DateTime( $input['cliente']['data_nascimento']);
        Log::info($request);
        $cliente = new Cliente;
        $cliente->nome = $input['cliente']['nome'];
        $cliente->telefone = $input['cliente']['telefone'];
        $cliente->cpf = $input['cliente']['cpf'];
        $cliente->rg = $input['cliente']['rg'];
        $cliente->data_nascimento = $date->format('Y-m-d');
        $cliente->save();

        foreach ($request['enderecos'] as $key => $value) {
            $end = new Endereco;
            $end->descricao = $value['descricao'];
            $end->cep = $value['cep'];
            $end->endereco = $value['endereco'];
            $end->numero = $value['numero'];
            $end->bairro = $value['bairro'];
            $end->cidade = $value['cidade'];
            $end->estado = $value['estado'];
            $end->complemento = $value['complemento'];
            $end->referencia = $value['referencia'];
            $end->cliente_id = $cliente['id'];
            $end->save();
        }
    }

    /**
     * Display the all resources.
     */
    public function getAll()
    {
        return Cliente::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $cliente
     */
    public function get($cliente)
    {
        return Cliente::with('enderecos')->find($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $cliente
     */
    public function updateCliente($request, $cliente)
    {
        $input = $request->all();
        $request->all();
        $date = new \DateTime( $input['cliente']['data_nascimento']);
        Log::info('eh update');
        Log::info($request);
        $cliente = Cliente::find($cliente);
        $cliente->nome = $input['cliente']['nome'];
        $cliente->telefone = $input['cliente']['telefone'];
        $cliente->cpf = $input['cliente']['cpf'];
        $cliente->rg = $input['cliente']['rg'];
        $cliente->data_nascimento = $date->format('Y-m-d');
        $cliente->save();

        Endereco::where('cliente_id',$cliente->id)->delete();

        foreach ($request['enderecos'] as $key => $value) {
            $end = new Endereco;
            $end->descricao = $value['descricao'];
            $end->cep = $value['cep'];
            $end->endereco = $value['endereco'];
            $end->numero = $value['numero'];
            $end->bairro = $value['bairro'];
            $end->cidade = $value['cidade'];
            $end->estado = $value['estado'];
            $end->complemento = $value['complemento'];
            $end->referencia = $value['referencia'];
            $end->cliente_id = $cliente['id'];
            $end->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $cliente
     * @return \Illuminate\Http\Response
     */
    public function delete($cliente)
    {
        Endereco::where('cliente_id',$cliente)->delete();
        Cliente::where('cliente_id',$cliente)->delete();
    }
}
