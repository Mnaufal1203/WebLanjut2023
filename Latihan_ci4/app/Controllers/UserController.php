<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Validation\Validation;

class UserController extends BaseController
{
    protected $user;
    protected $validation;
    protected $userModel;

    function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->user = new UserModel();
        $this->userModel = new UserModel();
    }

    public function user()
    {
        $data['users'] = $this->user->findAll();
        return view('Pages/user', $data);
    }

    public function activate($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found.');
        }

        // Update the `is_aktif` field of the user to activate
        $this->user->update($id, ['is_aktif' => 1]);

        return redirect()->to('/user')->with('success', 'Account activated successfully.');
    }

    public function deactivate($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found.');
        }

        // Update the `is_aktif` field of the user to deactivate
        $this->user->update($id, ['is_aktif' => 0]);

        return redirect()->to('/user')->with('success', 'Account disabled successfully.');
    }
}
