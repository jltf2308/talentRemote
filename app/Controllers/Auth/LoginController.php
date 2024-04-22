<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use \Config\Database;

class LoginController extends BaseController
{
    
    public function index()
    {
        helper(['form']);
        $data = [];
        return view('\Auth\login', $data);
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new User();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $usuario = $userModel->obtenerUsuario($email);

        if ($usuario) {
            $pass = $usuario['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $usuario['id'],
                    'name' => $usuario['fullname'],
                    'email' => $usuario['email'],
                    'type_person' => $usuario['type_person'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');

            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/login');
        }
    }
}
