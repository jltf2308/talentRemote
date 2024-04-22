<?php

namespace App\Controllers\Profile;

use App\Controllers\BaseController;
use App\Models\Person;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session()->get();
        $profileModel = new Person();
        $userSession = $profileModel->obtenerPerfil($session['email']);

        $data = [
            'first_name' => $userSession['first_name'],
            'last_name' => $userSession['last_name'],
            'type_person' => $userSession['type_person'],
            'username' => $userSession['username'],
            'email' => $userSession['email']
        ];
        return view('\Profile\Profile', $data);
    }

    public function store()
    {
        // dd($this->request->is('put'));
        helper(['form']);
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'username' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email, email, email]',
            'password' => 'required|min_length[4]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $session = session()->get();
            $userID = ($session['id']);
            $userModel = new User();
            $user = $userModel->find($userID);
            dd($user);
            $personModel = new Person();
            $personData = [
                'first_name' => $this->request->getVar('firstName'),
                'last_name' => $this->request->getVar('lastName'),
                'type_person' => $this->request->getVar('type')
            ];
            $personModel->save($personData);
            $person_id = $personModel->insertID;
            
            $data = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'person_id' => $person_id
            ];
            $userModel->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            return redirect()->back()->withInput();
        }

    }
}
