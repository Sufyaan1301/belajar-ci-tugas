<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $user;
    function __construct()
    {
        helper('form');
        $this->user = new UserModel();
        $this->diskonModel = new DiskonModel();
    }
    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[7]|numeric',
            ];

            if ($this->validate($rules)) {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $dataUser = $this->user->where(['username' => $username])->first(); //pasw 1234567

                if ($dataUser) {
                    if (password_verify($password, $dataUser['password'])) {
                        session()->set([
                            'username' => $dataUser['username'],
                            'role' => $dataUser['role'],
                            'isLoggedIn' => TRUE
                        ]);
                        //Logika diskon mulai
                        $today = date('Y-m-d');
                        $diskonToday = $this->diskonModel->where('tanggal', $today)->first();

                        if ($diskonToday) {
                            session()->set('nominalDiskon', $diskonToday['nominal']);
                        } else {
                            session()->remove('nominalDiskon');
                            session()->setFlashdata('info', 'tidak ada diskon hari ini');
                        }
                        //Logika diskon selesai
                        return redirect()->to(base_url('/'));
                    } else {
                        session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }
        return view('v_login');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
