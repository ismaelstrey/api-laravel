<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\MasterApiController;
use Illuminate\Http\Request;
use App\Models\Documento;

class DocumentoApiController extends MasterApiController
{
    protected $model;

    protected $path;
    protected $upload;

    public function __construct(Documento $documentos, Request $request)
    {
        $this->model = $documentos;
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
