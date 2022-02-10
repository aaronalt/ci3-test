<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class RegistrationController extends Controller
{
    public function index()
    {
        $data = [];
        echo view('signup', $data);
    }

    public function store()
    {
        $rules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];
        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'name'        => $this->request->getVar('name'),
                'email'       => $this->request->getVar('email'),
                'password'    => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'is_verified' => FALSE 
            ];
            $this->send_confirmation($data);
            $this->userModel->save($data);
            return redirect()->to('/signin'); 
        }else{
            $data['validation'] = $this->validator;
            echo view('signup', $data);
        }
    }

    public function send_confirmation($data)
    {
        $email = $this->data->getVar('email');
        $address = $_POST($email);
        $subject = "Please verify your account";
        $message = 'Thank you for registering. Please click this link:
            '. base_url() . 'index.php/user_registration/verify?' . 'email=' . $_POST[$email] . $this->data['is_verified'];
    }

}