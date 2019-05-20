<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;

class ClienteApiController extends Controller
{

    public function __construct(Cliente $cliente, Request $request)
    {
        $this->cliente = $cliente;
        $this->request = $request;
    }
    public function index()
    {
        $data = $this->cliente->all();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->cliente->rules());
        $dataForm = $request->all();
        $data = $this->cliente->create($dataForm);
        return response()->json($data, 201);
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

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
