<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class SigninController extends Controller
{
    public function index()
    {
        echo view('signin');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $userModel->where('email', $email)->first();

        if($data){
            $ses_data = [
                'id' => $data['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'is_logged_in' => TRUE
            ];
            $session->set($ses_data);
            return redirect()->to('/profile');
        }else{
            return redirect()->to('/signin');
        }
    }
}
