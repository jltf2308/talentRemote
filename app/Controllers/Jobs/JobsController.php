<?php

namespace App\Controllers\Jobs;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JobsController extends BaseController
{
    public function index()
    {
        $data=[];
        return view('\Jobs\Jobs', $data);
    }
}
