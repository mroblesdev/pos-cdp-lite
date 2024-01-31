<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Productos extends BaseController
{
    protected $productosModel;

    public function __construct()
    {
        $this->productosModel = new ProductosModel();
        helper(['form']);
    }

    public function index()
    {
        $productos = $this->productosModel->where('activo', 1)->findAll();
        return view('productos/index', ['productos' => $productos]);
    }

    public function bajas()
    {
        $productos = $this->productosModel->where('activo', 0)->findAll();
        return view('productos/eliminados', ['productos' => $productos]);
    }

    public function new()
    {
        return view('productos/new');
    }

    public function create()
    {
        $reglas = [
            'codigo' => ['label' => 'código', 'rules' => 'required|is_unique[productos.codigo]'],
            'nombre' => 'required',
            'precio' => 'required|greater_than[0]',
            'existencia' => 'numeric'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['codigo', 'nombre', 'precio', 'inventariable', 'existencia']);

        $this->productosModel->insert([
            'codigo'        => $post['codigo'],
            'nombre'        => $post['nombre'],
            'precio'        => $post['precio'],
            'inventariable' => $post['inventariable'],
            'existencia'    => $post['existencia'],
            'activo'        => 1
        ]);

        return redirect()->to('productos');
    }

    // Cargar vista editar
    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to('productos');
        }

        $producto = $this->productosModel->find($id);
        return view('productos/edit', ['producto' => $producto]);
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('productos');
        }

        $reglas = [
            'codigo' => ['label' => 'código', 'rules' => "required|is_unique[productos.codigo,id,{$id}]"],
            'nombre' => 'required',
            'precio' => 'required|greater_than[0]',
            'existencia' => 'numeric'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['codigo', 'nombre', 'precio', 'inventariable', 'existencia']);

        $this->productosModel->update($id, [
            'codigo'        => $post['codigo'],
            'nombre'        => $post['nombre'],
            'precio'        => $post['precio'],
            'inventariable' => $post['inventariable'],
            'existencia'    => $post['existencia'],
        ]);

        return redirect()->to('productos');
    }

    public function delete($id = null)
    {
        if (!$id == null) {
            $this->productosModel->update($id, [
                'activo' => 0
            ]);
        }

        return redirect()->to('productos');
    }

    public function reingresar($id = null)
    {
        if (!$id == null) {
            $this->productosModel->update($id, [
                'activo' => 1
            ]);
        }

        return redirect()->to('productos');
    }
}
