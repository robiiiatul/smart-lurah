<?php

namespace App\Controllers;

use App\Models\M_login;

class Login extends BaseController
{
    protected $ml;

    public function __construct()
    {
        $this->ml = new M_login(); // Load model
        helper('form'); 
    }

    public function index()
    {
        $data['title'] = 'Login | Smart-Lurah';

        if (session()->get('jabatan') == 'Admin') {
            return redirect()->to('/admin/index');
        } elseif (session()->get('jabatan') == 'Lurah') {
            return redirect()->to('/lurah/index');
        } elseif (session()->get('jabatan') == 'RT') {
            return redirect()->to('/rt/index');
        } elseif (session()->get('jabatan') == 'RW') {
            return redirect()->to('/rw/index');
        }

        return view('templates/header_w', $data)
            . view('v_login');
    }

    public function aksi_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->ml->cek_users($username, $password);
        // $user = $this->ml->cek_users($username, $password);

        if ($user) {
            $userData = [
                'id_user'  => $user['id_user'],
                'name'     => $user['name'],
                'username' => $user['username'],
                'jabatan'     => $user['jabatan'],
            ];
            session()->set($userData);

            // Redirect berdasarkan jabatan
            switch ($user['jabatan']) {
                case 'Admin':
                    return redirect()->to('/admin/index');
                case 'Lurah':
                    return redirect()->to('/lurah/index');
                case 'RT':
                    return redirect()->to('/rt/index');
                case 'RW':
                    return redirect()->to('/rw/index');
            }
        }

        session()->setFlashdata('error', 'Username & Password salah');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // public function register()
    // {
    //     $validation = \Config\Services::validation();
    //     $validation->setRules($this->ml->rules_user());

    //     if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
    //         $this->ml->saveUser();
    //         session()->setFlashdata('message', '<div class="alert alert-success">Permohonan berhasil dimasukkan! Mohon menunggu persetujuan dari Admin.</div>');
    //         return redirect()->to('/login');
    //     }

    //     $data['title'] = "Formulir Pendaftaran/Permohonan Menjadi Anggota";

    //     return view('templates/header_w', $data)
    //         . view('pages/register', $data);
    // }

    public function ubahPassword()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'new'     => 'required',
            're_new'  => 'required|matches[new]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data['title'] = "Lupa Password";
            return view('templates/header_w', $data)
                . view('edit/forgot', $data);
        }

        $user = $this->ml->cek_user();

        if (!$user) {
            session()->setFlashdata('password', '<div class="alert alert-danger">NIP anda tidak terdaftar.</div>');
            $data['title'] = "Lupa Password";
            return view('templates/header_w', $data)
                . view('edit/forgot', $data);
        }

        $this->ml->updatePass();
        session()->setFlashdata('password', '<div class="alert alert-success">Password berhasil diupdate.</div>');
        return redirect()->to('/login');
    }
}
