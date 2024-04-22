<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Person;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class RegisterController extends BaseController
{
    public function index()
    {
        helper(['form']);
        $uri = $this->request->getUri();
        $data = [
            'type' => $uri->getSegment(2) === 'recruiter' ? 'Recruiter' : 'Talent'
        ];
        
        return view('\Auth\register', $data);
    }

    public function store()
    {
               
        helper(['form']);
        $rules = [
            'firstName' => 'required|min_length[2]|max_length[50]',
            'lastName' => 'required|min_length[2]|max_length[50]',
            'username' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[4]|max_length[50]',
            'confirmpassword' => 'matches[password]',
            'type' => 'required'
        ];

        if ($this->validate($rules)) {
            $personModel = new Person();
            $personData = [
                'first_name' => $this->request->getVar('firstName'),
                'last_name' => $this->request->getVar('lastName'),
                'type_person' => $this->request->getVar('type')
            ];
            $personModel->save($personData);
            $person_id = $personModel->insertID;
            $userModel = new User();
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
            return view('\Auth\register', $data);
        }

    }
}
