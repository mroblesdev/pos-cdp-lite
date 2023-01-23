<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        /*$seeder = \Config\Database::seeder();
        $seeder->call('PermissionSeeder');
        $seeder->call('UserSeeder');*/
        return view('login');
    }

    public function login()
    {
        helper('form');

        $rules = [
            'username' => ['required'],
            'password' => ['required']
        ];

        if (!$this->request->is('post')) {
            return view('login');
        }

        if (!$this->validate($rules)) {
            $data = ['validation' => $this->validator];
            return view('login', $data);
        }

        $userModel = new UserModel();

        $post = $this->request->getPost(['username', 'password']);
        $query = $userModel->getWhere(['username' => $post['username'], 'active' => 1]);
        $num_rows = $query->getNumRows();

        if ($num_rows > 0) {
            $row = $query->getFirstRow();
            if (password_verify($post['password'], $row->password)) {
                $sessionData = [
                    'login' => 1,
                    'userId' => $row->id,
                    'displayName' => $row->display_name,
                    'permission_id' => $row->permission_id
                ];

                $this->session->set($sessionData);
                return redirect()->to(base_url() . '/home');
            }
        }

        $this->session->destroy();
        $data['validation'] = $this->validator;
        $data['errors']['error'] = lang('App.loginValidation');
        return  view('login', $data);
    }
}
