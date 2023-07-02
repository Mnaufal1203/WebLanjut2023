<?php

		namespace App\Controllers;

		use App\Models\userModel;

		class AuthController extends BaseController
		{
		    protected $user;

		    function __construct()
		    {
		        helper('form');
		        $this->user = new userModel();
		    }

		    public function login()
		    {
		        if ($this->request->getPost()) {
		            $username = $this->request->getVar('username');
		            $password = $this->request->getVar('password');
		            $dataUser = $this->user->where(['username' => $username])->first();

		            if ($dataUser) {
		                if (md5($password) == $dataUser['password']) {
		                    if ($dataUser['is_aktif'] == true)
							{
								session()->set([
									'username' => $dataUser['username'],
									'role' => $dataUser['role'],
									'isLoggedIn' => TRUE
								]);
								return redirect()->to(base_url('/'));
							} else {
								session()->setFlashdata('failed', 'Account has been disabled');
								return redirect()->back();
							}	
		                } else {
		                    session()->setFlashdata('failed', 'Wrong Username or Password');
		                    return redirect()->back();
		                }
		            } else {
		                session()->setFlashdata('failed', 'Username Not Found');
		                return redirect()->back();
		            }
		        } else {
		            return view('Pages/login_view');
		        }
		    }

		    public function logout()
		    {
		        session()->destroy();
		        return redirect()->to('login');
		    }
		

			public function register()
			{
				if ($this->request->getPost()) {
					$username = $this->request->getVar('username');
					$password = $this->request->getVar('password');
					$dataUser = $this->user->where(['username' => $username])->first();
					if ($dataUser) {
						session()->setFlashdata('errors', 'Username already exists');
						return redirect()->back();
					}
		
					$userData = [
						'username' => $username,
						'password' => md5($password),
						'role'		=> "user",
						'is_aktif' => true,
					];
		
					$this->user->insert($userData);
		
					session()->setFlashdata('success', 'Registration successful. Please login.');
					return redirect()->to('/login');
				} else {
					return view('Pages/register');
				}
			}
		}