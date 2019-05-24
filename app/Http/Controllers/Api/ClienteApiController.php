<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\MasterApiController;
use Illuminate\Http\Request;
use App\Models\Cliente;


class ClienteApiController extends MasterApiController
{
    protected $model;
    protected $path = 'clientes';
    protected $upload = 'image';
    protected $width = 177;
    protected $height = 236;
    protected $totalPage = 20;

    public function __construct(Cliente $clientes, Request $request)
    {
        $this->model = $clientes;
        $this->request = $request;
    }
    public function index()
    {
        $data = $this->model->paginate($this->totalPage);
        return response()->json($data);
    }

    public function documento($id)
    {
        $data = $this->model->with('documento')->find($id);
        if (!$data) {
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        }
        return response()->json($data, 200);
    }
    public function telefone($id)
    {
        $data = $this->model->with('telefone')->find($id);
        if (!$data) {
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        }
        return response()->json($data, 200);
    }
    public function alugados($id)
    {
        $data = $this->model->with('filmesAlugados')->find($id);
        if (!$data) {
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        }
        return response()->json($data, 200);
    }
}
