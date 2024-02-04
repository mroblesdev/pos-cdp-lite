<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Login extends BaseController
{
    public function index()
    {
        /*$seeder = \Config\Database::seeder();
        $seeder->call('UsuariosSeeder');*/
        return view('login');
    }

    public function login()
    {
        helper('form');

        $reglas = [
            'usuario'  => 'required',
            'password' => ['label' => 'contraseña', 'rules' => 'required'],
        ];

        if (!$this->validate($reglas)) {
            return view('login', ['errors' => $this->validator->getErrors()]);
        }

        $usuarioModel = new UsuariosModel();
        $post = $this->request->getPost(['usuario', 'password']);

        $usuarioData = $usuarioModel->validaUsuario($post['usuario'], $post['password']);

        if ($usuarioData !== null) {
            $this->configurarSesion($usuarioData);
            return redirect()->to(base_url() . '/inicio');
        }

        $this->session->destroy();
        $this->validator->setError('error', 'El usuario y/o contraseña son incorrectos.');
        return view('login', ['errors' => $this->validator->getErrors()]);
    }

    private function configurarSesion($usuarioData)
    {
        $sesionData = [
            'usuarioLogin'  => true,
            'usuarioId'     => $usuarioData['id'],
            'usuarioNombre' => $usuarioData['nombre'],
        ];

        $this->session->set($sesionData);
    }

    public function logout()
    {
        if ($this->session->get('usuarioLogin')) {
            $this->session->destroy();
        }

        return redirect()->to(base_url());
    }
}
