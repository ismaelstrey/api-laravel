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
        $data = $this->model->all(10);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        if ($request->hasFile($this->upload) && $request->file($this->upload)->isValid()) {

            $extension = $request->file($this->upload)->extension();

            $name = uniqid(date('His'));
            $nameFile = "{$name}.{$extension}";
            $upload = Image::make($dataForm["$this->upload"])->resize($this->width, $this->height)->save(storage_path("app/public/{$this->path}/{$nameFile}", 70));

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
            return response()->json(['error' => 'Nada foi encontrado para atualizar'], 404);

        // $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        if ($request->hasFile($this->upload) && $request->file($this->upload)->isValid()) {

            $arquivo = $this->model->arquivo($id);

            if ($arquivo) {
                Storage::disk('public')->delete("/{$this->path}/{$arquivo}");
            }

            $extension = $request->file($this->upload)->extension();
            $name = uniqid(date('His'));
            $nameFile = "{$name}.{$extension}";
            $upload = Image::make($dataForm["$this->upload"])->resize($this->width, $this->height)->save(storage_path("app/public/{$this->path}/{$nameFile}", 70));

            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer o upload'], 500);
            } else {
                $dataForm['image'] = $nameFile;
            }
        }

        $data->update($dataForm);
        return response()->json($data);
    }
// ------------------------------------------DESTROY-----------------------------------------------
    public function destroy($id)
    {
        if ($data = $this->model->find($id)) {
            if ($this->model->arquivo($id)) {
                $arquivo = $this->model->arquivo($id);
                Storage::disk('public')->delete("{$this->path}/{$arquivo}");
            }
            $msg['dados']  = ['dados' => 'Dados deletado com sucesso'];
            $data->delete();
            return response()->json([$msg], 404);
        } else {
            return response()->json(['error' => 'Nada foi encontrado'], 404);
        }
    }
}
