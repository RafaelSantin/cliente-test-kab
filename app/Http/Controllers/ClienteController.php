<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request);
    }

    /**
     * Display the all resources.
     *
     * @param  mixed  $cliente
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return Cliente::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($cliente)
    {
        return Cliente::find($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($cliente)
    {
        //
    }
}
