<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\MasterApiController;
use App\Models\Telefone;

class TelefoneApiController extends MasterApiController
{
    protected $model;

    protected $path;
    protected $upload;

    public function __construct(Telefone $telefones, Request $request)
    {
        $this->model = $telefones;
        $this->request = $request;
    }
    public function cliente($id)
    {
        $data = $this->model->with('cliente')->find($id);
        if (!$data) {
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        }
        return response()->json($data, 200);
    }
}
