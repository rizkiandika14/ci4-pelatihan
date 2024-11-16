<?php

namespace App\Controllers\MasterData;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Pengguna',
            'users' => $this->userModel->findAll()
        ];

        return view('pengguna/index', $data);
    }

    public function ajaxTable()
    {
        //get user by role and show in ajax table
        $role = $this->request->getPost('role');

        if ($role == '') {
            $users = $this->userModel->findAll();
        } else {
            $users = $this->userModel->where('role', $role)->findAll();
        }

        $data = [
            'users' => $users
        ];

        echo view('pengguna/ajax_table', $data);
    }
}
