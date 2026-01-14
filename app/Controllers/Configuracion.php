<?php

/**
 * Controlador de Configuración
 *
 * Esta clase controla las operaciones relacionadas con la configuración del sistema.
 *
 * @version 1.0
 * @link https://github.com/mroblesdev/pos-cdp-lite
 * @author mroblesdev
 */

namespace App\Controllers;

use App\Models\ConfiguracionModel;

class Configuracion extends BaseController
{
    private $configuracionModel;

    public function __construct()
    {
        $this->configuracionModel  = new ConfiguracionModel();
    }

    public function edit()
    {
        helper('form');

        $configuraciones = $this->configuracionModel->findAll();
        $configuracionesArray = [];

        foreach ($configuraciones as $configuracion) {
            $configuracionesArray[$configuracion['nombre']] = $configuracion['valor'];
        }

        return view('configuracion/datos', ['datos' => $configuracionesArray]);
    }

    public function update()
    {
        $reglas = [
            'tienda_nombre'    => ['label' => 'nombre', 'rules' => "required"],
            'tienda_telefono'  => ['label' => 'teléfono', 'rules' => "required"],
            'tienda_direccion' => ['label' => 'dirección', 'rules' => "required"],
            'ticket_leyenda'   => ['label' => 'leyende de ticket', 'rules' => "required"],
            'ventas_folio'     => ['label' => 'folio de venta', 'rules' => "required"],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['tienda_nombre', 'tienda_telefono', 'tienda_direccion', 'ticket_leyenda', 'ventas_folio']);

        foreach ($post as $indice => $valor) {
            $this->configuracionModel->actualizarRegistro($indice, $valor);
        }

        return redirect()->to('datos')->with('success', '¡Actualizado Correctamente!');
    }
}
