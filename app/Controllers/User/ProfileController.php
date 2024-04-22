<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        echo "Hello : ".$session->get('name');
    }
}
