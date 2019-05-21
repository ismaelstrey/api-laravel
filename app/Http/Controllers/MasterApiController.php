<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;



class MasterApiController extends BaseController

{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $data = $this->model->all();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        if ($request->hasFile('image') && $request->file($this->upload)->isValid()) {

            $extension = $request->file($this->upload)->extension();

            $name = uniqid(date('His'));
            $nameFile = "{$name}.{$extension}";
            $upload = Image::make($dataForm[$this->upload])->resize(177, 236)->save(storage_path("clientes/$nameFile", 70));

            if (!$upload) {

                return response()->json(['error' => 'Falha ao fazer o upload'], 500);
            } else {
                $dataForm[$this->upload] = $nameFile;
            }
        }

        $data = $this->model->create($dataForm);
        return response()->json($data, 201);
    }
    public function show($id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        }
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $data = $this->model->find($id);
        if (!$data)
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        if ($data->image) {
            Storage::disk('public')->delete("/clientes/$data->image");
        }


        $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $extension = $request->file('image')->extension();

            $name = uniqid(date('His'));
            $nameFile = "{$name}.{$extension}";
            $upload = Image::make($dataForm['image'])->resize(177, 236)->save(storage_path("clientes/$nameFile", 70));

            if (!$upload) {

                return response()->json(['error' => 'Falha ao fazer o upload'], 500);
            } else {
                $dataForm['image'] = $nameFile;
            }
        }

        $data->update($dataForm);
        return response()->json($data);
    }

    public function destroy($id)
    {

        $data = $this->model->find($id);
        if (!$data)
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        if ($data->image) {
            Storage::disk('public')->delete("/clientes/$data->image");
            $msg['img'] = ['imagem' => 'Imagem deletada com sucesso'];
        }
        $msg = ['teste' => 'Dados deletado com sucesso'];
        $msg['dados']  = ['dados' => 'Dados deletado com sucesso'];
        $data->delete();
        return response()->json([$msg], 404);
    }
}
